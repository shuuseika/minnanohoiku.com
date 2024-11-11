<?php
##━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
 #
 # 画像データアップロードモジュール
 # ModuleVersion 2.0 for shiminuki-refine.jp
 #
 # Final Update 2013/11/28
 # Copyright (c) AURA INC,. All Rights Reserved.
 #
##━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛


	/* 【アップロード画像を配列へ格納】
	--	NAME値,VALUE値	-- --*/
	$array_upload_photo = array(
		'photo1'=>'entry_photo1',
		'photo2'=>'entry_photo2',
		'photo3'=>'entry_photo3',
		'photo4'=>'entry_photo4',
		'photo5'=>'entry_photo5',
		'photo6'=>'entry_photo6',
		'photo7'=>'entry_photo7',
		'photo8'=>'entry_photo8',
		'photo9'=>'entry_photo9',
		'photo10'=>'entry_photo10',
		'asi1'=>'entry_asi1',
		'asi2'=>'entry_asi2'
	);

	/* 【画像データ一時保存　ファイル名＆保存場所】
	--		-- --*/
	$tmp_dir = INQ_MEDIA_DIR.'/tmp';
	$tmp_url = MEDIA_URL.'tmp/';

	global $my_cookie_name;

if($_POST){

	// 一時ファイル名の作成（１度の取得で常に所持）
	/*[isset]*/ if(!isset($_POST['tmp_name']))	$_POST['tmp_name'] = null;
	/*[isset]*/ if(!isset($_POST['my_mine']))		$_POST['my_mine'] = null;
	/*[isset]*/ if(!isset($_COOKIE[$my_cookie_name.COOKIE_UNI_NAME]))		$_COOKIE[$my_cookie_name.COOKIE_UNI_NAME] = null;
	if(!$_POST['tmp_name']){
		if(!$_COOKIE[$my_cookie_name.COOKIE_UNI_NAME]){
			$remote_addr = str_replace('.','',$_SERVER['REMOTE_ADDR']);
			$tmp_name= 'i_'.date("Y").date("m").date("d").date("H").date("i").date("s").$remote_addr;
		}else{
			$tmp_name = $_COOKIE[$my_cookie_name.COOKIE_UNI_NAME];
		}
	}else{
		$tmp_name = $_POST['tmp_name'];
	}
	$my_code = substr($tmp_name, 4, 15);	//ファイル名用
	$backdate = sprintf('%02d',date("i")-21);	//
	$backdate = date("Y").date("m").date("d").date("H").$backdate.date("s");

	/* 【画像データの保存用ファイルパス】
	--		-- --*/
	$img_org_path  = $tmp_dir.'/'.$tmp_name.$_POST['my_mine'];	// Normal

}

if($_POST['entry_next_action'] == 'check_NO'){	

	/* 【画像データの古いデータの削除】
	--		-- --*/
	$dir=dir($tmp_dir);
#	while(($ent = $dir->read()) !== FALSE){
#		if(ereg('.jpg',$ent)){	//JPGファイルのみ対象
#			$delete_img_num = substr($ent, 2, 14);	//抽出
#			if($backdate>$delete_img_num){
#				$delete_img = $tmp_dir.'/'.$ent;
#				if(file_exists($delete_img)){ unlink($delete_img); }
#			}
#		}	
#	} 

	/* 【画像データの一時保存の実行】
	--		-- --*/

	foreach($array_upload_photo as $fn => $inputname){
	

		if($_FILES[$inputname]['tmp_name']){
		
			${'file_size_'.$inputname} = floor($_FILES[$inputname]['size']/1000);//Kbyte
			${'file_name_'.$inputname} = $_FILES[$inputname]['name'];
			${'file_type_'.$inputname} = $_FILES[$inputname]['type'];
			$array_dot = explode('.',${'file_name_'.$inputname});

			//拡張子セット
			$mine = '';
			foreach($array_dot as $filename_val){	if($filename_val){$mine = '.'.$filename_val;}}
			${'type_'.$fn} = $mine;

			//拡張子セット(exe除外)
			if($mine=='.exe'){	//KB
				print '【送信エラー】 こちらのファイル形式はアップロードできません。';
				exit;
			}
			if($mine=='.exe'){	$mine='.xxx'; }

			move_uploaded_file($_FILES[$inputname]['tmp_name'], $img_org_path.'_'.$fn.$mine);	//そのまま保存
			chmod($img_org_path.'_'.$fn.$mine,0666);

	
		}
	
	}
		
#	if(!IMGCONVERTER_ORGDATA){if(file_exists($img_org_path.$mine)){ unlink($img_org_path.$mine); }}



}elseif($_POST['entry_next_action'] == 'update'){

	/* 【画像データの保存（一時ファイルからの移動）】
	--		-- --*/
	$savefolder_dir = INQ_MEDIA_DIR.'/'.date("Y").date("m");
	$savefolder_url = MEDIA_URL.date("Y").date("m").'/';
	if((@opendir("$savefolder_dir"))==false){mkdir("$savefolder_dir",0775);}
	
	foreach($array_upload_photo as $fn => $inputname){

		if($_POST['entry_'.$fn]){

			${'save_file_end'} = $savefolder_dir.'/'.$_POST['entry_'.$fn];
			${'save_file_end_url_'.$fn} = $savefolder_url.$_POST['entry_'.$fn];
			${'img_org_path'} = $tmp_dir.'/'.$_POST['entry_'.$fn];

			if(file_exists(${'img_org_path'})){
				copy(${'img_org_path'}, ${'save_file_end'});
				unlink(${'img_org_path'});
				chmod(${'save_file_end'},0666);
			}

	/*
			if(IMGCONVERTER_ORGDATA){
				if(file_exists($img_org_path)){
					$img_org_end = INQ_MEDIA_DIR.'/'.$_POST['entry_'.$fn];
					copy($img_org_path, $img_org_end);
					unlink($img_org_path);
				}
			}
	*/

	}

	}	//アップロード画像の数だけ繰り返す（終了）

}
?>