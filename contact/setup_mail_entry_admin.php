<?php
$outputSorce = '';
$outputSorce .= '----------------------------------------------------------------------'."\n";
$outputSorce .= '本メールはプログラムからの自動的送信メールです。'."\n";
$outputSorce .= 'こちらのメールへはご返信いただけません。予めご了承ください。'."\n";
$outputSorce .= '----------------------------------------------------------------------'."\n";
$outputSorce .= ''."\n";
$outputSorce .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
$outputSorce .= '【トリサンクリエイター関西へのお問い合わせ】'."\n";
$outputSorce .= '━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━'."\n";
$outputSorce .= ''."\n";
$outputSorce .= $sendDataBox['name']['value'].'様'."\n";
$outputSorce .= ''."\n";
$outputSorce .= 'この度はトリサンクリエイター関西 ポテンシャル採用プランについてお問い合わせいただき有難うございます。'."\n";
$outputSorce .= 'お問い合わせ内容を確認し、担当よりご連絡差し上げます。'."\n";
$outputSorce .= '今しばらくお待ちくださいませ。'."\n";
$outputSorce .= ''."\n";
# お知らせ掲載
include(DOCUMENT_ROOT."/include/mail/notice.php");
$outputSorce .= ''."\n";
$outputSorce .= '-------------------------------------------------------------------'."\n";
$outputSorce .= ''."\n";
$outputSorce .= '[ご入力者様情報]'."\n";
$outputSorce .= '会社名'.'：'.hscd($sendDataBox['company']['value'])."\n";
$outputSorce .= '担当者名'.'：'.$sendDataBox['name']['value']."\n";
$outputSorce .= 'メールアドレス'.'：'.$sendDataBox['email']['value']."\n";
$outputSorce .= '電話番号'.'：'.$sendDataBox['tel']['value']."\n";
$outputSorce .= 'お問い合わせ内容'.'：'.hscd($sendDataBox['comment']['value'])."\n";
$outputSorce .= ''."\n";
# 署名
include(DOCUMENT_ROOT."/include/mail/signature.php");
