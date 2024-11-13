<?php
require_once("../include/config.php"); #サーバー環境の識別
require_once("../aur_lib/function.php"); #関数の読み込み

$pagename = '404'; #ページ名をつける
$pagetitle = '404'; #ページタイトル
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
    <nav id="navigation" class="navigation">
      <ul class="navigation__list">
        <li class="navigation__list-item">
          <a href="../../#service" class="navigation__list-anchor">サービス</a>
        </li>
        <li class="navigation__list-item">
          <a href="../../#area" class="navigation__list-anchor">お仕事エリア</a>
        </li>
        <li class="navigation__list-item">
          <a href="../../#salary" class="navigation__list-anchor">お給与</a>
        </li>
        <li class="navigation__list-item">
          <a href="../../#voice" class="navigation__list-anchor">ご利用者の声</a>
        </li>
        <li class="navigation__list-item">
          <a href="../../#faq" class="navigation__list-anchor">よくあるご質問</a>
        </li>
        <li class="navigation__list-item">
          <a href="../../#company" class="navigation__list-anchor">運営会社</a>
        </li>
        <li class="navigation__list-item">
          <a href="../../#contact" class="btn3">お問い合わせ</a>
        </li>
      </ul>
    </nav>
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
            <h2 class="headline1 block_content_large">ページが見つかりませんでした</h2>

            <div class="box5">
              <p class="typography5 block_content">
                お客様のご入力されたURLは現在使用されておりません。<br>URLをもう一度お確かめになってご入力ください。
              </p>

              <div class="flex_type4">
                <a href="<?php echo HOME_URL;?>/" class="btn1">トップへ戻る</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="footer" id="footer">
      <div class="content_page">
        <a href="../../" target="_blank" class="footer__logo hover_alpha">
          <img src="<?php echo ASSETS_URL;?>/svg/logo01.svg" alt="みんなの保育 保育士派遣サービス">
        </a>

        <ul class="footer__nav">
          <li class="footer__nav-item">
            <a href="https://torisan-net.com/privacy/" target="_blank" class="footer__nav-anchor">プライバシーポリシー</a>
          </li>
        </ul>
      </div>

      <small class="copyright">Copyright © TORISAN CO..LTD All RIGHTS RESERVED.</small>
    </footer>

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
