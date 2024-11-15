<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">

<?php #viewport ?>
<?php if($isAmp === 'amp-page') {#AMPページ ?>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
<?php } else {#AMPページのPCページ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php } ?>

<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<?php #favicon ファビコン作成は[http://realfavicongenerator.net/] ?>
<link rel="shortcut icon" href="<?php echo HOME_URL;?>/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="icon" href="<?php echo HOME_URL;?>/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo HOME_URL; ?>/apple-touch-icon.png">
<link rel="icon" type="image/png" href="<?php echo HOME_URL; ?>/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?php echo HOME_URL; ?>/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo HOME_URL; ?>/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?php echo HOME_URL; ?>/site.webmanifest" />
<meta name="theme-color" content="#ffffff">

<?php #canonical&amphtml ?>
<?php if($isAmp === 'amp-page') {#AMPページ ?>
<link rel="canonical" href="<?php echo PROTOCOL.$_SERVER['HTTP_HOST'].preg_replace('/amp\//', '', DIR_FILE);?>">
<?php } elseif($isAmp === 'parent-page') {#AMPページのPCページ ?>
<link rel="amphtml" href="<?php echo PROTOCOL.$_SERVER['HTTP_HOST'].'/amp'.DIR_FILE;?>">
<link rel="canonical" href="<?php echo PROTOCOL.$_SERVER['HTTP_HOST'].DIR_FILE;?>">
<?php } else {#AMP非対応のページ ?>
<link rel="canonical" href="<?php echo PROTOCOL.$_SERVER['HTTP_HOST'].DIR_FILE;?>">
<?php } ?>
