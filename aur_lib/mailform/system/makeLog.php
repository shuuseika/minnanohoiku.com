<?php
class make_log{
    #━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    /***
	* *********************************************
	* 処理：ログを保存
	* *********************************************
	* 条件：なし
	* IN：（該当ID）
	* OUT：メール
	* LastUpdate : 2018.03.16
	* Author : H.Yamana
	* 
    ***/
    function backup($mail,$outputSorce,$dir_name){
        /* Notice Error Avoid ----------------------------------- */
        /*[isset]*/ if(!isset($mail))	$mail = null;
        /*[isset]*/ if(!isset($outputSorce))	$outputSorce = null;
        /*[isset]*/ if(!isset($dir_name))	$dir_name = null;
        /* ------------------------------------------------------ */
        $log_dir = $dir_name;
        if(file_exists($log_dir) === false) {
            mkdir($log_dir,0777);
            $htaccess_file = '.htaccess';
            $htaccess_data = 'deny from All';
            $htaccess_path = $log_dir.'/'.$htaccess_file;

            $fp = fopen($htaccess_path, "w");
            fwrite($fp, $htaccess_data);
            fclose($fp);
        }

        $log_file = 'data_'.date('YmdHis').'.dat';
        $log_data = '日時：'.date('Y-m-d H:i:s')."\n".'送信者：'.$mail."\n\n".$outputSorce."\n\n";
        $log_path = $log_dir.'/'.$log_file;

        $fp = fopen($log_path, "w");
        fwrite($fp, $log_data);
        fclose($fp);

        $log_file2 = 'list_'.date('Ym').'.dat';
        $log_data2 = ''.date('Y-m-d H:i:s')."\t".''.$log_file."\t".$mail."\t".$_SERVER['REMOTE_ADDR']."\t".$_SERVER['HTTP_USER_AGENT']."\t\n";
        $log_path2 = $log_dir.'/'.$log_file2;

        $fp2 = fopen($log_path2, "a");
        fwrite($fp2, $log_data2);
        fclose($fp2);

        return true;
    }
    #---------------------------------------------------------------------------------------------------------
    #━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
}
class make_asi{
    #━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    /***
	* *********************************************
	* 処理：ログを保存
	* *********************************************
	* 条件：なし
	* IN：（該当ID）
	* OUT：メール
	* LastUpdate : 2013.08.21
	* Author : H.Yamana
	* 
***/
    function backup($temp_name,$email,$name){
        /* Notice Error Avoid ----------------------------------- */
        /*[isset]*/ if(!isset($temp_name))	$mail = null;
        /*[isset]*/ if(!isset($email))	$outputSorce = null;
        /*[isset]*/ if(!isset($name))	$outputSorce = null;
        /* ------------------------------------------------------ */
        /*	*/
        $asi_dir = INQ_MAILPG_DIR.'/asi';
        if((@opendir("$asi_dir"))==false){mkdir("$asi_dir",0777);}
        $asi_file = $temp_name.'.dat';
        $asi_data = '<?php $name='."'".$name."'".'; $email='."'".$email."'; ?>"."\n\n";
        $asi_path = $asi_dir.'/'.$asi_file;
        $fp = fopen($asi_path, "w");
        fwrite($fp, $asi_data);
        fclose($fp);
        /*	*/
    }
    #---------------------------------------------------------------------------------------------------------
    #━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
}
?>