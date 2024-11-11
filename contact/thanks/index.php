<?php
if( isset($_SESSION['form_token']) ) unset($_SESSION['form_token']);

require_once("../../include/config.php"); #サーバー環境の識別
require_once("../../aur_lib/function.php"); #関数の読み込み

$pagegrp = 'contact'; #ページグループをつける
$pagename = 'contact'; #ページ名をつける
$pagetitle = 'お問い合わせ'; #ページタイトル
$grptitle = 'お問い合わせ'; #ページグループタイトル
$subpageflag = true; #サブページのフラグ

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include(DOCUMENT_ROOT."/include/ga.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/potential-recruit_remarket_head.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_meta.php"); ?>
    <meta name=”robots” content=”noindex”>
    <title>お問い合わせを受け付けました - <?php echo $grptitle;?>｜<?php echo $site_title;?></title>
    <?php include(DOCUMENT_ROOT."/include/html_head1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_head2.php"); ?>
  </head>
  <body class="<?php echo $pagename; ?> subpage thanks">
    <?php include(DOCUMENT_ROOT."/include/potential-recruit_remarket_body1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_body1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/header.php"); ?>
    <main>
      <div class="container">
        <ol class="topicpath">
          <li class="home"><a href="<?php echo HOME_URL; ?>/" class="hover_line blue">HOME</a></li>
          <li><a href="<?php echo HOME_URL.'/'.$pagegrp.'/'; ?>"><?php echo $grptitle;?></a></li>
          <li><?php echo $pagetitle;?></li>
        </ol>

        <h3 class="headline_type1 vari3">お問い合わせありがとうございました。</h3>

        <p class="content_paragraph sp_justify">
          ご入力されたアドレスに自動返信メールが配信されます。<br>
          自動返信メールが届かない場合は、<b><?php echo $site_phone;?></b>までお電話ください。
        </p>
        <p class="content_paragraph sp_justify">
          お問い合わせ内容を確認し、担当者より折り返しご連絡いたしますので今しばらくお待ち下さい。<br>
          その他、何かご不明な点等ございましたら、お気軽にお問い合わせ下さい。
        </p>

        <a href="<?php echo HOME_URL;?>/" class="btn_type2 mauto">トップへ戻る</a>
      </div>
    </main>

    <?php include(DOCUMENT_ROOT."/include/footer.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_body2.php"); ?>
  </body>
</html>
