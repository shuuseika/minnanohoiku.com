/*--------------------------------------------------------
 *
 * 汎用関数
 *
 *-------------------------------------------------------- */

/*--------------------------------------------------------
 * ブラウザのスクロールバーの幅を含まない横幅を取得 Native
 *-------------------------------------------------------- */
function getWinWidth() {
  return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}
/*--------------------------------------------------------
 * 現在のスクロール位置を返す Native
 *-------------------------------------------------------- */
function getPos() {
	return (window.pageYOffset !== undefined) ? window.pageYOffset : document.documentElement.scrollTop;
}
/*--------------------------------------------------------
 * デバイス判定 Native
 *-------------------------------------------------------- */
function getDevice() {
	var ua = window.navigator.userAgent;
	if (ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
			return 'sp';
	} else if (ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0) {
			return 'tab';
	} else {
			return 'other';
	}
}
/*--------------------------------------------------------
 * ブラウザ判定 Native
 *-------------------------------------------------------- */
function getBrws() {
	var userAgent = window.navigator.userAgent.toLowerCase(); //console.log(userAgent);

  if (!userAgent) return 'getBrws(): ユーザーエージェントを取得できませんでした。';

	if (userAgent.match(/(msie|MSIE)/) || userAgent.match(/(T|t)rident/)) {
    //IE9
    if (userAgent.match(/(msie [1-9].)/)) return 'ie9';
		//IE全般
		return 'ie';
	} else if (userAgent.indexOf('chrome') !== -1) {
		//Chrome
    return 'chrome';
	} else if (userAgent.indexOf('safari') !== -1) {
		//Safari
    return 'safari';
	} else if (userAgent.indexOf('firefox') !== -1) {
		//Firefox
    return 'firefox';
	} else if (userAgent.indexOf('opera') !== -1) {
		//Opera
    return 'opera';
	}
	return 'others';
}
/*--------------------------------------------------------
 * ブラウザがIE9以下の場合 注意を表示
 *-------------------------------------------------------- */
(function() {
  if (getBrws() === 'ie9' && localStorage.getItem('browser-update') !== 'require') {
    // 要素をbody開始タグ直後に追加
    var html =
    '<div id="browser_update">' +
      '<div class="bg_browser_update"></div>' +
      '<div class="box_browser_update">' +
        '<p class="headline">ブラウザーを更新してください<span class="subtext">Your browsers does not suported</span></p>' +
        '<p class="paragraph">お使いのブラウザは最新ではありません。<br>ブラウザをアップデートせずにサイトをご利用になる場合、ページによっては内容が正しく表示されない場合があることをご了承ください。</p>' +
        '<button type="button" class="btn_requirement __mauto hover_alpha">サイトを表示する</button>'
      '</div>'
    '</div>';

    document.body.insertAdjacentHTML('afterbegin',html);

    // ボタンクリックで要素を削除
    document.querySelector('.box_browser_update .btn_requirement').onclick = function() {
      document.body.removeChild(document.getElementById('browser_update'));

      // localStorageに保存
      localStorage.setItem( 'browser-update', 'require' );
    };
  }
}());
/*--------------------------------------------------------
 * 要素のTOPの座標を取得 Native
 *-------------------------------------------------------- */
function getElementPotisionTop(elem) {
  var rect = elem.getBoundingClientRect();
  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  return rect.top + scrollTop;
}
/*--------------------------------------------------------
 * 要素グループの高さを統一 Native
 *-------------------------------------------------------- */
(function () {
  if(document.querySelectorAll('[class*=" hgp_"],[class^="hgp_"]')) {
    window.addEventListener('DOMContentLoaded', function () {
      // [hgp_~~]のクラス名がある要素を全て取得
      var elements = document.querySelectorAll('[class*=" hgp_"],[class^="hgp_"]');

      // 取得した要素から[hgp_~~]のクラス名を重複しないように配列に格納していく
      var classNameArray = [];
      for(var i=0; i<elements.length; i++) {
        var allClassNames = elements[i].className.split(' ');
        var hgpClass = allClassNames.filter(function(classname) {
          if (classname.indexOf('hgp_') !== -1) return classname;
        });

        if (classNameArray.indexOf(hgpClass) === -1) {
          classNameArray.push(hgpClass);
        }
      }

      // 配列に格納した[hgp_~~]クラス名ごとに要素の高さを揃える
      for(var i=0; i<classNameArray.length; i++) {
        var hGrp = document.getElementsByClassName(classNameArray[i]);

        // 端末サイズで処理を分岐
        if (hGrp[0].className.indexOf('hgp_pc_') !== -1) {
          if (getWinWidth() > 768) setHeight(hGrp);
        } else if (hGrp[0].className.indexOf('hgp_tb_') !== -1) {
          if (getWinWidth() > 599) setHeight(hGrp);
        } else {
          setHeight(hGrp);
        }
      }
    });
  }
}());

function setHeight(hGrp) {
  var maxHeight = 0;

  for(var i=0; i<hGrp.length; i++) {
    hGrp[i].style.height = 'auto';
    var elemHeight = hGrp.item(i).offsetHeight;

    if(maxHeight == 0 || maxHeight < elemHeight) {
      if(maxHeight < elemHeight) maxHeight = elemHeight;
    }
  }

  for(var j=0; j<hGrp.length; j++) {
    hGrp[j].style.height = maxHeight+'px';
  }
}
/*--------------------------------------------------------
 * リサイズ時の処理 Native
 *-------------------------------------------------------- */
/*
var resizeTimer = false;
window.addEventListener('resize', function() {
  if (resizeTimer !== false) clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
    //ここに処理内容を書く
  }, 200);
});
*/

/*--------------------------------------------------------
 * 指定した座標へスクロールアニメーション Native
 *-------------------------------------------------------- */
function scrollToAnimation(x, y, toX, toY, scrollSpeed, direction){
  var scTop = '';
  var scrollTimer;
  if (direction === 'up') {
    if (y > toY) {
      scTop = Math.floor(y - (y / (scrollSpeed * 2)));
      window.scrollTo(x, scTop);
      scrollTimer = setTimeout(function(){scrollToAnimation(x, scTop, toX, toY, scrollSpeed, 'up');}, scrollSpeed);
      // ↑ y の値が1以下になるまで 少しの数値分だけスクロールアップするのを
      // scrollSpeed の設定時間ごとに繰り返す
    } else {
      clearTimeout(scrollTimer);
      // ↑ y の値が1以下になったらタイマーを止めて数値を引くのをやめる
      window.scrollTo(x, toY);
    }
  } else if(direction === 'down') {
    if (y < toY) {
      scTop = Math.floor(y + (y / (scrollSpeed * 2) + 1));
      if(scTop == 0) scTop++;
      window.scrollTo(x, scTop);
      scrollTimer = setTimeout(function(){scrollToAnimation(x, scTop, toX, toY, scrollSpeed, 'down');}, scrollSpeed);
      // ↑ y の値が1以下になるまで 少しの数値分だけスクロールアップするのを
      // scrollSpeed の設定時間ごとに繰り返す
    } else {
      clearTimeout(scrollTimer);
      // ↑ y の値が1以下になったらタイマーを止めて数値を引くのをやめる
      window.scrollTo(x, toY);
    }
  }
}

/*--------------------------------------------------------
 * ハンバーガーメニュー Native
 *-------------------------------------------------------- */
(function () {
  var navToggle = document.getElementById('nav_toggle'); //ハンバーガーメニューの要素取得

  if (navToggle) {
    navToggle.addEventListener("click", function() {
      this.classList.toggle('active');
      var navGb = document.getElementById('navigation'); //グローバルナビ

      if(this.classList.contains('active')) {
        navGb.classList.add('active');
      } else {
        navGb.classList.remove('active');
      }
    });
  }
}());
/*--------------------------------------------------------
 *	ページトップボタン Native
 *-------------------------------------------------------- */
(function () {
  //ページトップの要素,スクロールスピードの設定
  var pageTopOptions = {
      pageTopBtn : 'pagetop', // トップへ戻るボタンのID名（＃はつけない）
      scrollSpeed : 7, //早い→5　普通→10 ゆっくり→20
  };

  var staticPoint; //ページトップボタンを固定にする位置
  var pageTop = document.getElementById(pageTopOptions.pageTopBtn); //ページトップボタン
  var pageTopFadeTimer = false;

  if(pageTop) {
    //クリックでページトップへ
    pageTop.addEventListener('click', function() {
      //現在のスクロール位置を取得
      var x = document.body.scrollLeft || document.documentElement.scrollLeft;
      var y = document.body.scrollTop  || document.documentElement.scrollTop;
      var toX = x;
      var toY = 0;
      // スクロール位置を toPageTop() 関数へ渡して呼び出す
      scrollToAnimation(x, y, toX, toY, pageTopOptions.scrollSpeed, 'up');
      return false;
    });

    window.addEventListener('load', function() {
      staticPoint = getElementPotisionTop(document.getElementById('footer'));
    });

    window.addEventListener('scroll', function() {
      if (pageTopFadeTimer !== false) clearTimeout(pageTopFadeTimer);
      pageTopFadeTimer = setTimeout(function() {

        //スクロール値が300に達したらボタン表示
        if (getPos() > 300) pageTop.classList.add('fadein');
        else pageTop.classList.remove('fadein');

        //staticPointで位置を固定
        if(getPos() + document.documentElement.clientHeight > staticPoint) pageTop.classList.add("static");
        else pageTop.classList.remove("static");

      }, 10);
    });
  }
}());

/*--------------------------------------------------------
 *  ページ内リンクのスムーズスクロール Native
 *-------------------------------------------------------- */
 /* 同一ページのページ内リンク */
(function () {
  var anchorElements = document.querySelectorAll('a[href^="#"]');

  var pageAnchorOptions = {
    scrollSpeed : 7, //早い→5　普通→10 ゆっくり→20
  };
  for(var i=0; i<anchorElements.length; i++) {
    var id = anchorElements[i].getAttribute('href');
    var target = document.getElementById(id.replace('#',''));
    if (target) anchorElements[i].addEventListener('click', pageAnchorScroll(target, id, pageAnchorOptions));
  }

  /* 他ページに対してのページ内リンク */
  window.addEventListener('load', function() {
    var href = location.href;
    if(href.match(/#/)) {
      var id = href.split("#");
      var target = document.getElementById(id[1]);

      if (target) {
        var position = getElementPotisionTop(target) - getPageAnchorFix();

        var y = document.body.scrollTop  || document.documentElement.scrollTop; //現在のY座標を取得
        var x = document.body.scrollLeft || document.documentElement.scrollLeft; //現在のX座標を取得
        var direction = '';
        if(position > y) direction = 'down';
        else direction = 'up';

        scrollToAnimation(x, y, x, position, pageAnchorOptions.scrollSpeed, direction);
      }
    }
  });
}());

function pageAnchorScroll(target, id, pageAnchorOptions) {
  return function(ev) {
    ev.preventDefault();
    var position = getElementPotisionTop(target) - getPageAnchorFix(); ////移動先要素のy座標を取得
    var y = document.body.scrollTop  || document.documentElement.scrollTop; //現在のY座標を取得
    var x = document.body.scrollLeft || document.documentElement.scrollLeft; //現在のX座標を取得
    var direction = '';
    if(position > y) direction = 'down';
    else direction = 'up';
    scrollToAnimation(x, y, x, position, pageAnchorOptions.scrollSpeed, direction);

    history.pushState(null,null,id );
  };
}

function getPageAnchorFix() {
  var scrollFix = '';

  if(getWinWidth() > 768 && document.getElementById('navigation')) {
    scrollFix = document.getElementById('navigation').offsetHeight;
  }

  return scrollFix;
}

/*--------------------------------------------------------
 *	スマホ用タッチイベント Native
 *-------------------------------------------------------- */
var linkTouchStart = function(){
  return function() {
    var thisAnchor = this;
    var touchPos = getElementPotisionTop(thisAnchor);
    //タッチした瞬間のa要素の、上からの位置を取得。
    var moveCheck = function(){
      var nowPos = getElementPotisionTop(thisAnchor);
      if(touchPos == nowPos){
        thisAnchor.classList.add("hover");
        //タッチした瞬間と0.1秒後のa要素の位置が変わっていなければ hover クラスを追加。
        //リストなどでa要素が並んでいるときに、スクロールのためにタッチした部分にまでhover効果がついてしまうのを防止している。
      }
    };
    setTimeout(moveCheck,100); //0.1秒後にmoveCheck()を実行。
  };
};
var linkTouchEnd = function(){
  return function() {
    var thisAnchor = this;
    var hoverRemove = function(){
      thisAnchor.classList.remove("hover");
    };
    setTimeout(hoverRemove,500);
    //0.5秒後にhoverRemove()を実行。
    //指を離した瞬間にhover効果を切るよりも、要素が変化した手応えを表現できる。
  };
};

/* タッチイベントで上記の関数を呼び出す */
var touchElements = document.querySelectorAll('a,button');
for(var i=0; i<touchElements.length; i++) {
  touchElements[i].addEventListener('touchstart', linkTouchStart(), {passive: true}); //要素をタッチしたらlinkTouchStart()を実行。
  touchElements[i].addEventListener('touchend', linkTouchEnd(), {passive: true}); ///要素から指を離したらlinkTouchEnd()を実行。
}

/*--------------------------------------------------------
 * Android・iPhone・iPad時にhtmlのhoverクラスの削除 Native
 *-------------------------------------------------------- */
if((navigator.userAgent.indexOf('iPhone') > 0 && navigator.userAgent.indexOf( 'iPad') == -1) || navigator.userAgent.indexOf('iPod') > 0 || navigator.userAgent.indexOf('Android') > 0) {
  document.documentElement.classList.remove('hover');
} else {
  document.documentElement.classList.add('hover');
}

/*--------------------------------------------------------
 * スクロール関数 Native
 *-------------------------------------------------------- */
function scrollOff(e){
  e.preventDefault();
}
//PC用
var scroll_event = 'onwheel' in document ? 'wheel' : 'onmousewheel' in document ? 'mousewheel' : 'DOMMouseScroll';
//スクロール禁止用関数
function no_scroll(){
  document.addEventListener( 'touchmove',scrollOff, {passive: false} );
  document.addEventListener( scroll_event,scrollOff, {passive: false} );
}
//スクロール復活用関数
function return_scroll(){
  document.removeEventListener( 'touchmove', scrollOff, {passive: false} );
  document.removeEventListener( scroll_event, scrollOff, {passive: false} );
}

/*--------------------------------------------------------
 * コンテンツのアニメーションフラグ Native
 *-------------------------------------------------------- */
(function() {
  var animationElem = document.querySelectorAll('[data-animation="true"]');

  var scrollAnimationTimer = false;
  window.addEventListener('scroll',function () {
    if (scrollAnimationTimer !== false) clearTimeout(scrollAnimationTimer);

    scrollAnimationTimer = setTimeout(function() {
      for(var i=0;i<animationElem.length;i++) {
        var pos = getElementPotisionTop(animationElem[i]);
        if(getPos() > pos - (document.documentElement.clientHeight * 0.7) ) {
          animationElem[i].classList.remove('hidden');
          animationElem[i].classList.add('load');
        }
      }
    }, 20);
  });

  document.addEventListener('DOMContentLoaded',function() {
    var loadFlag = false;

    if(loadFlag == false) {
      var el = document.querySelectorAll('[data-animation="true"]');
      if(el) {
        for(var i=0;i<el.length;i++) {
          var elPos = getElementPotisionTop(el[i]);
          if(getPos() + window.innerHeight < elPos) {
            el[i].classList.add('hidden');
          }
        }
        loadFlag = true;
      }
    }
  });
}());
/*--------------------------------------------------------
 * ページロードフラグ Native
 *-------------------------------------------------------- */
(function(){
  var loadElem = document.querySelectorAll('[data-load="true"]');

  window.addEventListener('load',function () {
    for(var i=0;i<loadElem.length;i++) {
      loadElem[i].classList.add('load');
    }
  });
}());

/*--------------------------------------------------------
 * 下層ページロードアニメーション Native
 *-------------------------------------------------------- */
 /*
if(document.body.classList.contains('subpage')) {
  var mprogress = new Mprogress('start');

  var progressTimer = setInterval(function() {
    mprogress.inc(0.25);
  }, 200);

  window.onpageshow = function() {
    subpageLoad(mprogress, progressTimer);
  };
  window.addEventListener('load',function() {
    subpageLoad(mprogress, progressTimer);
  });
} else {
  var mprogress = new Mprogress();
}

var pageAnchors = document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="tel"])');
if(pageAnchors) {
  for(var i=0;i<pageAnchors.length;i++) {
    pageAnchors[i].addEventListener('click',subpageAnimationEvent(pageAnchors[i].getAttribute('href')) );
  }
}

function subpageLoad(mprogress, progressTimer) {
  document.getElementById('mover_subpage').classList.remove('pagemove');
  document.getElementById('mover_subpage').classList.add('complete');

  clearInterval(progressTimer);
  mprogress.end();
}

function subpageAnimationEvent(href) {
  return function(ev) {
    ev.preventDefault();
    //console.log(href);
    document.getElementById('mover_subpage').classList.add('pagemove');
    mprogress.set(0.0);

    setTimeout(function() {
      location.href = href;
    }, 150);
  }
}
*/

/*--------------------------------------------------------
 * iOSのキーボード入力の制御
 *-------------------------------------------------------- */
(function() {
  var inputs = document.querySelectorAll('input');
  if(inputs) {
    for(var i=0;i<inputs.length;i++) {
      // submitのクリックイベントを同期処理するためにpassiveはfalseにしておく
      inputs[i].addEventListener('keypress', noEnterKey(inputs[i]), {passive: false});
    }
  }
}());

//「開く」キーを無効化
function noEnterKey(element) {
  return function(e) {
    if( document.documentElement.classList.contains('iphone') || document.documentElement.classList.contains('ipad') ) {
      if(e.keyCode === 13){
        e.preventDefault();

        // 現在フォーカスしている入力欄からフォーカスを外すことで、キーボードを強制的に閉じる
        document.activeElement.blur();
        element.blur();
      }
    }
  }
}