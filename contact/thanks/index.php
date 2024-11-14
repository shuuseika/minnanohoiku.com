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
    <div id="loader" class="overlay">
      <div class="loader"></div>
    </div>
    <?php include(DOCUMENT_ROOT."/include/html_body1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/header.php"); ?>

    <button type="button" aria-label="ナビゲーションメニュー" class="nav_toggle" id="nav_toggle"><span class="bd"></span></button>

    <?php # Navigation ?>
      <?php include(DOCUMENT_ROOT."/include/navigation.php"); ?>
    <?php # /Navigation ?>

    <main>
      <div class="content_page--small">
        <ol class="topicpath block_content">
          <li class="home"><a href="<?php echo HOME_URL; ?>/">HOME</a></li>
          <li><?php echo $pagetitle;?></li>
        </ol>
      </div>

      <section class="block_section_large ">
        <div class="bg_gray padding_content_large">
          <div class="content_page--small">
            <h2 class="headline1 block_content_large">お問い合わせありがとうございました。</h2>

            <div class="box5">
              <p class="typography5 block_paragraph">
                ご入力されたアドレスに自動返信メールが配信されます。<br>
                自動返信メールが届かない場合は、恐れ入りますが送信内容をご確認のうえ、再度お問い合わせフォームより内容を送信いただきますようお願いいたします。
              </p>
              <p class="typography5 block_content">
                お問い合わせ内容を確認次第、担当者より折り返しご連絡いたしますので今しばらくお待ちください。<br>
                その他、何かご不明な点等ございましたら、お気軽にお問い合わせください。
              </p>

              <div class="flex_type4">
                <a href="<?php echo HOME_URL;?>/" class="btn1">トップへ戻る</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <?php # フッター ?>
    <?php include(DOCUMENT_ROOT."/include/footer.php"); ?>

    <?php include(DOCUMENT_ROOT."/include/html_body2.php"); ?>

    <script>
      // ロード
      $(window).on('load', function() {
        $('#mainimage').addClass('load');
        $('#loader').fadeOut();
      });
    </script>
  </body>
</html>
