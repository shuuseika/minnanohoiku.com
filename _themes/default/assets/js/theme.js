/*--------------------------------------------------------
 * ナビゲーションメニュー固定表示 Native
 *-------------------------------------------------------- */
(function() {
  var navFixedTimer = false;
  var nav = document.getElementById('navigation'); //nav要素
  var navHeight; //navの高さ
  var nav_pos; //nav要素のY座標

  if (nav) {
    window.addEventListener('DOMContentLoaded', function() {
      navHeight = nav.offsetHeight;
      nav_pos = getElementPotisionTop(nav) + navHeight;
    });

    window.addEventListener('scroll', function() {
      if (navFixedTimer !== false) clearTimeout(navFixedTimer);
      navFixedTimer = setTimeout(function() {
        if(getWinWidth() > 768) {
          if (getPos() > nav_pos) {
            nav.classList.add('fix');
            document.body.style.paddingTop = navHeight + 'px';
          } else {
            nav.classList.remove('fix');
            document.body.style.paddingTop = '0px';
          }
        }
      }, 10);
    });
  }
}());