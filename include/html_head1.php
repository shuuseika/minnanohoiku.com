<?php if (SITE_THEME): ?>
<link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,500,700&display=swap&subset=japanese" rel="stylesheet">
<link href="<?php echo THEME_URL; ?>/assets/css/theme.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<?php endif; ?>

<?php if(THIS_SERVER === 'local'): ?>
<link href="<?php echo ASSETS_URL; ?>/css/accessibility-check.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<?php endif;?>

<?php #IE対策
if( (strstr(UA, 'Trident') || strstr(UA, 'MSIE')) && SITE_THEME) { ?><?php /* IE対策 */ ?>
<!--[if lte IE 9]>
<link href="<?php echo THEME_URL; ?>/assets/css/browser-fix/ie_lt9.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<![endif]-->

<link href="<?php echo THEME_URL;?>/assets/css/browser-fix/ie.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<?php } #EDGE対策
if(strstr(UA, 'Edge')) { ?>
<link href="<?php echo THEME_URL;?>/assets/css/browser-fix/edge.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<?php } #Firefox対策
if(strstr(UA, 'Firefox')) { ?>
<link href="<?php echo THEME_URL;?>/assets/css/browser-fix/firefox.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<?php } #Safari対策
if(strstr(UA, 'Safari') && !(strstr(UA, 'Chrome')) ) { ?>
<link href="<?php echo THEME_URL;?>/assets/css/browser-fix/safari.css<?php echo '?version='.cashedate();?>" rel="stylesheet">
<?php } ?>
