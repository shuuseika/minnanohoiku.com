<?php
require_once("include/config.php"); #サーバー環境の識別
require_once("aur_lib/function.php"); #関数の読み込み

require_once("aur_lib/mailform/include/form_head.php");

$pagename = 'top';
$pagegrp = 'top';
$subpageflag = false;

# デスクリプションタグ
$meta_description = '';
?>
<!DOCTYPE html>
<html lang="ja">
  <head prefix="og: http://ogp.me/ns# website: http://ogp.me/ns/website#">
    <?php include(DOCUMENT_ROOT."/include/ga.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_meta.php"); ?>
    <meta name="keywords" content="<?php foreach($site_keywords as $keyword) echo $keyword.',';?>">
    <meta name="description" content="<?php echo $meta_description;?>">

    <!-- オープングラフタグ -->
    <meta property="og:title" content="<?php echo $site_title;?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo HOME_URL.'/';?>">
    <meta property="og:image" content="<?php echo HOME_URL;?>/assets/img/fbimage.jpg">
    <meta property="og:site_name" content="<?php echo $site_title;?>">
    <meta property="og:description" content="<?php echo $meta_description;?>">
    <?php /* Twitter設定(summary/summarylargeimage/photo/gallery/app) */ ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $site_title;?>">
    <meta name="twitter:description" content="<?php echo $meta_description;?>">
    <meta name="twitter:image" content="<?php echo HOME_URL;?>/assets/img/fbimage.jpg">
    <!-- オープングラフタグここまで -->

    <title><?php echo $site_title; ?></title>
    <?php include(DOCUMENT_ROOT."/include/html_head1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_head2.php"); ?>
  </head>
  <body class="top">
    <div id="loader" class="overlay">
      <div class="loader"></div>
    </div>
    <?php include(DOCUMENT_ROOT."/include/html_body1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/header.php"); ?>

    <button type="button" aria-label="ナビゲーションメニュー" class="nav_toggle" id="nav_toggle"><span class="bd"></span></button>

    <?php # Navigation ?>
      <?php include(DOCUMENT_ROOT."/include/navigation.php"); ?>
    <?php # /Navigation ?>

    <?php # Mainimage ?>
    <div id="mainimage" class="mainimage">
      <div class="mainimage__detail">
        <div class="mainimage__detail-inner">
          <img src="<?php echo ASSETS_URL;?>/svg/puzzle01.svg" alt="" class="mainimage__puzzle">
          <p class="mainimage__logo">
            <img src="<?php echo ASSETS_URL;?>/svg/logo01.svg" alt="みんなの保育 保育士派遣サービス">
          </p>
          <h1 class="mainimage__maintext">
            あなたのキャリアを応援する、<br><strong class="mainimage__maintext-strong">信頼の保育士派遣サービス</strong>
          </h1>

          <p class="mainimage__paragraph">
            大阪・奈良・兵庫で、あなたにぴったりの職場を見つけます
          </p>

          <a href="#contact" class="btn1--mainimage">
            今すぐ相談
            <i class="icon-arrow01 btn1__icon" aria-hidden="true"></i>
          </a>
        </div>
      </div>
      <figure class="mainimage__image">
        <?php set_img(ASSETS_URL.'/img/mainimage_bg@2x.jpg','','objfit'); ?>
      </figure>

      <a href="#service" class="mainimage__more">
        <img src="<?php echo ASSETS_URL;?>/svg/scroll-more.svg" alt="MORE">
      </a>
    </div>
    <?php # /Mainimage ?>

    <main>
      <?php # Service ?>
      <section id="service" class="content-about block_section_large">
        <div class="content_page">
          <img src="<?php echo ASSETS_URL;?>/svg/puzzle01.svg" alt="" class="content-about__puzzle">

          <p class="block_content">
            <strong class="headline1--vari2">みんなの保育では<br>あなたにピッタリの<br class="over_lp_none">お仕事をご紹介します</strong>
          </p>

          <h2 class="typography3 block_content">『<span class="color_text_primary">みんなの保育</span>』とは？</h2>

          <p class="block_content typography4 text_center">
            『みんなの保育』は、大阪・奈良・兵庫エリアで保育士派遣サービスを提供しています。<br>
            保育士の皆さまが安心して働けるよう、コーディネーターがサポート。<br>
            柔軟な働き方で、保育施設と保育士をつなぎ、子どもたちの未来を支えます。
          </p>

          <div class="content_page--small">
            <div class="flex_type4 __gutters" data-animation="true">
              <div class="fitem fol_pc_4 fol_lp_4 fol_tb_12 fol_sp_12">
                <section class="box2">
                  <figure class="box2__image">
                    <?php set_img(ASSETS_URL."/img/img01@2x.jpg","保育士派遣"); ?>
                  </figure>
                  <div class="box2__detail">
                    <h3 class="box2__headline">
                      保育士派遣
                    </h3>
                    <p class="box2__paragraph">
                      『みんなの保育』では、ひとりひとりのご希望に応じた勤務地や勤務条件の保育士派遣のお仕事をご紹介します。<br>
                      働きやすい環境で保育士としてご活躍いただけるよう、私たちコーディネーターが、あなたに最適な職場探しをサポートします。
                    </p>
                  </div>
                </section>
              </div>
              <div class="fitem fol_pc_4 fol_lp_4 fol_tb_12 fol_sp_12">
                <section class="box2">
                  <figure class="box2__image">
                    <?php set_img(ASSETS_URL."/img/img02@2x.jpg","紹介予定派遣"); ?>
                  </figure>
                  <div class="box2__detail">
                    <h3 class="box2__headline">
                      紹介予定派遣
                    </h3>
                    <p class="box2__paragraph">
                      新しい職場を探している保育士の方へ、経験やご希望に基づいたお仕事探しを丁寧にサポートします。<br>
                      面接対策や履歴書の書き方のアドバイスも行います。
                    </p>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php # /Service ?>

      <?php # Area ?>
      <section id="area" class="layout-recruit" data-animation="true">
        <p class="block_content">
          <strong class="headline1--vari2">対応エリア</strong>
        </p>
        <div class="layout1 block_section_large">
          <figure class="layout1__image">
            <?php set_img(ASSETS_URL."/img/img03@2x.jpg","対応エリア","objfit"); ?>
          </figure>

          <div class="box4">
            <h2 class="box4__headline">お仕事紹介エリア</h2>

            <p class="block_paragraph typography4">
              『みんなの保育』は下記エリアでお仕事を紹介しています。<br>
              あなたのお住まいや希望に応じた職場をご提案します。
            </p>

            <div class="box4__detail">
              <ul class="list-check">
                <li class="list-check__item">
                  <span class="list-check__content">
                    大阪市を中心とした大阪府下全域
                  </span>
                </li>
                <li class="list-check__item">
                  <span class="list-check__content">
                    奈良県
                  </span>
                </li>
                <li class="list-check__item">
                  <span class="list-check__content">
                    兵庫県
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <?php # /Area ?>

      <?php # Salary ?>
      <section id="salary" class="layout2 __padding-large block_section_large" data-animation="true">
        <figure class="layout2__image">
          <?php set_img(ASSETS_URL."/img/background01@2x.jpg","給与について","objfit"); ?>
        </figure>

        <div class="box3">
          <h2 class="box3__headline">給与について</h2>

          <div class="box3__detail">
            <ol class="list-point">
              <li class="list-point__item">
                <span class="list-point__head">派遣給与</span>
                <span class="list-point__content">
                  お給料は派遣先や勤務時間によって異なりますが、ご希望に合わせた条件でご紹介いたします。<br>
                  詳しい給与条件はお気軽にご相談ください。
                </span>
              </li>
            </ol>
          </div>
        </div>
      </section>
      <?php # /Salary ?>

      <?php # Voice ?>
      <section id="voice" class="layout-recruit" data-animation="true">
        <p class="block_content">
          <strong class="headline1--vari2">ご利用の方の声</strong>
        </p>
        <div class="layout1 block_section_large __reverse">
          <figure class="layout1__image">
            <?php set_img(ASSETS_URL."/img/img04@2x.jpg","ご利用の方の声","objfit"); ?>
          </figure>

          <div class="box4">
            <h2 class="box4__headline">ご利用の方の声</h2>

            <p class="block_paragraph typography4">
              働く方々の体験談
            </p>

            <p class="block_content typography5 __flex">
              <img src="<?php echo ASSETS_URL;?>/svg/quote.svg" class="typography5__quote">
              <span>丁寧かつ迅速にご対応いただき感謝しております。保育のお仕事が初めてでしたがいろいろとご配慮いただいたので負担感なくお仕事を続けることが出来ております。<span class="typography5__subtext">(50代・女性)</span></span>
            </p>
            <p class="block_content typography5 __flex">
              <img src="<?php echo ASSETS_URL;?>/svg/quote.svg" class="typography5__quote">
              <span>困った時に連絡すると、すぐ対応して下さるので心強く思っています。満足しています。<span class="typography5__subtext">(50代・女性)</span></span>
            </p>
            <p class="typography5 __flex">
              <img src="<?php echo ASSETS_URL;?>/svg/quote.svg" class="typography5__quote">
              <span>些細なことも相談しやすく頼りにしております。通える範囲すべての 保育園やこども園の募集状況を聞いてくださり、とても迅速に対応してくれました。<span class="typography5__subtext">(30代・女性)</span></span>
            </p>
          </div>
        </div>
      </section>
      <?php # /Voice ?>

      <?php # FAQ ?>
      <section id="faq" class="block_section_large ">
        <div class="bg_gray padding_content_large">
          <div class="content_page--small">
            <h2 class="headline1 block_content_large">よくあるご質問</h2>

            <div class="box5">
              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q1</span>
                  <span class="list-faq__head-headline">派遣のお仕事はどのように申し込むのですか?</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    お問い合わせフォームやLINEでの応募が可能です。追って担当よりご連絡させていただきます。
                  </span>
                </dd>
              </dl>

              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q2</span>
                  <span class="list-faq__head-headline">お給料はどのくらいですか？</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    お給料は派遣先や勤務時間によって異なりますが、ご希望に合わせた条件でご提案いたします。<br>
                    詳しい給与条件はお気軽にご相談ください。
                  </span>
                </dd>
              </dl>

              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q3</span>
                  <span class="list-faq__head-headline">お仕事決定までのプロセスはどのようになりますか?</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    まずはご応募していただき、コーディネーターがご希望やご経験をヒアリングします。その後、条件に合ったお仕事をご提案し、職場見学や面接のサポートを行います。ご納得いただいた上でお仕事が決定し、勤務開始となります。
                  </span>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </section>
      <?php # /FAQ?>

      <?php # Contact ?>
      <section id="contact" class="block_section_large ">
        <div class="content_page--small">
          <h2 class="headline1--vari1 block_content_large">
            <span class="headline1__subtext">CONTACT US</span>
            お気軽にお問い合わせください
          </h2>

          <p class="block_paragraph typography1">
            お仕事のことやキャリアについての相談をお待ちしています。<br>あなたの次のステップを一緒に考えましょう。
          </p>

          <p class="typography4 block_content text_center">
            お問い合わせは下記フォーム、もしくはお電話よりお問い合わせいただけます。
          </p>

          <div class="tel1 block_content">
            <i class="icon-tel01 tel1__icon" aria-hidden="true"></i>
            <a href="tel:0663146001" class="tel1__detail hover_alpha">
              <div class="tel1__number">
                06-6314-6001
              </div>
              <span class="tel1__subtext">
                受付時間 9：30〜18：30（平日）
              </span>
            </a>
          </div>

          <form class="h-adr" name="form1" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>#form1" id="form1" <?php if($FormBuilder->isMultipart()) echo 'enctype="multipart/form-data"';?>>
            <table class="table1 block_content_large">
              <tr>
                <th class="table1__thead">
                  <?php echo $FormBuilder->getLabel('name'); ?>
                  <?php if($FormBuilder->isRequire('name')) {?><span class="asterisk">必須</span><?php }?>
                </th>
                <td class="table1__titem">
                  <?php $FormBuilder->createInput('name'); ?>
                </td>
              </tr>
              <tr>
                <th class="table1__thead">
                  <?php echo $FormBuilder->getLabel('email'); ?>
                  <?php if($FormBuilder->isRequire('email')) {?><span class="asterisk">必須</span><?php }?>
                </th>
                <td class="table1__titem">
                  <?php $FormBuilder->createInput('email'); ?>
                </td>
              </tr>
              <tr>
                <th class="table1__thead">
                  <?php echo $FormBuilder->getLabel('tel'); ?>
                  <?php if($FormBuilder->isRequire('tel')) {?><span class="asterisk">必須</span><?php }?>
                </th>
                <td class="table1__titem">
                  <?php $FormBuilder->createInput('tel'); ?>
                </td>
              </tr>
              <tr>
                <th class="table1__thead">
                  <?php echo $FormBuilder->getLabel('comment'); ?>
                  <?php if($FormBuilder->isRequire('comment')) {?><span class="asterisk">必須</span><?php }?>
                </th>
                <td class="table1__titem">
                  <?php $FormBuilder->createInput('comment'); ?>
                </td>
              </tr>
              <tr>
                <th class="table1__thead">
                  <?php echo $FormBuilder->getLabel('job'); ?>
                  <?php if($FormBuilder->isRequire('job')) {?><span class="asterisk">必須</span><?php }?>
                </th>
                <td class="table1__titem">
                  <?php $FormBuilder->createInput('job'); ?>
                </td>
              </tr>
              <tr>
                <th class="table1__thead">
                  個人情報の取り扱い<span class="asterisk">必須</span>
                </th>
                <td class="table1__titem">
                  <div class="block_parts">
                    <?php $FormBuilder->createAgreement(); ?>
                  </div>
                  <span class="table1__subtext">
                    <img src="<?php echo ASSETS_URL;?>/svg/link.svg">「<a href="https://torisan-net.com/privacy/" target="_blank" class="anchor1">プライバシーポリシー</a>」を送信前にご確認ください。
                  </span>
                </td>
              </tr>
            </table>

            <button type="submit" name='actiontype' value="submit" class="btn2--mauto">送信する</button>

            <input type="hidden" name="form_token" value="<?php echo session_id();?>">

          </form>
        </div>
      </section>
      <?php # /Contact ?>

      <?php # Company ?>
      <section id="company" class="layout2 block_section_large" data-animation="true">
        <figure class="layout2__image">
          <?php set_img(ASSETS_URL."/img/background02@2x.jpg","運営会社情報","objfit"); ?>
        </figure>

        <div class="box3">
          <h2 class="box3__headline">運営会社情報</h2>

          <div class="box3__detail">
            <ol class="list-point">
              <li class="list-point__item">
                <span class="list-point__head">派遣給与</span>
                <span class="list-point__content">
                  株式会社 トリサン　Torisan Co., Ltd.
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">設立</span>
                <span class="list-point__content">
                  2008年3月
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">代表者</span>
                <span class="list-point__content">
                  代表取締役　鳥山　進
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">所在地</span>
                <address class="list-point__content">
                  大阪本社<br>
                  〒530-0028　<br class="over_lp_none">大阪府大阪市北区万歳町3-20 <br class="over_lp_none">北大阪ビルディング6階<br>
                  東京開発<br>
                  〒101-0032　<br class="over_lp_none">東京都千代田区岩本町3-2-9 <br class="over_lp_none">滝清ビル4階<br>
                  沖縄事務所<br>
                  〒900-0033　<br class="over_lp_none">沖縄県那覇市久米2-3-15 <br class="over_lp_none">COI那覇ビル5階
                </address>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">法務顧問</span>
                <span class="list-point__content">
                  弁護士：小島 幸保（小島法律事務所）
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">税務顧問</span>
                <span class="list-point__content">
                  税理士：前田 興二（税理士法人ほはば）
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">従業員数</span>
                <span class="list-point__content">
                  従業員数 40名（2022年12月現在）
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">許認可</span>
                <span class="list-point__content">
                  一般労働者派遣事業許可証　許可番号 般27-302025<br>
                  有料職業紹介事業認可証　許可番号 27-ユ-301802
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">取引銀行</span>
                <span class="list-point__content">
                  りそな銀行 / 南森町支店<br>
                  三井住友銀行 / 天満橋支店<br>
                  大阪信用金庫 / 南森町支店
                </span>
              </li>
              <li class="list-point__item __full">
                <span class="list-point__head">労働者派遣法第２３条第５項に基づく情報提供について</span>
                <span class="list-point__content">
                  労働者派遣法第２３条第５項及び同法施行規則第１８条の２第３項に基づく労働者派遣事業に関わる情報提供につきましては、大阪本社までお問い合わせください。
                </span>
              </li>
            </ol>
          </div>
        </div>
      </section>
      <?php # /Company ?>
    </main>

    <?php # フッター ?>
    <?php include(DOCUMENT_ROOT."/include/footer.php"); ?>

    <?php # Lineへのリンク ?>
    <a id="fix-button" class="fix-button" href="https://line.me/R/ti/p/@706farfj?ts=11111617&oat_content=url" target="_blank" rel="noopener">
      <?php set_img(ASSETS_URL."/img/line@2x.png","LINEで登録する","fix-button__photo"); ?>
    </a>

    <?php include(DOCUMENT_ROOT."/include/html_body2.php"); ?>

    <script>
      // ロード
      $(window).on('load', function() {
        $('#mainimage').addClass('load');
        $('#loader').fadeOut();
      });
    </script>

    <script>
      //フォームの項目同士で紐付けがある場合の処理
      var relationItems = JSON.parse('<?php echo json_encode( $FormBuilder->getRelationItems() ); ?>');
      //console.log(relationItems);
    </script>

    <?php #フォーム用のスクリプト?>
    <script src="<?php echo HOME_URL;?>/aur_lib/mailform/system/js/script.js"></script>
  </body>
</html>
