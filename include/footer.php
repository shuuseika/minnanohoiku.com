<footer class="footer" id="footer">
  <div class="content_page">
    <div class="footer__logo">
      <img src="<?php echo ASSETS_URL;?>/svg/logo01.svg" alt="みんなの保育 保育士派遣サービス">
    </div>

    <ul class="footer__nav">
      <li class="footer__nav-item">
        <a href="https://torisan-net.com/privacy/" target="_blank" class="footer__nav-anchor">プライバシーポリシー</a>
      </li>
    </ul>
  </div>

  <small class="copyright">Copyright © TORISAN CO..LTD All RIGHTS RESERVED.</small>

  <?php if($pagename === 'top'): ?>
    <a href="https://www.aura-office.co.jp/" target="_blank" rel="noopener" id="logo_aura" class="hover_alpha"><?php set_img(ASSETS_URL.'/img/common/logo_aura@2x.png','ホームページ制作会社 アウラ');?></a>
  <?php endif; ?>
</footer>
