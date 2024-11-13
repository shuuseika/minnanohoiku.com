<?php
$outputSorce = '';
$outputSorce .= '----------------------------------------------------------------------'."\n";
$outputSorce .= '本メールはプログラムからの自動的送信メールです。'."\n";
$outputSorce .= 'こちらのメールへはご返信いただけません。予めご了承ください。'."\n";
$outputSorce .= '----------------------------------------------------------------------'."\n";
$outputSorce .= ''."\n";
$outputSorce .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
$outputSorce .= '【みんなの保育】お問い合わせ'."\n";
$outputSorce .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
$outputSorce .= ''."\n";
if(!isset($sendMailAdminFlag)) {
  $outputSorce .= $sendDataBox['name']['value'].'様'."\n";
  $outputSorce .= ''."\n";
}
if(isset($sendMailAdminFlag)) {
  $outputSorce .= '下記情報のお問い合わせがありました。'."\n";
} else {
  $outputSorce .= 'この度は、みんなの保育へお問い合わせいただきありがとうございます。'."\n";
  $outputSorce .= 'お問い合わせ内容を確認次第、担当者より折り返しご連絡いたします。'."\n";
  $outputSorce .= '恐れ入りますが、今しばらくお待ちいただきますようお願いいたします。'."\n";
}
$outputSorce .= ''."\n";
# お知らせ掲載
include(DOCUMENT_ROOT."/include/mail/notice.php");
$outputSorce .= ''."\n";
$outputSorce .= '-------------------------------------------------------------------'."\n";
$outputSorce .= ''."\n";
$outputSorce .= '[ご入力者様情報]'."\n";
$outputSorce .= 'お名前'.'：'.$sendDataBox['name']['value']."\n";
$outputSorce .= 'メールアドレス'.'：'.$sendDataBox['email']['value']."\n";
$outputSorce .= '電話番号'.'：'.$sendDataBox['tel']['value']."\n";
$outputSorce .= 'お問い合わせ内容'.'：'.hscd($sendDataBox['comment']['value'])."\n";
$outputSorce .= 'お仕事情報を希望する：';
if($sendDataBox['job']['value'] == "希望する") {
  $outputSorce .= '希望する';
} else {
  $outputSorce .= '希望しない';
}
$outputSorce .= ''."\n";
# 署名
include(DOCUMENT_ROOT."/include/mail/signature.php");
