<?php
class send_mail{
    #━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
    /***
    * *********************************************
    * 処理：メール送信
    * *********************************************
    * 条件：なし
    * IN：（該当ID）
    * OUT：メール
    * LastUpdate : 2011.10.01
    * Author : H.Yamana
    * 
    ***/
    function action($from,$fromName,$subject,$toGroup,$ml_body,$smParams,$zipfile=null)
    {
        /* Notice Error Avoid ----------------------------------- */
        /*[isset]*/ if(!isset($from))	$from = null;
        /*[isset]*/ if(!isset($fromName))	$fromName = null;
        /*[isset]*/ if(!isset($subject))	$subject = null;
        /*[isset]*/ if(!isset($toGroup))	$toGroup = null;
        /*[isset]*/ if(!isset($ml_body))	$ml_body = null;
        /* ------------------------------------------------------ */

        //送信方法が外部SMTPサーバ利用の場合
        if($smParams){$smtp = Mail::factory('smtp',  $smParams);}

        # 件名を設定
        $subject = mb_convert_encoding($subject, "ISO-2022-JP", "UTF-8");
        $subject = '=?iso-2022-jp?B?'.base64_encode($subject).'?=';
        # 送信者名を設定
        $fromName = mb_convert_encoding($fromName, "ISO-2022-JP", "UTF-8");

        # ヘッダー情報
        $ml_header = 'Return-Path: <'.$from.'>'."\n";
        $ml_header .= 'From: '.'=?iso-2022-jp?B?'.base64_encode($fromName).'?= <'.$from.'>'."\n";
        $ml_header .= 'Reply-To: '.$from."\n";

        #添付ファイル
        $boundary = "__BOUNDARY__";
        if(!is_null($zipfile)) $ml_header .= 'Content-Type: multipart/mixed;boundary="'.$boundary.'"'."\n";

        $ml_body_header = '';
        if(!is_null($zipfile)) {
            $ml_body_header  = '--'.$boundary."\n";
            $ml_body_header .= 'Content-Type: text/plain; charset=ISO-2022-JP'."\n";
            $ml_body_header .= 'Content-Transfer-Encoding: 7bit'."\n";
            $ml_body_header .= 'Mime-Version: 1.0';
        } else {
            $ml_header .= 'Content-Type: text/plain; charset=ISO-2022-JP'."\n";
            $ml_header .= 'Content-Transfer-Encoding: 7bit'."\n";
            $ml_header .= 'Mime-Version: 1.0';
        }
        
        $ml_body = str_replace("\r\n", "\n", $ml_body);
        $ml_body = mb_convert_encoding($ml_body, "ISO-2022-JP", "UTF-8");
        $ml_body = $ml_body_header.$ml_body;

        if(!is_null($zipfile)) {
            $ml_body .= '--'.$boundary."\n";
            $ml_body .= "Content-Type: application/x-zip-compressed; name=\"" . basename($zipfile) . "\"\n";
            $ml_body .= "Content-Disposition: attachment; filename=\"" . basename($zipfile) . "\"\n";
            $ml_body .= "Content-Transfer-Encoding: base64\n";
            $ml_body .= "\n";
            $ml_body .= chunk_split(base64_encode(file_get_contents($zipfile)))."\n";
            $ml_body .= "\n";
            $ml_body .= '--'.$boundary.'--';
        }

        //送信方法が外部SMTPサーバ利用の場合
        if($smParams){ 
            foreach($toGroup as $tg_key => $tg_val) {
                $headers  = array (
                    'To' => trim($tg_val),
                    'From' => $from,
                    'Subject' => $subject,
                );  
                $smtp->send(trim($tg_val),  $headers,  $ml_body);
            }
        //送信方法が内部メールサーバ利用の場合
        }else{
            foreach($toGroup as $tg_key => $tg_val) {
                mail(trim($tg_val), $subject, $ml_body, $ml_header);
                #echo '◆送信先='.trim($tg_val).'<br />';
                #echo '◆件名='.$edit_subject.'<br />';
                #echo '◆ヘッダー情報='.$ml_header.'<br />';
                #echo '◆本文='.$ml_body.'<br />';
                #print '｜ＥＮＤ｜<br /><br />';
            }
        }

        return true;
    }
}