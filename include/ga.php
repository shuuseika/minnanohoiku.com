<?php if(THIS_SERVER === 'public') {
	#本番環境のみアナリティクスコードを読む ?>
	<?php if($is_amp !== 'amp-page') {
	#非アンプページのアナリティクスコード ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NM58JWG"
    height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
  <?php } elseif($is_amp === 'amp-page') {
	#アンプページのアナリティクスコード ?>
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<?php } ?>
<?php } ?>
