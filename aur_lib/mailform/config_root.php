<?php
	/*━━━━━━━━━━━━━━━━━━━━━━━━┓
 ┃	※ SETUP : DIRECTORY ※
 ┗━━━━━━━━━━━━━━━━━━━━━━━━*/
	/*	DIRECTORY:設置階層設定 公開パスからの階層	*/
	define("INQ_ACTIVE_DIR", __DIR__);
	/*	DIRECTORY:メール送信関連ファイルの階層	*/
	define("INQ_MAILPG_DIR", __DIR__.'/system');
	/*	DIRECTORY:システムファイル	*/
	define("INQ_SYSTEM_DIR", __DIR__.'/system');

	/*━━━━━━━━━━━━━━━━━━━━━━━━┓
 ┃	※ クッキー ※
 ┗━━━━━━━━━━━━━━━━━━━━━━━━*/
	define("INQ_COOKIE_DIR", '/');
	define("INQ_COOKIE_UNI_NAME", 'aur_form');
	define("INQ_COOKIE_TIME_ON", 14*24*3600);
	define("INQ_COOKIE_TIME_OFF", 60*24*3600);
	/*━━━━━━━━━━━━━━━━━━━━━━━━┓
 ┃	※ セッション ※
 ┗━━━━━━━━━━━━━━━━━━━━━━━━*/
	/*	セッションファイル保存ディレクトリ	*/
	/*
	define("INQ_SESSION_TMP_DIR", __DIR__.'/sess');
	define("INQ_SESSION_NAME", 'inq');
	session_save_path(INQ_SESSION_TMP_DIR);
	*/
?>