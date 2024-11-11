<?php
require_once("../include/config.php"); #サーバー環境の識別
require_once("../aur_lib/mailform/include/form_head.php");
?>
<?php
$pagename = 'contact'; #ページ名をつける
$pagegrp = 'contact'; #ページグループをつける
$grptitle = 'お問い合わせ'; #親第2階層のページ名
$pagetitle = 'お問い合わせ'; #ページタイトル
$subpageflag = true; #サブページのフラグ
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php include(DOCUMENT_ROOT."/include/potential-recruit_remarket_head.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_meta.php"); ?>
    <meta name="keywords" content="<?php foreach($site_keywords as $keyword) echo $keyword.',';?>">
    <meta name="description" content="">
    <title><?php echo $pagetitle.'｜'.$site_title; ?></title>
    <?php include(DOCUMENT_ROOT."/include/html_head1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_head2.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/ga.php"); ?>
  </head>
  <body class="<?php echo $pagename; ?> subpage">
    <?php include(DOCUMENT_ROOT."/include/potential-recruit_remarket_body1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_body1.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/header.php"); ?>

    <div class="container">
      <ol class="topicpath">
        <li><a href="<?php echo HOME_URL; ?>/">HOME</a></li>
        <?php if($action !== 'confirm'): ?>
          <li><?php echo $pagetitle;?></li>
          <?php else: ?>
            <li><a href="<?php echo HOME_URL; ?>/contact/">お問い合わせ</a></li>
            <li>お問い合わせ確認画面</li>
            <?php endif; ?>
          </ol>
        </div>

        <main>
          <div class="container block_type1">
        <section class="rowblock" id="form1">
          <h3 class="headline_type1 vari1">
            <?php
            if($action !== 'confirm') echo 'お問い合わせフォーム';
            else echo 'お問い合わせ確認画面';
            ?>
          </h3>
          <p class="content_paragraph">
            <?php if($action !== 'confirm'): ?>
            下記項目にご入力いただき、「確認画面へ」を押してください。<span class="asterisk">※</span>印は必須入力項目です。<br>ご提供いただいた個人情報を、同意いただいた利用目的以外に利用することはいたしません。
            <?php else: ?>
            下記でお間違えなければ「送信する」を押してください。
            <?php endif; ?>
          </p>


          <form class="h-adr" name="form1" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>#form1" id="form1" <?php if($FormBuilder->isMultipart()) echo 'enctype="multipart/form-data"';?>>
            <table class="table_type1  content_block">
              <tbody>
                <tr class="<?php echo $FormBuilder->checkRelation('name');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('name'); ?>
                      <?php if($FormBuilder->isRequire('name')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="cf titem"><?php $FormBuilder->createInput('name'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('hirakana');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('hirakana'); ?>
                      <?php if($FormBuilder->isRequire('hirakana')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('hirakana'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('zip');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('zip'); ?>
                      <?php if($FormBuilder->isRequire('zip')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('zip'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('pref');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('pref'); ?>
                      <?php if($FormBuilder->isRequire('pref')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('pref'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('address');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('address'); ?>
                      <?php if($FormBuilder->isRequire('address')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('address'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('tel');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('tel'); ?>
                      <?php if($FormBuilder->isRequire('tel')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('tel'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('fax');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('fax'); ?>
                      <?php if($FormBuilder->isRequire('fax')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('fax'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('email');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('email'); ?>
                      <?php if($FormBuilder->isRequire('email')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('email'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('email_check');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('email_check'); ?>
                      <?php if($FormBuilder->isRequire('email_check')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('email_check'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('comment');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('comment'); ?>
                      <?php if($FormBuilder->isRequire('comment')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('comment'); ?></td>
                </tr>
                <tr class="radio_box <?php echo $FormBuilder->checkRelation('name-radio');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('name-radio'); ?>
                      <?php if($FormBuilder->isRequire('name-radio')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('name-radio'); ?></td>
                </tr>
                <tr class="radio_box <?php echo $FormBuilder->checkRelation('name-check');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('name-check'); ?>
                      <?php if($FormBuilder->isRequire('name-check')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('name-check'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('file1');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('file1'); ?>
                      <?php if($FormBuilder->isRequire('file1')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('file1'); ?></td>
                </tr>
                <tr class="<?php echo $FormBuilder->checkRelation('file2');?>">
                  <th class="thead">
                      <?php echo $FormBuilder->getLabel('file2'); ?>
                      <?php if($FormBuilder->isRequire('file2')) {?><span class="asterisk text_small">※</span><?php }?>
                  </th>
                  <td class="titem"><?php $FormBuilder->createInput('file2'); ?></td>
                </tr>
              </tbody>
            </table>

            <div class="content_block box_type5 __padding_small">
              <h4 class="headline">お客様の個人情報の取り扱いについて</h4>
              <p class="paragraph">
                  株式会社◯◯◯では、個人情報の取り扱いに関する法令・規範の遵守、個人情報の適正な収集、利用、管理を徹底します。<br> お客様からいただいた個人情報は、ご提供いただく際の目的以外に利用することはありません。
                  <br> また、当社は、お客さまよりお預かりした個人情報を適切に管理し、個人情報を第三者に開示いたしません。
              </p>
            </div>

            <div class="text_center content_paragraph">
              <?php $FormBuilder->createAgreement(); ?>
            </div>

            <?php if($inputCheckFlag === true) { ?>
              <?php if($action === 'input' || !($FormBuilder->isValidate())) { ?>
            <div class="box_btns" id="submit_btn">
              <button type="submit" name='actiontype' value="confirm" class="btn_type2 __mauto">確認画面へ</button>
            </div>
              <?php } else { ?>
            <div class="box_btns text_center">
              <button type="submit" class="btn_type2 __inline" name='actiontype' value="return">入力画面へもどる</button>
              <button type="submit" class="btn_type2 __inline" name='actiontype' value="submit">送信する</button>
            </div>
              <?php } ?>
            <?php } else { ?>
            <div class="box_btns">
              <button type="submit" name='actiontype' value="submit" class="btn_type2 __mauto">送信する</button>
            </div>
            <?php } ?>
            <input type="hidden" name="form_token" value="<?php echo session_id();?>">

          </form>
        </section>
      </div>
    </main>

    <?php include(DOCUMENT_ROOT."/include/footer.php"); ?>
    <?php include(DOCUMENT_ROOT."/include/html_body2.php"); ?>

    <script>
      //フォームの項目同士で紐付けがある場合の処理
      var relationItems = JSON.parse('<?php echo json_encode( $FormBuilder->getRelationItems() ); ?>');
      //console.log(relationItems);
    </script>

    <?php #フォーム用のスクリプト?>
    <script src="<?php echo HOME_URL;?>/aur_lib/form/system/js/script.js"></script>
  </body>
</html>
