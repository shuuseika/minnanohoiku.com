<?php #共通スクリプト ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/script-jquery.js<?php echo '?version='.cashedate();?>"></script>
<script src="<?php echo ASSETS_URL; ?>/js/script.js<?php echo '?version='.cashedate();?>"></script>
<?php #テーマ用スクリプト ?>
<?php if (SITE_THEME): ?>
<script src="<?php echo THEME_URL; ?>/assets/js/theme.js<?php echo '?version='.cashedate();?>"></script>
<?php endif; ?>
<?php #ブラウザ・OSの識別 ?>
<script src="<?php echo ASSETS_URL; ?>/js/css_browser_selector.js"></script>
