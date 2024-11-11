<?php #Polyfillここから ?>
<?php
# IE対策を以下に記述
if (strstr(UA, 'Trident') || strstr(UA, 'MSIE')) : ?>
<!--[if lte IE 9]>
<?php if(IS_JQUERY): ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php endif;?>
<script src="<?php echo HOME_URL; ?>/assets/js/iefix/rem.min.js"></script>
<script src="<?php echo HOME_URL; ?>/assets/js/iefix/flexibility.js"></script>
<script src="<?php echo HOME_URL; ?>/assets/js/iefix/rAF.js"></script>
<script>
/******************************
* Flexibily
*****************************/
flexibility(document.documentElement);
</script>
<![endif]-->
<?php
endif;

# EDGE対策を以下に記述
if (strstr(UA, 'Edge')) : ?>

<?php
endif;

# IE・EDGE対策を以下に記述
if (strstr(UA, 'Trident') || strstr(UA, 'MSIE') || strstr(UA, 'Edge')) { ?>
<script src="<?php echo LP_URL;?>/assets/js/iefix/ofi.min.js"></script>
<script>
/******************************
 * Object-Fit-Images
 *****************************/
window.addEventListener('DOMContentLoaded', function () {
  var objFit = document.getElementsByClassName('objfit');
  if(objFit) objectFitImages(objFit);
});
</script>
<?php } ?>
<?php #Polyfillここまで ?>
