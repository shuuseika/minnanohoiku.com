<?php
$inputCheckFlag = false; #送信内容確認画面が必要な場合は[true]にセット

setlocale(LC_ALL, 'ja_JP.UTF-8');

require_once(AURA_SYSTEM_ROOT."/function.php"); #関数の読み込み
require_once(AURA_SYSTEM_ROOT.'/Form/FormBuilder.php');
require_once(AURA_SYSTEM_ROOT.'/mailform/config_root.php');
require_once(INQ_SYSTEM_DIR.'/function.php');
require_once(INQ_SYSTEM_DIR.'/sendMail.php');
require_once(INQ_SYSTEM_DIR.'/makeLog.php');

session_start();

#入力ページ・確認ページの判定フラグ
$action = filter_input(INPUT_POST, 'actiontype');
if(!$action) $action = 'input';

#フォーム作成クラス
$FormBuilder = new FormBuilder('contact', $action);
#メール送信クラス
$send_mail 	= new send_mail;
#ログ生成クラス
$make_log 	= new make_log;

#CSVファイルの取得・配列に格納
$csv = getCsv('./contact/fieldset.csv');
$csv = csvChangeArray($csv);

#CSVの項目をFormBuilderに格納
foreach($csv as $i => $row) {
  if($row && $row[0] !== 'N') {
    #1行目の処理 (同意ボタン)
    if($i == 1) {
      $FormBuilder->setType($row[3], $row[2]); #Typeの格納
      $FormBuilder->setAgreeFlag($row[6]);
      $FormBuilder->setPlaceholder($row[3], $row[7]); #プレースホルダーの格納
      $FormBuilder->setName($row[3], $row[3]); #Nameの格納
      $FormBuilder->setRequire($row[3], $row[6]); #Requireの格納
    }
    #2行目以降から処理
    if($i > 1) {
      #print_r($row);
      #行ごとのデータを格納
      $FormBuilder->setLabel($row[3], $row[1]); #Titleの格納
      $FormBuilder->setType($row[3], $row[2]); #Typeの格納
      $FormBuilder->setName($row[3], $row[3]); #Nameの格納
      $FormBuilder->setValue($row[3], $row[4]); #Valueの格納
      $FormBuilder->setClass($row[3], $row[5]); #Classの格納
      $FormBuilder->setRequire($row[3], $row[6]); #Requireの格納
      $FormBuilder->setPlaceholder($row[3], $row[7]); #プレースホルダーの格納
      $FormBuilder->setProtect($row[3], $row[8]); #保護されたフォームかどうかのチェック
      $FormBuilder->setCheckType($row[3], $row[9]); #Checktypeの格納
      $FormBuilder->setRelationItem($row[3], $row[10]); #RelationIndexの格納
      $FormBuilder->setRelationOperator($row[3], $row[11]); #RelationOperatorの格納
      $FormBuilder->setInputValue($row[3], ''); #InputValueの格納
    }
  }
}

# トークンチェック
if( $action !== 'input' && !(hash_equals(session_id(), $_POST['form_token'])) ) {
  echo '不正な送信です。';
  exit;
}

# 参照元(リファラ)チェック
if(THIS_SERVER === 'public' && isNotSameReferer()) {
  $_POST = null;
  $action = 'input';
}

# ファイルアップロード処理
$files = $FormBuilder->getFileInputs();
if(!empty($files)) {
  # アップロード処理用
  if(isset($_POST['uploaddir'])) $dirDate = filter_input(INPUT_POST,'uploaddir',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  else $dirDate = date("Ymd_H_is");

  // ファイルの保存先パス
  $uploaddir = 'contact/uploaddata/'.$dirDate.'/';
  if (!file_exists('contact/uploaddata/')) mkdir('contact/uploaddata/',0777);

  $fileArray = array();

  foreach($files as $file) {
    if (!isset($_FILES[$file['name']])) $_FILES[$file['name']] = null;

    if($_FILES[$file['name']] && $_FILES[$file['name']]['size'] !== 0) {
      if (!file_exists($uploaddir)) mkdir($uploaddir,0755);

      $fileinfo = pathinfo($_FILES[$file['name']]['name']);
			$filetype = isset($fileinfo['extension']) ? '.'.$fileinfo['extension'] : '';
      $filename = $fileinfo['filename'];
      // ファイル名の重複回避
      $count = 0;
      while (array_search($filename, $fileArray) !== false) {
        $count++;
        $filename = $filename.'('.$count.')';
      }
      $fileArray[] = $filename;
      $filename = $filename.$filetype;
      $fileurl  = $uploaddir.$filename;

      move_uploaded_file($_FILES[$file['name']]['tmp_name'], $fileurl);
      $FormBuilder->setInputValue($file['name'], $filename);
      $FormBuilder->setPlaceholder($file['name'], $filename);
    }
  }
  $FormBuilder->setUploaddir($dirDate);
}

$formNames = $FormBuilder->getNameArray();
if($action === 'confirm' || $action === 'submit') {
  # $_POSTの操作
  foreach($formNames as $name => $value) {
    #POST値の浄化
    if ($FormBuilder->getType($value) !== 'file') { //fileタイプは別処理
      if(isset($_POST[$value]) && is_array($_POST[$value])) {
        $FormBuilder->setInputValue($value, filter_input(INPUT_POST, $value,FILTER_DEFAULT,FILTER_REQUIRE_ARRAY));
      } else {
        $FormBuilder->setInputValue($value, filter_input(INPUT_POST, $value));
      }
    }
    # filetypeの処理
    if ($FormBuilder->getType($value) === 'file' && filter_input(INPUT_POST, $value.'_name')) {
      $FormBuilder->setInputValue($value, filter_input(INPUT_POST, $value.'_name'));
      $FormBuilder->setPlaceholder($value, filter_input(INPUT_POST, $value.'_name'));
    }
  }
  $FormBuilder->setAgree(filter_input(INPUT_POST, 'agree'));

  # 入力値のバリデーション
  if($FormBuilder->inputValidater()) {
    #$sendDataBox = $FormBuilder->getParameters();

    $captchaErrorFlag = is_Bot();
    if($action === 'submit' && !$captchaErrorFlag) {
      // ZIPアーカイブ化（ファイルアップロードがある場合）
      $zipfile = null;
			if (!empty($files) && file_exists($uploaddir)) {
				// ファイルの保存先
				$zipfileName = $dirDate.'.zip';
				$zipfile = $uploaddir.$zipfileName;

				$zip = new ZipArchive();
				$res = $zip->open($zipfile, ZipArchive::CREATE);
				// zipファイルのオープンに成功した場合
				if ($res === true) {
					// 圧縮するファイルを指定する
          foreach($files as $file) {
            if ($_POST[$file['name'].'_name']) {
              $filename = filter_input(INPUT_POST, $file['name'].'_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
            $file = $uploaddir.$filename;
            $zip->addFile($file,$filename);
          }

					// ZIPファイルをクローズ
					$zip->close();
					// 圧縮前ファイルを削除
          #print_r($zipfile);
          foreach($files as $file) {
            if ($_POST[$file['name'].'_name']) {
              $filename = filter_input(INPUT_POST, $file['name'].'_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
              $file = $uploaddir.$filename;
              #print_r($file);
              if (file_exists($file)) unlink($file);
            }
          }
				}
			}

      //メール定型分用データ格納
      $sendDataBox = $FormBuilder->getParameters();

      //メール送信処理：基本情報の読み込み
      require_once('./contact/setup_mail.php');
      $smParams = null;
      if($ml_server==1){
        $smParams='';
        require_once (INQ_SYSTEM_DIR.'Mail.php');
        require_once (INQ_SYSTEM_DIR.'conf/sendmail.php');
      }
      //メール送信処理：ユーザーへ送信
      $toEmail = array();
      $toEmail[] = $sendDataBox['email']['value'];
      if($toEmail){
          include('./contact/setup_mail_entry_user.php');
          $send_user_flag = $send_mail->action($from,$fromName,$subject,$toEmail,$outputSorce,$smParams,$zipfile);
      }

      #管理者へのメール送信・サーバーへのログ書き出し処理のフラグ
      $sendMailAdminFlag = false;
      $makeLogFlag = false;

      //メール送信処理：管理者へ送信
      $toEmail_admin = $toGroup_admin;

      include('./contact/setup_mail_entry_admin.php');
      $sendMailAdminFlag = $send_mail->action($from,$fromName,$subject_admin,$toEmail_admin,$outputSorce,$smParams,$zipfile);

      //ログ書き出し
      $makeLogFlag = $make_log->backup($sendDataBox['email']['value'],$outputSorce,'./contact/log');

      //送信処理完了後のタスク処理
      is_completeFormTask($sendMailAdminFlag, $makeLogFlag, $uploaddir);
    }
  }

  $action = 'confirm';

  if ($action === 'confirm') {
    foreach($formNames as $name => $value) {
      $FormBuilder->setValue($value, $FormBuilder->getInputValue($value));
    }
  }
} elseif($action === 'return') {
  # $_POSTの操作
    #print_r($_POST);
    foreach($formNames as $name => $value) {
      if ($FormBuilder->getType($value) !== 'file') {
        #POST値の浄化
        if(isset($_POST[$value]) && is_array($_POST[$value])) {
          $FormBuilder->setInputValue($value, filter_input(INPUT_POST, $value,FILTER_DEFAULT,FILTER_REQUIRE_ARRAY));
        } else {
          $FormBuilder->setInputValue($value, filter_input(INPUT_POST, $value));
        }
      }
      #print_r($FormBuilder->getInputValue($value));
      # filetypeの処理
      if ($FormBuilder->getType($value) === 'file' && filter_input(INPUT_POST, $value.'_name')) {
        $FormBuilder->setInputValue($value, filter_input(INPUT_POST, $value.'_name'));
        $FormBuilder->setPlaceholder($value, filter_input(INPUT_POST, $value.'_name'));
      }
    }
  $FormBuilder->setAgree(filter_input(INPUT_POST, 'agree'));

  foreach($formNames as $name => $value) {
    $FormBuilder->setValue($value, $FormBuilder->getInputValue($value));
  }
}

/**
 * Botチェック
 * @return bool
 */
function is_Bot() {
  # トークン存在しているかどうかを判断する
  if (isset($_POST["g-recaptcha-response"])) {
    # トークンを格納する
    $recaptcha = htmlspecialchars($_POST["g-recaptcha-response"],ENT_QUOTES,'UTF-8');
    $captcha = $recaptcha;

    # シークレットキーを格納する
    $secretKey = "6LefcH4qAAAAAHzjPZHsAKXF1m70DvfxwWj69qDW";

    # シークレットキーとトークンを一緒にGoogleに送信し、返り値を格納する
    $resp = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
    $resp_result = json_decode($resp,true);

    # 返り値が存在する かつ スコアが0.3より高ければfalseを返す
    if ($resp_result['success'] && $resp_result['score'] > 0.3) return false;
  }

  # 画像認証の入力値が存在するかどうかを判断する
  if (isset($_POST['captcha_code'])) {
    # 画像認証の入力値が画像の値と比較し、同じ場合falseを返す
    require_once(DOCUMENT_ROOT.'/aur_lib/securimage/securimage.php');
    $securimage = new Securimage();
    if ($securimage->check(filter_input(INPUT_POST, 'captcha_code'))) {
      return false;
    }
  }

  return true;
}
?>
