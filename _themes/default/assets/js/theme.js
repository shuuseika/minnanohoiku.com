/*--------------------------------------------------------
 * ナビゲーションメニュー固定表示 Native
 *-------------------------------------------------------- */
(function() {
  var navFixedTimer = false;
  var nav = document.getElementById('navigation'); //nav要素
  var navHeight; //navの高さ
  var nav_pos; //nav要素のY座標

  var fixButton = document.getElementById('fix-button'); //固定ボダンの要素取得
  var header = document.getElementById('header'); //ヘッダー

  if (nav) {
    window.addEventListener('DOMContentLoaded', function() {
      navHeight = nav.offsetHeight;
      nav_pos = getElementPotisionTop(nav) + navHeight;
    });

    window.addEventListener('scroll', function() {
      if (navFixedTimer !== false) clearTimeout(navFixedTimer);
      navFixedTimer = setTimeout(function() {
        if(getWinWidth() > 979) {
          if (getPos() > nav_pos) {
            nav.classList.add('fix');
            header.classList.add('fix');
            document.body.style.paddingTop = navHeight + 'px';
          } else {
            nav.classList.remove('fix');
            header.classList.remove('fix');
            document.body.style.paddingTop = '0px';
          }
        }

        if (getPos() > nav_pos) {
          fixButton.classList.add('__active');
        } else {
          fixButton.classList.remove('__active');
        }
      }, 10);
    });
  }
}());