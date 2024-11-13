<?php
require_once(DOCUMENT_ROOT."/aur_lib/Log/Log.php");
require_once(INQ_SYSTEM_DIR.'/sendMail.php');

/**
 * メールの送信処理
 * @param array $sendDataBox フォームからのPOST値
 * @param string $outputSorce メール本文
 * @return bool
 */
/*
function sendMail($sendDataBox, $outputSorce) {
  $result = false;

  #メール送信クラス
  $Mail 	= new send_mail;

  # 基本情報の読み込み
  #----------------------------------------------------------
  require_once('./setup_mail.php');
  $smParams = null;
  if($ml_server==1){
    $smParams='';
    require_once (INQ_SYSTEM_DIR.'Mail.php');
    require_once (INQ_SYSTEM_DIR.'conf/sendmail.php');
  }

  # ユーザーへ送信
  #----------------------------------------------------------
  $toEmail = array();
  $toEmail[] = $sendDataBox['email']['value'];
  if($toEmail){
      include('./setup_mail_entry_user.php');
      $send_user_flag = $send_mail->action($from,$fromName,$subject,$toEmail,$outputSorce,$smParams,$zipfile);
  }

  # #管理者へメール送信
  #----------------------------------------------------------
  $sendMailAdminFlag = false;
  //メール送信処理：管理者へ送信
  $toEmail_admin = $toGroup_admin;

  include('./setup_mail_entry_admin.php');
  $sendMailAdminFlag = $send_mail->action($from,$fromName,$subject_admin,$toEmail_admin,$outputSorce,$smParams,$zipfile);
}
*/

/**
 * メールの送信ログを生成
 * @param array $sendDataBox フォームからのPOST値
 * @param string $outputSorce メール本文
 * @param string $pathDerectory 保存先のディレクトリパス
 * @return bool
 */
function makeMailLog($sendDataBox, $outputSorce, $pathDerectory) {
  $result = false;

  $Log 	= new Log;

  # ログの保存ディレクトリ
  #----------------------------------------------------------
  $Log->setPathDirectory($pathDerectory);

  # 個別のログ
  #----------------------------------------------------------
  $filename = "data_".date('YmdHis').".dat";
  $Log->setFilename($filename);
  // 日時、送信者アドレス、メール本文
  $result = $Log->makeLog('日時：'.date('Y-m-d H:i:s')."\n".'送信者：'.$sendDataBox['email']['value']."\n\n".$outputSorce."\n\n");

  # 月別のログ
  #---------------------------------------------------------- #
  $Log->setFilename("list_".date('Ym').".dat");
  // 日時、ログファイル名、送信者アドレス、IP、UA
  $Log->makeLog(date('Y-m-d H:i:s')."\t".$filename."\t".$sendDataBox['email']['value']."\t".$_SERVER['REMOTE_ADDR']."\t".$_SERVER['HTTP_USER_AGENT']."\t\n");

  return $result;
}

/**
 * 添付ファイルのアップロード
 * @param string $zipname zipファイル名
 * @param string $files 圧縮するファイルパスの配列
 * @param string $uploadDirectory アップロード先のディレクトリパス
 * @return string|null
 */
/*
function fileUpload($files) {

  # アップロード処理用
  if(isset($_POST['uploaddir'])) $dirDate = filter_input(INPUT_POST,'uploaddir',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  else $dirDate = date("Ymd_H_is");

  // ファイルの保存先パス
  $uploaddir = 'uploaddata/'.$dirDate.'/';
  if (!file_exists('uploaddata/')) mkdir('uploaddata/',0777);

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
*/

/**
 * ZIPファイルの作成
 * @param string $zipname zipファイル名
 * @param string $files 圧縮するファイルパスの配列
 * @param string $uploadDirectory アップロード先のディレクトリパス
 * @return string|null
 */
function makeZip($zipname, $files, $uploadDirectory) {
  $zipfile = null;

  if (!empty($files) && file_exists($uploadDirectory)) {
    // ファイルの保存先
    $zipname = $zipname.'.zip';
    $zipfile = $uploadDirectory.$zipname;

    $zip = new ZipArchive();
    $result = $zip->open($zipfile, ZipArchive::CREATE);

    // zipファイルのオープンに成功した場合
    if ($result === true) {
      // 圧縮するファイルを指定する
      foreach($files as $file) {
        if ($_POST[$file['name'].'_name']) {
          $filename = filter_input(INPUT_POST, $file['name'].'_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        $file = $uploadDirectory.$filename;
        $zip->addFile($file,$filename);
      }

      // ZIPファイルをクローズ
      $zip->close();

      // 圧縮前ファイルを削除
      foreach($files as $file) {
        if ($_POST[$file['name'].'_name']) {
          $filename = filter_input(INPUT_POST, $file['name'].'_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          $file = $uploadDirectory.$filename;
          if (file_exists($file)) unlink($file);
        }
      }
    }
  }

  return $zipfile;
}

/**
 * フォームの最終処理
 * @param bool $sendMailAdminFlag 管理者宛のメール送信の成功フラグ
 * @param bool $makeLogFlag ログ生成の成功フラグ
 * @param string $uploaddir 添付ファイルの保存ディレクトリ
 */
function is_completeFormTask($sendMailAdminFlag, $makeLogFlag, $uploaddir=null) {
  # ログ・メール送信のいずれかも処理が実行されていない場合エラーを表示
  if (!$makeLogFlag && !$sendMailAdminFlag) {
    echo 'フォームの送信に失敗しました。お手数ですが、サイト管理者へお問い合わせください。';
    exit;
  }

  # 添付用のZipファイル,一時アップロードディレクトリを削除
  if (file_exists($uploaddir)) {
    foreach(glob($uploaddir.'*') as $file) unlink($file);
    rmdir($uploaddir);
  }

  //ページ遷移
  header("Location: contact/thanks/index.php");
  exit;
}
