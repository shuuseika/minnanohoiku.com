<?php
require_once("include/config.php"); #サーバー環境の識別
require_once("aur_lib/function.php"); #関数の読み込み

require_once("aur_lib/mailform/include/form_head.php");

$pagename = 'top';
$pagegrp = 'top';
$subpageflag = false;

# デスクリプションタグ
$meta_description = '『ポテンシャル採用プラン』は、ポテンシャル人材に限定して人材紹介を行う、成功報酬型の特別プランです。紹介手数料は、1名採用につき一律40万円(税別)。クリエイティブ職特化の転職エージェント「トリサンクリエイター関西」が、クリエイター・エンジニア採用の成功をサポートします。';
?>
<!DOCTYPE html>
<html lang="ja">
  <head prefix="og: http://ogp.me/ns# website: http://ogp.me/ns/website#">
    <?php include(DOCUMENT_ROOT."/include/ga.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/potential-recruit_remarket_head.php"); ?>
    <?php include(LP_ROOT."/include/html_meta.php"); ?>
    <meta name="keywords" content="<?php foreach($site_keywords as $keyword) echo $keyword.',';?>">
    <meta name="description" content="<?php echo $meta_description;?>">

    <!-- オープングラフタグ -->
    <meta property="og:title" content="<?php echo $site_title;?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo LP_URL.'/';?>">
    <meta property="og:image" content="<?php echo LP_URL;?>/assets/img/fbimage.jpg">
    <meta property="og:site_name" content="<?php echo $site_title;?>">
    <meta property="og:description" content="<?php echo $meta_description;?>">
    <?php /* Twitter設定(summary/summarylargeimage/photo/gallery/app) */ ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $site_title;?>）">
    <meta name="twitter:description" content="<?php echo $meta_description;?>">
    <meta name="twitter:image" content="<?php echo LP_URL;?>/assets/img/fbimage.jpg">
    <!-- オープングラフタグここまで -->

    <title><?php echo $site_title; ?></title>
    <?php include(LP_ROOT."/include/html_head1.php"); ?>
    <?php include(LP_ROOT."/include/html_head2.php"); ?>
  </head>
  <body class="top">
    <?php include(DOCUMENT_ROOT."/include/potential-recruit_remarket_body1.php"); ?>
    <div id="loader" class="overlay">
      <div class="loader"></div>
    </div>
    <?php include(LP_ROOT."/include/html_body1.php"); ?>

    <button type="button" aria-label="ナビゲーションメニュー" class="nav_toggle" id="nav_toggle"><span class="bd"></span></button>

    <?php # Mainimage ?>
    <div id="mainimage" class="mainimage">
      <div class="mainimage__detail">
        <div class="mainimage__detail-inner">
          <img src="<?php echo ASSETS_URL;?>/svg/puzzle01.svg" alt="" class="mainimage__puzzle">
          <p class="mainimage__logo">
            <img src="<?php echo ASSETS_URL;?>/svg/logo01.svg" alt="トリサンクリエイター関西">
          </p>
          <h1 class="mainimage__maintext">
            一律<span class="mainimage__maintext-em">40</span>万円<span class="mainimage__maintext-small">(税別)</span>で<br class="over_tb_none">未来のコア人材の採用を支援！<br>
            トリサンクリエイター関西の<strong class="mainimage__maintext-strong">ポテンシャル採用プラン</strong>
          </h1>

          <dl class="mainimage__dlist">
            <dt class="mainimage__dlist-head">対象職種</dt>
            <dd class="mainimage__dlist-item">Web/DTP</dd>
            <dd class="mainimage__dlist-item">ゲーム</dd>
            <dd class="mainimage__dlist-item">遊技機</dd>
          </dl>

          <p class="mainimage__paragraph">
            『<strong class="typography-bold">ポテンシャル採用プラン</strong>』は、ポテンシャル人材に限定して人材紹介を行う、成功報酬型の特別プランです。紹介手数料は、1名採用につき<strong class="typography-bold">一律40万円</strong><span class="typography-small">(税別)</span>。クリエイティブ職特化の転職エージェント「トリサンクリエイター関西」が、クリエイター・エンジニア採用の成功をサポートします。
          </p>

          <a href="#contact" class="btn1--mainimage">
            相談する
            <span class="btn1__small">(無料)</span>
            <i class="icon-arrow01 btn1__icon" aria-hidden="true"></i>
          </a>
        </div>
      </div>
      <figure class="mainimage__image">
        <?php set_img(ASSETS_URL.'/img/mainimage_bg@2x.jpg','トリサンクリエイター関西の「ポテンシャル採用プラン」','objfit'); ?>
      </figure>

      <a href="#recruit" class="mainimage__more">
        <img src="<?php echo ASSETS_URL;?>/svg/scroll-more.svg" alt="MORE">
      </a>
    </div>
    <?php # /Mainimage ?>

    <?php # Navigation ?>
    <nav id="navigation" class="navigation">
      <div class="content_page">
        <ul class="navigation__list">
          <li class="navigation__list-item">
            <a href="#about" class="navigation__list-anchor">プランについて</a>
          </li>
          <li class="navigation__list-item">
            <a href="#feature" class="navigation__list-anchor">３つの強み</a>
          </li>
          <li class="navigation__list-item">
            <a href="#flow" class="navigation__list-anchor">ご利用の流れ</a>
          </li>
          <?php /*<li class="navigation__list-item">
            <a href="#performance" class="navigation__list-anchor">サービス実績</a>
          </li>*/ ?>
          <li class="navigation__list-item">
            <a href="#faq" class="navigation__list-anchor">よくあるご質問</a>
          </li>
          <li class="navigation__list-item">
            <a href="#contact" class="btn3">無料相談</a>
          </li>
        </ul>
      </div>
    </nav>
    <?php # /Navigation ?>

    <main>
      <?php # Recruit ?>
      <section id="recruit" class="layout-recruit" data-animation="true">
        <div class="layout1 block_section_large">
          <figure class="layout1__image">
            <?php set_img(ASSETS_URL."/img/img01@2x.jpg","企業の採用担当者が抱える問題"); ?>
          </figure>

          <div class="box4">
            <h2 class="box4__headline">企業の採用担当者が抱える問題</h2>

            <div class="box4__detail">
              <ul class="list-check">
                <li class="list-check__item">
                  <span class="list-check__content">
                    求人を出しても全然応募がない
                  </span>
                </li>
                <li class="list-check__item">
                  <span class="list-check__content">
                    内定を出しても入社に至らない
                  </span>
                </li>
                <li class="list-check__item">
                  <span class="list-check__content">
                    紹介会社を利用したいが、手数料が高くて迷っている
                  </span>
                </li>
              </ul>

              <p class="box4__subtext">
                人材確保が予定通り進まなければ、<br>
                事業にも影響が出てくる恐れが…
              </p>
            </div>
          </div>
        </div>

        <div class="content_page--small">
          <p class="block_content_large text_center img1" data-animation="true">
            <?php set_img(ASSETS_URL."/img/text01@2x.png",'しかし、人材の奪い合いは、今後さらなる激化が予想されます。'); ?>
          </p>

          <div class="layout-graph flex_type2 __gutters block_content_large" data-animation="true">
            <div class="fitem fol_pc_5 fol_lp_5 fol_tb_6 fol_sp_12">
              <figure class="box6">
                <img src="<?php echo ASSETS_URL;?>/img/graph01.png" alt="労働人口の推移グラフ">
                <figcaption class="box6__detail">
                  労働人口の減少
                  <span class="typography-small">出典：<a href="http://www.soumu.go.jp/johotsusintokei/whitepaper/ja/h26/html/nc141210.html" target="_blank" rel="nofollow noopenner">総務省<br>「我が国の労働力人口における課題」</a></span>
                </figcaption>
              </figure>
            </div>

            <div class="fitem fol_pc_5 fol_lp_5 fol_tb_6 fol_sp_12">
              <figure class="box6">
                <?php set_img(ASSETS_URL."/img/graph02@2x.png","有効求人倍率の推移グラフ");?>
                <figcaption class="box6__detail">
                  有効求人倍率の高止まり
                  <span class="typography-small">出典：<a href="https://www.mhlw.go.jp/stf/houdou/0000212893_00026.html" target="_blank" rel="nofollow noopenner">厚生労働省<br>「一般職業紹介状況（令和元年10月分）について」</a></span>
                </figcaption>
              </figure>
            </div>
          </div>

          <p class="typography1 block_section_large" data-animation="true">
            いま採用に苦戦している企業は、このままでは厳しい未来を迎えることになりかねません。<br class="under_sp_none">
            だからこそ、今できる対策をすぐにでも検討することが必要です。
          </p>

          <p class="block_content_large text_center img1" data-animation="true">
            <?php set_img(ASSETS_URL."/img/text02@2x.png",'今やるべきこと、それは'); ?>
          </p>
        </div>
      </section>

      <?php # ポテンシャル人材の確保 ?>
      <section class="layout2 block_section_large" data-animation="true">
        <figure class="layout2__image">
          <?php set_img(ASSETS_URL."/img/img02@2x.jpg","「ポテンシャル人材」の確保","objfit"); ?>
        </figure>

        <div class="box3">
          <h2 class="box3__headline">「ポテンシャル人材」の確保</h2>

          <div class="box3__detail">
            <ol class="list-point">
              <li class="list-point__item">
                <span class="list-point__head">POINT 1</span>
                <span class="list-point__content">
                  ポテンシャル人材は実務経験者の採用に比べて、人材を確保しやすい環境になります。
                </span>
              </li>
              <li class="list-point__item">
                <span class="list-point__head">POINT 2</span>
                <span class="list-point__content">
                  ポテンシャル人材＝未来のコア人材。ポテンシャル採用は、戦略的に未来のコア人材を確保する手段であり、今後さらに激化する採用競争に巻き込まれないための最大の対策です。
                </span>
              </li>
            </ol>
          </div>
        </div>
      </section>
      <?php # /ポテンシャル人材の確保 ?>

      <?php # About ?>
      <section id="about" class="content-about block_section_large">
        <div class="content_page">
          <img src="<?php echo ASSETS_URL;?>/svg/puzzle01.svg" alt="" class="content-about__puzzle">

          <p class="block_content">
            <strong class="headline1--vari2">トリサンクリエイター関西が<br>
            貴社にピッタリのポテンシャル人材を<br class="over_tb_none">ご紹介します</strong>
          </p>

          <h2 class="typography3 block_content">『<span class="color_text_primary">ポテンシャル採用プラン</span>』とは？</h2>

          <p class="block_section typography4">
            実務経験はないものの、業界や業務に関する基本知識・スキルをもつポテンシャル人材をご紹介します。完全成功報酬型で、年収に応じた紹介手数料の変動もなし。ポテンシャル採用を行う企業様を支援するための特別なプランです。
          </p>

          <div class="content_page--small">
            <div class="flex_type3 __gutters" data-animation="true">
              <div class="fitem fol_pc_4 fol_lp_4 fol_tb_12 fol_sp_12">
                <section class="box2">
                  <figure class="box2__image">
                    <?php set_img(ASSETS_URL."/img/img03@2x.jpg","社会人経験あり。専門卒もしくは独学で学んでいる"); ?>
                  </figure>
                  <div class="box2__detail">
                    <h3 class="box2__headline">
                      社会人経験あり<br>
                      専門卒もしくは独学で学んでいる
                    </h3>
                    <p class="box2__paragraph">
                      ポテンシャル人材とは、専門学校や独学で基本知識・スキルを習得した方々。さらに社会人経験があり、ビジネスマナーはもちろん、コミュニケーションスキルも備えた人材です。
                    </p>
                  </div>
                </section>
              </div>
              <div class="fitem fol_pc_4 fol_lp_4 fol_tb_12 fol_sp_12">
                <section class="box2">
                  <figure class="box2__image">
                    <?php set_img(ASSETS_URL."/img/img04@2x.jpg","登録者全員のポートフォリオあり"); ?>
                  </figure>
                  <div class="box2__detail">
                    <h3 class="box2__headline">
                      登録者全員の<br class="under_tb_none">ポートフォリオあり
                    </h3>
                    <p class="box2__paragraph">
                      履歴書等に加えて、ポートフォリオでスキルレベルを確認してから書類通過の可否をご判断いただけます。経験者採用と同じく、採用の可能性が高い人材との面接設定が可能です。
                    </p>
                  </div>
                </section>
              </div>
              <div class="fitem fol_pc_4 fol_lp_4 fol_tb_12 fol_sp_12">
                <section class="box2">
                  <figure class="box2__image">
                    <?php set_img(ASSETS_URL."/img/img05@2x.jpg","登録者全員のポートフォリオあり"); ?>
                  </figure>
                  <div class="box2__detail">
                    <h3 class="box2__headline">
                      一律40万円<br>
                      リスクのない成功報酬
                    </h3>
                    <p class="box2__paragraph">
                      入社に至らない場合は、何度面接を行っても費用はかかりません。求人媒体への出稿よりも確実な採用が期待でき、一般的な紹介サービスよりも圧倒的に低い予算での採用を実現することが可能です。
                    </p>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php # /About ?>

      <?php # Feature ?>
      <section id="feature" class="block_section_large">
        <div class="content_page">
          <h2 class="headline1 block_content">３つの強み</h2>

          <p class="block_section typography1">
            納得のいく採用を安心してお任せしていただけます。
          </p>
        </div>

        <div class="layout-feature" data-animation="true">
          <img src="<?php echo ASSETS_URL;?>/svg/puzzle01-white.svg" alt="" class="layout-feature__puzzle">

          <div class="content_page--small">
            <section class="box-feature block_paragraph">
              <div class="box-feature__head">
                <span class="box-feature__icon">
                  <span class="box-feature__icon-small">強み</span>
                  その１
                </span>
                <h3 class="box-feature__headline">
                  開発会社が運営する、<br>
                  クリエイター・エンジニア専門の<br class="over_tb_none">紹介サービス
                </h3>
              </div>
              <p class="box-feature__detail">
                エンターテイメント分野の制作・開発を行う企業が運営する紹介サービス。クリエイターやエンジニアに特化しているため、魅力的なポテンシャル人材の紹介が可能です。
              </p>
            </section>

            <section class="box-feature block_paragraph">
              <div class="box-feature__head">
                <span class="box-feature__icon">
                  <span class="box-feature__icon-small">強み</span>
                  その２
                </span>
                <h3 class="box-feature__headline">
                  元クリエイターによる高精度マッチング
                </h3>
              </div>
              <p class="box-feature__detail">
                企業と登録者をつなぐ営業担当者は、元クリエイター。企業ニーズの細かい把握はもちろん、高い専門性を活かしたマッチングにより、採用の成功を力強くバックアップします。
              </p>
            </section>

            <section class="box-feature">
              <div class="box-feature__head">
                <span class="box-feature__icon">
                  <span class="box-feature__icon-small">強み</span>
                  その３
                </span>
                <h3 class="box-feature__headline">
                  関西に強い！地域密着型エージェント
                </h3>
              </div>
              <p class="box-feature__detail">
                大阪を拠点にサービスを展開しています。登録者は、関西エリアの在住者および勤務希望者が中心。関西エリアでの採用を安心してお任せいただける、地域密着型エージェントです。
              </p>
            </section>
          </div>
        </div>
      </section>
      <?php # /Feature ?>

      <?php # Contact ?>
      <div class="contact1__arrow" data-animation="true">
        <img src="<?php echo ASSETS_URL;?>/svg/arrow-down.svg" alt="" class="">
      </div>

      <section class="contact1 block_section_large" data-animation="true">
        <?php set_img(ASSETS_URL."/img/bg_contact01@2x.jpg","お問い合わせ","objfit"); ?>

        <div class="content_page">
          <h2 class="contact1__headline">CONTACT US</h2>
          <p class="contact1__paragraph">
            クリエイター／エンジニアのポテンシャル採用なら<br>
            トリサンクリエイター関西にお任せください！
          </p>

          <a href="#contact" class="btn1--mauto">
            相談する
            <span class="btn1__small">(無料)</span>
            <i class="icon-arrow01 btn1__icon" aria-hidden="true"></i>
          </a>
        </div>
      </section>
      <?php # /Contact ?>

      <?php # Flow ?>
      <section id="flow" class="block_section_large">
        <div class="content_page">
          <h2 class="headline1 block_content">サービスご利用の流れ</h2>
        </div>

        <div class="content_page">
          <div class="layout-flow" data-animation="true">
            <section class="box-flow">
              <span class="box-flow__index">
                <span class="box-flow__index-current">1</span>/5
              </span>
              <figure class="box-flow__image">
                <?php set_img(ASSETS_URL."/img/icon_service01@2x.png","打ち合わせ、求人票の作成"); ?>
              </figure>
              <h3 class="box-flow__headline hgp_pc_flow">
                打ち合わせ<span class="over_tb_none">・</span><br class="under_sp_none">求人票の作成
              </h3>
              <p class="box-flow__paragraph">
                求める人材のスキルや人物像をはじめ、採用ターゲットの詳細を確認。企業理解を深めたうえで、登録者に企業と仕事の魅力を伝える求人票を作成します。
              </p>
            </section>

            <section class="box-flow">
              <span class="box-flow__index">
                <span class="box-flow__index-current">2</span>/5
              </span>
              <figure class="box-flow__image">
                <?php set_img(ASSETS_URL."/img/icon_service02@2x.png","ポテンシャル人材の推薦"); ?>
              </figure>
              <h3 class="box-flow__headline hgp_pc_flow">
                ポテンシャル人材の推薦<span class="box-flow__headline-small">（書類・ポートフォリオの提出）</span>
              </h3>
              <p class="box-flow__paragraph">
                貴社の条件に合う応募者の履歴書、職務経歴書、ポートフォリオをご確認いただきます。
              </p>
            </section>

            <section class="box-flow">
              <span class="box-flow__index">
                <span class="box-flow__index-current">3</span>/5
              </span>
              <figure class="box-flow__image">
                <?php set_img(ASSETS_URL."/img/icon_service03@2x.png","面接"); ?>
              </figure>
              <h3 class="box-flow__headline hgp_pc_flow">
                面接
              </h3>
              <p class="box-flow__paragraph">
                面接を実施し、選考を進めていただきます。面接日程の調整や合否の連絡等はすべて当社で行うため、選考にかかる業務負担の軽減が可能です。
              </p>
            </section>

            <section class="box-flow">
              <span class="box-flow__index">
                <span class="box-flow__index-current">4</span>/5
              </span>
              <figure class="box-flow__image">
                <?php set_img(ASSETS_URL."/img/icon_service04@2x.png","内定"); ?>
              </figure>
              <h3 class="box-flow__headline hgp_pc_flow">
                内定
              </h3>
              <p class="box-flow__paragraph">
                採用条件通知書の発行など、応募者への対応は当社が行います。内定後のフォローもお任せください。
              </p>
            </section>

            <section class="box-flow">
              <span class="box-flow__index">
                <span class="box-flow__index-current">5</span>/5
              </span>
              <figure class="box-flow__image">
                <?php set_img(ASSETS_URL."/img/icon_service05@2x.png","入社日"); ?>
              </figure>
              <h3 class="box-flow__headline hgp_pc_flow">
                入社日
              </h3>
              <p class="box-flow__paragraph">
                応募者の出社を確認して、本プランの契約が成立します。
              </p>
            </section>
          </div>
        </div>
      </section>
      <?php # /Flow ?>

      <?php # Performance ?>
      <?php /*<section id="performance" class="block_section_large">
        <div class="content_page--small">
          <h2 class="headline1 block_content">サービス実績</h2>

          <p class="block_section typography1">
            有名ゲームメーカーや大手SIer、遊技機部品メーカーをはじめ、<br class="under_sp_none">
            多数の企業様にご利用いただいています！
          </p>

          <ul class="list-performance" data-animation="true">
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_capcom@2x.jpg","CAPCOM","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_naito@2x.jpg","NAITO","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_otwo@2x.jpg","O-TWO","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_itec@2x.jpg","アイテック阪急阪神株式会社","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_magical@2x.jpg","魔法株式会社","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_natsume@2x.jpg","Natsume Atari","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_neuron@2x.jpg","NEUON AGE","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_yukes@2x.jpg","YUKES","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_platinum@2x.jpg","PLATINUM GAMES","list-performance__item-img"); ?>
            </li>
            <li class="list-performance__item">
              <?php set_img(ASSETS_URL."/img/logo_cm@2x.jpg","株式会社クラフト&マイスター","list-performance__item-img"); ?>
            </li>
          </ul>
        </div>
      </section>*/ ?>
      <?php # /Performance ?>

      <?php # Occupation ?>
      <section id="occupation" class="block_section_large">
        <div class="content_page--small">
          <h2 class="headline1 block_section">対象職種</h2>

          <div class="flex_type2 __gutters">
            <div class="fitem fol_pc_6 fol_lp_6 fol_tb_12 fol_sp_12">
              <dl class="box1">
                <dt class="box1__head">
                  <i class="icon-puzzle01 box1__head-icon" aria-hidden="true"></i>
                  <span class="box1__head-headline">Web/DTP</span>
                </dt>
                <dd class="box1__detail">
                  <ul class="box1__list">
                    <li class="box1__list-item">
                      Webプロデューサー・ディレクター
                    </li>
                    <li class="box1__list-item">
                      Webデザイナー
                    </li>
                    <li class="box1__list-item">
                      Webプログラマ
                    </li>
                    <li class="box1__list-item">
                      コーダー
                    </li>
                    <li class="box1__list-item">
                      3Dデザイナー
                    </li>
                    <li class="box1__list-item">
                      DTPオペレーター
                    </li>
                    <li class="box1__list-item">
                      グラフィックデザイナー<span class="box1__text-small">など</span>
                    </li>
                  </ul>
                </dd>
              </dl>
            </div>
            <div class="fitem fol_pc_6 fol_lp_6 fol_tb_12 fol_sp_12">
              <dl class="box1">
                <dt class="box1__head">
                  <i class="icon-puzzle01 box1__head-icon" aria-hidden="true"></i>
                  <span class="box1__head-headline">ゲーム</span>
                </dt>
                <dd class="box1__detail">
                  <ul class="box1__list">
                    <li class="box1__list-item">
                      プロデューサー・ディレクター
                    </li>
                    <li class="box1__list-item">
                      3DCGデザイナー
                    </li>
                    <li class="box1__list-item">
                      3DCGムービー製作
                    </li>
                    <li class="box1__list-item">
                      2DCGデザイナー
                    </li>
                    <li class="box1__list-item">
                      ゲームプログラマ
                    </li>
                    <li class="box1__list-item">
                      サウンドクリエイター
                    </li>
                    <li class="box1__list-item">
                      シナリオライター
                    </li>
                    <li class="box1__list-item">
                      デバッガー<span class="box1__text-small">など</span>
                    </li>
                  </ul>
                </dd>
              </dl>
            </div>
            <div class="fitem fol_pc_6 fol_lp_6 fol_tb_12 fol_sp_12">
              <dl class="box1">
                <dt class="box1__head">
                  <i class="icon-puzzle01 box1__head-icon" aria-hidden="true"></i>
                  <span class="box1__head-headline">遊技機</span>
                </dt>
                <dd class="box1__detail">
                  <ul class="box1__list">
                    <li class="box1__list-item">
                      CGデザイナー
                    </li>
                    <li class="box1__list-item">
                      エフェクトデザイナー
                    </li>
                    <li class="box1__list-item">
                      演出企画
                    </li>
                    <li class="box1__list-item">
                      オーサリング
                    </li>
                    <li class="box1__list-item">
                      プログラマ
                    </li>
                    <li class="box1__list-item">
                      サウンドクリエイター<span class="box1__text-small">など</span>
                    </li>
                  </ul>
                </dd>
              </dl>
            </div>
            <div class="fitem fol_pc_6 fol_lp_6 fol_tb_12 fol_sp_12">
              <dl class="box1">
                <dt class="box1__head">
                  <i class="icon-puzzle01 box1__head-icon" aria-hidden="true"></i>
                  <span class="box1__head-headline">その他</span>
                </dt>
                <dd class="box1__detail">
                  <ul class="box1__list">
                    <li class="box1__list-item">
                      プランナー
                    </li>
                    <li class="box1__list-item">
                      3DCGデザイナー
                    </li>
                    <li class="box1__list-item">
                      オーサリングデザイナー
                    </li>
                    <li class="box1__list-item">
                      コンポジッター<span class="box1__text-small">など</span>
                    </li>
                  </ul>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </section>
      <?php # /Occupation ?>

      <?php # Contact2 ?>
      <section class="contact2 block_section_large">
        <figure class="contact2__image">
          <?php set_img(ASSETS_URL."/img/bg_contact02@2x.jpg","トリサンクリエイター関西へのお問い合わせ","objfit"); ?>
        </figure>
        <div class="contact2__detail">
          <h2 class="contact2__headline">
            経験豊富な担当者が採用のさまざまな<br class="over_tb_none">お悩みにお応えします。<span class="under_sp_none"><br>
            ポテンシャル採用は、トリサンクリエイター関西にお任せください！</span>
          </h2>
          <ul class="contact2__list">
            <li class="contact2__list-item">
              <i class="icon-check01 contact2__list-icon" aria-hidden="true"></i>
              <span class="contact2__list-content">
                キャリアチェンジ（未経験）の採用は、見極めが難しい
              </span>
            </li>
            <li class="contact2__list-item">
              <i class="icon-check01 contact2__list-icon" aria-hidden="true"></i>
              <span class="contact2__list-content">
                未経験者の採用実績がないため、条件面の相場が分からない
              </span>
            </li>
            <li class="contact2__list-item">
              <i class="icon-check01 contact2__list-icon" aria-hidden="true"></i>
              <span class="contact2__list-content">
                同業他社との人材の奪い合いで、採用がなかなか進んでいない
              </span>
            </li>
            <li class="contact2__list-item">
              <i class="icon-check01 contact2__list-icon" aria-hidden="true"></i>
              <span class="contact2__list-content">
                ポテンシャル採用には、経験者採用ほど予算をかけられない
              </span>
            </li>
          </ul>
          <p class="contact2__arrow">
            <?php set_img(ASSETS_URL."/img/text03@2x.png","「ポテンシャル採用プラン」ならこれらの課題を一度に解決！"); ?>
          </p>
          <a href="#contact" class="contact2__btn hover_alpha">
            <div class="contact2__btn-detail">
              <span class="contact2__btn-headline">
                1名につき一律40万円<span class="contact2__btn-headline-small">(税別)</span>
              </span>
              <span class="contact2__btn-subtext">
                ポテンシャル採用を控えていた企業様は、<br class="over_tb_none">今がチャンスです！
              </span>
            </div>
            <div class="contact2__btn1">
              相談する
              <span class="contact2__btn1-small">(無料)</span>
              <i class="icon-arrow01 contact2__btn1-icon" aria-hidden="true"></i>
            </div>
          </a>
        </div>
      </section>
      <?php # /Contact2 ?>

      <?php # FAQ ?>
      <section id="faq" class="block_section_large ">
        <div class="bg_gray padding_content_large">
          <div class="content_page--small">
            <h2 class="headline1 block_content_large">よくあるご質問</h2>

            <div class="box5">
              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q1</span>
                  <span class="list-faq__head-headline">費用はいくらかかりますか？</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    <span class="typography2">ご紹介者1名につき、40万円<span class="typography-small">(税別)</span></span>です。<br>
                    完全成功報酬制のため、入社を確認するまで費用は一切発生しません。
                  </span>
                </dd>
              </dl>

              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q2</span>
                  <span class="list-faq__head-headline">支払い日はいつですか</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    初出社日を請求日とし、翌月末にお支払いいただきます。
                  </span>
                </dd>
              </dl>

              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q3</span>
                  <span class="list-faq__head-headline">採用した方が早期に退職した場合、返金はありますか？</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    今回はポテンシャル採用に特化した特別プランにつき、返金は一切ありません。<br>
                    その代わりとして、成功報酬制で40万円(税別)という低コストでの採用が可能です。予めご了承ください。
                  </span>
                </dd>
              </dl>

              <dl class="list-faq block_content">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q4</span>
                  <span class="list-faq__head-headline">登録者は何名いますか？</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    <span class="typography-bold">約1,000名</span>の転職希望者にご登録いただいております。<br>
                    クリエイティブ職に特化したサービスのため、登録者全員がクリエイターもしくはエンジニアです。
                  </span>
                </dd>
              </dl>

              <dl class="list-faq">
                <dt class="list-faq__head">
                  <span class="list-faq__head-icon">Q5</span>
                  <span class="list-faq__head-headline">求人情報は公開されますか？</span>
                </dt>
                <dd class="list-faq__detail">
                  <span class="list-faq__detail-icon">A</span>
                  <span class="list-faq__detail-content">
                    当社が運営するトリサンクリエイター関西のWebサイトに、企業名を非公開にして掲載します。<br>
                    加えて求人検索エンジンにも出稿しており、既存の登録者だけではなく、新たな応募者の獲得も可能です。
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
            無料ご相談
          </h2>

          <p class="block_paragraph typography1">
          誠に恐れ入りますが、現在受付を休止しております。
          </p>
          <?php /*<p class="block_paragraph typography1">
            クリエイター・エンジニアの採用に関するご相談は<br>
            トリサンクリエイター関西へお気軽にお問い合わせください。
          </p>

          <p class="typography4 block_content">
            お問い合わせは下記フォーム、もしくはお電話よりお問い合わせいただけます。
          </p>

          <div class="tel1 block_content">
            <i class="icon-tel01 tel1__icon" aria-hidden="true"></i>
            <a href="tel:0663146001" class="tel1__detail">
              <div class="tel1__number">
                06-6314-6001
              </div>
              <span class="tel1__subtext">
                受付時間 9：30〜18：80（平日）
              </span>
            </a>
          </div>

          <form class="h-adr" name="form1" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>#form1" id="form1" <?php if($FormBuilder->isMultipart()) echo 'enctype="multipart/form-data"';?>>
            <table class="table1 block_content_large">
              <tr>
                <th class="table1__thead">
                  <?php echo $FormBuilder->getLabel('company'); ?>
                  <?php if($FormBuilder->isRequire('company')) {?><span class="asterisk">必須</span><?php }?>
                </th>
                <td class="table1__titem">
                  <?php $FormBuilder->createInput('company'); ?>
                </td>
              </tr>
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
                  個人情報の取り扱い
                </th>
                <td class="table1__titem">
                  <span class="table1__subtext">
                    「<a href="../privacy/" target="_blank" class="anchor1">個人情報保護方針</a>」と「<a href="../privacy/#site_policy" target="_blank" class="anchor1">サイトポリシー</a>」を送信前にご確認ください。
                  </span>

                  <?php $FormBuilder->createAgreement(); ?>
                </td>
              </tr>
            </table>

            <button type="submit" name='actiontype' value="submit" class="btn2--mauto">送信する</button>

            <input type="hidden" name="form_token" value="<?php echo session_id();?>">

          </form>*/ ?>
        </div>
      </section>
      <?php # /Contact ?>
    </main>

    <footer class="footer" id="footer">
      <div class="content_page">
        <a href="../" target="_blank" class="footer__logo hover_alpha">
          <img src="<?php echo ASSETS_URL;?>/svg/logo01.svg" alt="トリサンクリエイター関西">
        </a>

        <ul class="footer__nav">
          <li class="footer__nav-item">
            <a href="https://torisan-net.com/" target="_blank" class="footer__nav-anchor">運営会社</a>
          </li>
          <li class="footer__nav-item">
            <a href="../privacy/" target="_blank" class="footer__nav-anchor">個人情報保護方針/サイトポリシー</a>
          </li>
          <li class="footer__nav-item">
            <a href="../company/" target="_blank" class="footer__nav-anchor">会社案内</a>
          </li>
        </ul>
      </div>

      <small class="copyright">Copyright © TORISAN CO..LTD All RIGHTS RESERVED.</small>

      <a href="https://www.aura-office.co.jp/" target="_blank" rel="noopener" id="logo_aura" class="hover_alpha"><?php set_img('assets/img/common/logo_aura@2x.png','ホームページ制作会社 アウラ');?></a>
    </footer>

    <?php include(LP_ROOT."/include/html_body2.php"); ?>

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
    <script src="<?php echo LP_URL;?>/aur_lib/mailform/system/js/script.js"></script>
  </body>
</html>
