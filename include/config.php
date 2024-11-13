<?php
/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : Site-Info ※
┗━━━━━━━━━━━━━━━━━━━━━━━━*/
$site_title = 'みんなの保育'; #サイト名
$site_domain = 'minnanohoiku.com'; #サイトドメイン
$site_keywords = array('看護師','派遣'); #キーワード

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : 使用テーマ（テーマのディレクトリ名を指定） ※
┗━━━━━━━━━━━━━━━━━━━━━━━━*/
define("SITE_THEME", "default");

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : Google AMP ※
┃	# AMP判定用の変数
┗━━━━━━━━━━━━━━━━━━━━━━━━*/
$isAmp = "";

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : jQuery ※
┃	# jQueryの使用判定(jQueryを利用する場合は"true"に設定)
┗━━━━━━━━━━━━━━━━━━━━━━━━*/
define("IS_JQUERY", true);

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃  ※ SETUP : Browser ※
┗━━━━━━━━━━━━━━━━━━━━━━━━*/
define("UA", $_SERVER['HTTP_USER_AGENT']);

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : DIR_FILE ※
┃	# ディレクトリ名・ファイル名の取得
┗━━━━━━━━━━━━━━━━━━━━━━━━*/
define("DIR_FILE", $_SERVER["REQUEST_URI"]);

/*━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : Protocol ※
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━*/
#SSL接続判定
#さくら共用サーバーの場合...http://coss.jp/watabon/67, http://www.yujakudo.com/blogs/website-admin/shared-ssl/use-shared-ssl-of-sakura/
if(isset($_SERVER['HTTP_X_SAKURA_FORWARDED_FOR'])) {
  $_SERVER['HTTPS'] = 'on';
	$_ENV['HTTPS'] = 'on';
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') define('PROTOCOL', 'https://');
else define('PROTOCOL', 'http://');

  /*━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : Local, Test, Public ※
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━*/
#ローカル、テストサーバー、本番サーバーの識別
$this_server = $_SERVER["DOCUMENT_ROOT"];
if(preg_match('/localhost/', $this_server) || preg_match('/Sites/', $this_server)) {
  #ローカルサーバー
  define("THIS_SERVER", 'local');
} elseif(preg_match('/aura-office.com/', $this_server)) {
  #テストサーバー(d2)
  define("THIS_SERVER", 'demo');
} else {
  #公開サーバー
  define("THIS_SERVER", 'public');
}

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : DIRECTORY ※
┗━━━━━━━━━━━━━━━━━━━━━━━━*/

# サーバールート
#----------------------------------------------------------
define("SERVER_ROOT", '');

# ドキュメントルート
#----------------------------------------------------------
if(THIS_SERVER == 'local') {
  #ローカルサーバー
  define("DOCUMENT_ROOT", preg_replace('/\/\//','/',$_SERVER["DOCUMENT_ROOT"].'/'.$site_domain.'_git'));
} elseif(THIS_SERVER == 'demo') {
  #テストサーバー
  define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"].'/'.$site_domain.'/www');
} elseif(THIS_SERVER == 'public') {
  #公開サーバー
  define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]);
}

# システムファイル
#----------------------------------------------------------
define("AURA_SYSTEM_ROOT", DOCUMENT_ROOT.'/aur_lib');

/*━━━━━━━━━━━━━━━━━━━━━━━━┓
┃	※ SETUP : URL ※
┗━━━━━━━━━━━━━━━━━━━━━━━━*/

# ドメイン
#----------------------------------------------------------
if(THIS_SERVER == 'local') {
  #ローカルサーバー
  define("HOME_URL", PROTOCOL.'localhost/'.$site_domain.'_git');
} elseif(THIS_SERVER == 'demo') {
  #テストサーバー
  define("HOME_URL", PROTOCOL.$_SERVER['HTTP_HOST'].'/'.$site_domain.'/www');
} elseif(THIS_SERVER == 'public') {
	#公開サーバー
  define("HOME_URL", PROTOCOL.$_SERVER['HTTP_HOST']);
}

# アセットディレクトリ
define("ASSETS_URL", HOME_URL."/assets");

# テーマディレクトリ
#----------------------------------------------------------
define("THEME_URL", HOME_URL.'/_themes/'.SITE_THEME);
