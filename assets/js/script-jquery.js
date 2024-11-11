/**--------------------------------------------------------
 * タブ切り替え
 * parent...アコーディオンのボックス
 * head...タブメニュー部分のコンテナ
 * head-item...タブメニュー
 * body...コンテンツ部分のコンテナ
 * body-item...コンテンツアイテム
 * 
 *-------------------------------------------------------- */
$(function () {
  var tabHeadItems = $('[data-tab="head-item"] a');
  var tabBodyItems = $('[data-tab="body-item"]');

  // タブメニュークリックでコンテンツを切り替え
  tabHeadItems.on('click', function(event) {
    event.preventDefault();
    if(!$(this).hasClass('active')) {
      tabHeadItems.removeClass('active');
      $(this).addClass('active');

      var href = $(this).attr('href');
      $('[data-tab="body-item"]').removeClass('active');
      $('#' + href.split('#')[1] + '[data-tab="body-item"]').addClass('active');

      var url = '#' + href.split('#')[1];
      window.history.pushState(null,null,url);
    }
  });

  // ページロード時の表示コンテンツ
  $(window).on('load', function () {
    var url = location.href;
    if( url.match(/#/) ) {
      var hash = url.split('#')[1];

      tabBodyItems.each( function (index) {
        var id = $(this).attr('id');
        
        if(id === hash) {
          tabHeadItems.removeClass('active');
          tabBodyItems.removeClass('active');
          $(this).addClass('active');
          $('[data-tab="head-item"][data-tab-name="' + id + '"]').children('a').addClass('active');

          var url = '#'+id.toString();
          window.history.pushState(null,null,url);

          $('body,html').stop().scrollTop(0);
          
          return false;
        }
      });
    }
    
    // ブラウザ履歴
    if(tabHeadItems) {
      window.onpopstate = function(event) {
        var url = location.href;

        if( url.match(/#/) ) {
          var hash = url.split('#')[1];
          
          tabBodyItems.each( function (index) {
            var id = $(this).attr('id');
            
            if(id === hash) {
              $('body,html').stop().scrollTop(0);

              tabHeadItems.removeClass('active');
              tabBodyItems.removeClass('active');
              $(this).addClass('active');
              $('[data-tab="head-item"][data-tab-name="' + id + '"]').children('a').addClass('active');
              
              return false;
            }
          });
        }
      }
    }
  });
});

/*--------------------------------------------------------
 * アコーディオン
 * parent...アコーディオンのボックス
 * body...閉じている中身
 * toggle...開閉のボタン
 *-------------------------------------------------------- */
$( function () {
  var accordion = $('[data-accordion="parent"]');

  if(accordion) {
    accordion.each(function (index, element) {
      var body = element.find('[data-accordion="body"]');
      var toggle = element.find('[data-accordion="toggle"]');
      
      if (body && toggle) {
        toggle.on('click', function () {
          $(this).toggleClass('active');

          if( $(this).hasClass('active') ) {
            body.slideDown();
            toggle.innerHTML = '閉じる';
          } else {
            body.slideUp();
            toggle.innerHTML = '続きを読む';
          }
        });
      }
    });
  }
});