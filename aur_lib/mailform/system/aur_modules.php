<?php
# ━━━━━━━━━━━━┓
# AURA_MODULES ver-5.0
# ORIGINAL
# ━━━━━━━━━━━━┛

# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
# System モジュール関数群
# ----------------------------------------------------------------------------------------------------------------┤

/////　メール送信先設定関数
function aur_readMailConf($aur_File) {
	if(!file_exists($aur_File)) return False;
	$aur_Buf = file($aur_File);
	$aur_ReturnArray = array();
	if($aur_Buf) {
		foreach($aur_Buf as $aur_Key=>$aur_Value) {
			$aur_Value = rtrim($aur_Value);
			if($aur_Key==0) {
				$aur_ReturnArray['USER']['regist']   = substr($aur_Value,0,1);
				$aur_ReturnArray['USER']['complete'] = substr($aur_Value,1,1);
				$aur_ReturnArray['USER']['modify']   = substr($aur_Value,2,1);
				$aur_ReturnArray['USER']['delete']   = substr($aur_Value,3,1);
				$aur_ReturnArray['USER']['reissue']  = substr($aur_Value,4,1);
			} elseif($aur_Key==1) {
				$aur_ReturnArray['ADMIN']['regist']   = substr($aur_Value,0,1);
				$aur_ReturnArray['ADMIN']['complete'] = substr($aur_Value,1,1);
				$aur_ReturnArray['ADMIN']['modify']   = substr($aur_Value,2,1);
				$aur_ReturnArray['ADMIN']['delete']   = substr($aur_Value,3,1);
				$aur_ReturnArray['ADMIN']['reissue']  = substr($aur_Value,4,1);
			} else break;
		}
		return $aur_ReturnArray;
	} else return False;
}

/////　お問い合わせメール送信先設定関数
function aur_readInqMailConf($aur_File) {
	if(!file_exists($aur_File)) return False;
	$aur_Buf = file($aur_File);
	$aur_ReturnArray = array();
	if($aur_Buf) {
		foreach($aur_Buf as $aur_Key=>$aur_Value) {
			$aur_Value = rtrim($aur_Value);
			if($aur_Key==0) {
				$aur_ReturnArray['USER']['inquiry']  = substr($aur_Value,0,1);
			} elseif($aur_Key==1) {
				$aur_ReturnArray['ADMIN']['inquiry']  = substr($aur_Value,0,1);
			} else break;
		}
		return $aur_ReturnArray;
	} else return False;
}

/////　日本語ISO-2022対応メール送信関数
function aur_sendMail($aur_MailTo, $aur_MailFrom='', $aur_Subject='', $aur_Body='') {
	$aur_MailTo  = explode(',', $aur_MailTo);

	//***************Gmail件名文字化け修正 *******
	$aur_Subject = '=?iso-2022-jp?B?'.base64_encode($aur_Subject).'?=';
	$au_fromName = 'メールの件名';
	//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼　08/05/08-修正　ここから　▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
	$au_fromName = mb_convert_encoding($au_fromName, "ISO-2022-JP", "UTF-8");	//旧：ISO-2022-JP-MS

	$aur_Header .= 'Return-Path: <'.$aur_MailFrom.'>'."\n";
	$aur_Header .= 'From: '.'=?iso-2022-jp?B?'.base64_encode($au_fromName).'?=<'.$aur_MailFrom.'>'."\n";
	$aur_Header .= 'Errors-To: '.$aur_MailFrom."\n";
	//▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲　08/05/08-修正　ここまで　▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
	$aur_Header  .= 'Mime-Version: 1.0'."\n";
	$aur_Header  .= 'Content-Type: text/plain; charset=ISO-2022-JP'."\n";
	$aur_Header  .= 'Content-Transfer-Encoding: 7bit'."\n";
	$aur_Header  .= 'Reply-To: '.$aur_MailFrom."\n".@func_get_arg(4);
	//********************************************
	
	//***************メール本文改行コード修正（CRLF⇒LF） *******
	$aur_Body = str_replace("\r\n", "\n", $aur_Body);
	
	$aur_ReturnBoolean = True;
	foreach($aur_MailTo as $aur_Key => $aur_Value) {
		if(!@mail(trim($aur_Value), $aur_Subject, $aur_Body, $aur_Header)) $aur_ReturnBoolean = False;
	}
	return $aur_ReturnBoolean;
}

/////　メールテンプレート読込関数
function aur_sendTemplateMail($aur_FileName, $aur_MailTo, $aur_MailFrom, $aur_StrtrArray=array()) {
	if(file_exists($aur_FileName)) {
		$aur_Fp = fopen($aur_FileName,'r');
		if($aur_Fp) {
			$aur_I=0;
			$aur_MailSubject = $aur_MailBody = '';
			flock($aur_Fp,LOCK_SH);
			while(!feof($aur_Fp)){
				$aur_Buf = fgets($aur_Fp,1024);
				if($aur_I==0) $aur_MailSubject = rtrim($aur_Buf);
				else $aur_MailBody.= $aur_Buf;
				$aur_I++;
			}
			flock($aur_Fp,LOCK_UN);
			fclose($aur_Fp);
		}
		if($aur_StrtrArray) {
		//▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼　08/05/08-修正　ここから　▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼▼
			$aur_MailSubject = mb_convert_encoding(strtr($aur_MailSubject,$aur_StrtrArray), "ISO-2022-JP", "UTF-8");//ISO-2022-JP-MS
			$aur_MailBody    = mb_convert_encoding(strtr($aur_MailBody,$aur_StrtrArray), "ISO-2022-JP", "UTF-8");
		//▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲　08/05/08-修正　ここまで　▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲▲
		}
		return aur_sendMail($aur_MailTo, $aur_MailFrom, $aur_MailSubject, $aur_MailBody);
	} else return False;
}

/////　登録元IP取得関数[PC/モバイル併用]
function aur_getIP() {
	return getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');
}

//GET, POSTの処理
function aur_getGPC($aur_String) {
	if(is_array($aur_String)) {
		foreach($aur_String as $aur_Key => $aur_Value) $aur_String[$aur_Key] = aur_getGPC($aur_Value);
		return $aur_String;
	} else {
		$aur_String=htmlspecialchars(htmlspecialchars_decode($aur_String,ENT_QUOTES),ENT_QUOTES);
		$aur_String = mb_convert_kana($aur_String, "KVa", 'utf-8');//全角数字⇒半角数字／半角カナ⇒全角カナ
		if (get_magic_quotes_gpc()) return stripslashes(urldecode(rawurlencode($aur_String)));
		else return urldecode(rawurlencode($aur_String));
	}
}

//GET, POST, COOKIE, FILEの内容を読み込み
function aur_getGPC_ORG($aur_String) {
	if(is_array($aur_String) && file_exists(@$aur_String['tmp_name'])) {
		return aur_readText($aur_String['tmp_name']);
	} else {
		if(is_array($aur_String)) {
			foreach($aur_String as $aur_Key => $aur_Value) $aur_String[$aur_Key] = aur_getGPC($aur_Value);
			return $aur_String;
		} else {
			if (get_magic_quotes_gpc()) return stripslashes(urldecode($aur_String));
			else return urldecode($aur_String);
		}
	}
}
//GET変数取得
function aur_getQsty($aur_Exc='', $aur_Add='') {
	foreach($_GET as $aur_Key => $aur_Value) {
		if(!empty($aur_Exc) && in_array($aur_Key, $aur_Exc)) continue;
		$aur_Qstring[]= urlencode($aur_Key).'='.urlencode($aur_Value);
	}
	if(!empty($aur_Add)) {
		foreach($aur_Add as $aur_Key => $aur_Value) $aur_Qstring[] = $aur_Value;
	}
	if(!empty($aur_Qstring)) return implode('&', $aur_Qstring);
}

//テキスト読み込み（ファイルロック対応）
function aur_readText($aur_Fname) {
	if(file_exists($aur_Fname)) {
		$aur_Fp = fopen($aur_Fname, 'r');
		if(flock($aur_Fp, LOCK_SH)) {
			$aur_Buf = fread($aur_Fp, filesize($aur_Fname));
			flock($aur_Fp, LOCK_UN);
			fclose($aur_Fp);
		}
	}
	return @$aur_Buf;
}

//テキスト書き込み（ファイルロック対応）
function aur_saveText($aur_Fname, $aur_Str, $aur_Mode='') {
	$aur_Fp = fopen($aur_Fname,'a');
	if(flock($aur_Fp, LOCK_EX)) {
		if($aur_Mode=='w') ftruncate($aur_Fp, 0);
		fwrite($aur_Fp, $aur_Str);
		flock($aur_Fp, LOCK_UN);
		fclose($aur_Fp);
		return true;
	}
}

function aur_arrayWalk($aur_Array, $aur_Rule) {
	$aur_Temp = create_function('&$aur_Value,$aur_Key,$aur_Join', '$aur_Value='.$aur_Rule.';');
	@array_walk($aur_Array, $aur_Temp, $aur_Rule);
	return $aur_Array;
}

function aur_formSelect($aur_Name, $aur_Value, $aur_Select='', $aur_Attribute='') {
	$aur_Temp = '<select name="'.$aur_Name.'"';
	$aur_Temp.= $aur_Attribute ? ' '.$aur_Attribute.'>' : '>';
	foreach($aur_Value as $aur_Key => $aur_SubValue) {
		if($aur_Select!='') {
			if($aur_Key==$aur_Select) $aur_Temp.='<option value="'.$aur_Key.'" selected>'.$aur_SubValue;
			else                  $aur_Temp.='<option value="'.$aur_Key.'">'.$aur_SubValue;
		} else {
			if(!$aur_SelectFlag) { $aur_Temp.='<option value="'.$aur_Key.'" selected>'.$aur_SubValue; $aur_SelectFlag=1;
			} else               $aur_Temp.='<option value="'.$aur_Key.'">'.$aur_SubValue;
		}
	}
	$aur_Temp.='</select>';
	return $aur_Temp;
}

// ◆Form-Name設定読込
function aur_fnMaker($aur_FormNameFilePath) {
	$aur_FormNameDat = @file($aur_FormNameFilePath);
	foreach($aur_FormNameDat as $aur_Keys=>$aur_Values) {
		$aur_FndArray[] = explode("\t", trim($aur_Values));
	}
	return $aur_FndArray;
}

function aur_fdaMaker($aur_DatFilePath, $aur_decodeHtml="") {
	$aur_DatFileArray = @file($aur_DatFilePath);
	$aur_Fda_Keys = array('reg_auth','mod_auth','name','index','form','auth','input','repeat','confirm','size',
	'limit','slct_str','label_str','class_id','ko_help','form_help','required','rqrd_str','noslct_str',
	'err_position','err_msg','mail_replace','memo');
	
	foreach($aur_DatFileArray as $aur_Keys=>$aur_Values) {
		$aur_Values = explode("\t", rtrim($aur_Values, "\n"), 2);
		
		if($aur_decodeHtml=="ON") {
			$aur_FdaArray[$aur_Values[0]] = array_combine($aur_Fda_Keys, explode("\t", $aur_Values[1]));
		} else {
			$aur_FdaArray[$aur_Values[0]] = array_combine($aur_Fda_Keys, explode("\t", @aur_echoHtml($aur_Values[1])));
		}
	}
	return $aur_FdaArray;
}

function aur_msgMaker($aur_MsgFilePath, $aur_KeyName) {
	$aur_MsgNameDat = @file($aur_MsgFilePath);
	foreach($aur_MsgNameDat as $aur_Keys=>$aur_Values) {
		@list($aur_msgNo, $aur_msgAuth, $aur_msgCode, $aur_msgMsg) = explode("\t", trim($aur_Values));
		
		if($aur_msgAuth=="1") $aur_MsgArray[$aur_KeyName][$aur_msgNo] = $aur_msgCode."&nbsp;".$aur_msgMsg;
		else $aur_MsgArray[$aur_KeyName][$aur_msgNo] = "";
	}
	return $aur_MsgArray;
}

// マイクロタイム取得
function aur_microtime_float(){
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

#
# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
#





# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
# MySQL モジュール関数群
# ----------------------------------------------------------------------------------------------------------------┤

function aur_connectDB($aur_Dbname, $aur_Host, $aur_User, $aur_Pass) {
  global $aur_Conn;
	if (!$aur_Conn = @mysql_connect($aur_Host, $aur_User, $aur_Pass)) return False;
	if ($aur_Dbname && !@mysql_select_db($aur_Dbname, $aur_Conn)) return False;
	return $aur_Conn;
}

///// Use READ & 2QUERY. (useless ADD and MOD and DEL)
function aur_createQuery($aur_FieldName, $aur_Comparison="", $aur_Keyword) {
	switch($aur_Comparison) {
		case "regexp"    : return mysql_real_escape_string($aur_FieldName)." REGEXP '".mysql_real_escape_string($aur_Keyword)."'";
		case "nregexp"   : return mysql_real_escape_string($aur_FieldName)." NOT REGEXP '".mysql_real_escape_string($aur_Keyword)."'";
		case "equal"     : return mysql_real_escape_string($aur_FieldName)."='".mysql_real_escape_string($aur_Keyword)."'";
		case "nequal"    : return mysql_real_escape_string($aur_FieldName)."!='".mysql_real_escape_string($aur_Keyword)."'";
		case "bigger"    : return mysql_real_escape_string($aur_FieldName).">'".mysql_real_escape_string($aur_Keyword)."'";
		case "smaller"   : return mysql_real_escape_string($aur_FieldName)."<'".mysql_real_escape_string($aur_Keyword)."'";
		case "eqbigger"  : return mysql_real_escape_string($aur_FieldName).">='".mysql_real_escape_string($aur_Keyword)."'";
		case "eqsmaller" : return mysql_real_escape_string($aur_FieldName)."<='".mysql_real_escape_string($aur_Keyword)."'";
		case "nlike"     : return mysql_real_escape_string($aur_FieldName)." NOT LIKE '%".mysql_real_escape_string($aur_Keyword)."%'";
		default          : return mysql_real_escape_string($aur_FieldName)." LIKE '%".mysql_real_escape_string($aur_Keyword)."%'";
	}
}

function aur_readDB($aur_Table, $aur_Select='*', $aur_Where='', $aur_Order='', $aur_Limit='') {
	@mysql_query('LOCK TABLES '.$aur_Table.' READ');
	$aur_Query = 'SELECT '.$aur_Select.' FROM '.$aur_Table.' '.$aur_Where.' '.$aur_Order.' '.$aur_Limit;
	if(!$aur_Result = @mysql_query($aur_Query)) return FALSE;
	while($aur_Line = @mysql_fetch_assoc($aur_Result)) $aur_Data[] = $aur_Line;
	@mysql_query('UNLOCK TABLES');
	return @$aur_Data;
}

function aur_addDB($aur_Table, $aur_Data) {
	@mysql_query('LOCK TABLES '.$aur_Table.' WRITE');
	if(is_array(current($aur_Data))) {
		foreach($aur_Data as $aur_Value) {
			$aur_Value = aur_arrayWalk($aur_Value, '$aur_Key!=\'\' ? mysql_real_escape_string($aur_Key)."=\'".mysql_real_escape_string($aur_Value)."\'" : $aur_Value');
			if(!@mysql_query("INSERT INTO $aur_Table SET ".implode(",",$aur_Value)))  return false;
		}
	} else {
		$aur_Data = aur_arrayWalk($aur_Data, '$aur_Key!=\'\' ? mysql_real_escape_string($aur_Key)."=\'".mysql_real_escape_string($aur_Value)."\'" : $aur_Value');
		if(!@mysql_query("INSERT INTO $aur_Table SET ".implode(",", $aur_Data))) return false;	
	}
	$aur_LastId = mysql_insert_id();
	@mysql_query('UNLOCK TABLES');
	return $aur_LastId ? $aur_LastId : TRUE;
}

function aur_modDB($aur_Table, $aur_Data, $aur_Where='') {
	@mysql_query('LOCK TABLES '.$aur_Table.' WRITE');
	$aur_Data = aur_arrayWalk($aur_Data, '$aur_Key!=\'\' ? mysql_real_escape_string($aur_Key)."=\'".mysql_real_escape_string($aur_Value)."\'" : $aur_Value');
	$aur_Query = "UPDATE $aur_Table SET ".implode(",", $aur_Data)." $aur_Where";
	#echo $aur_Query;
	if(!mysql_query($aur_Query)) return FALSE;
	@mysql_query('UNLOCK TABLES');
	return TRUE;
}

function aur_delDB($aur_Table, $aur_Where) {
	@mysql_query('LOCK TABLES '.$aur_Table.' WRITE');
	@mysql_query('DELETE FROM '.$aur_Table.' '.$aur_Where);
	return mysql_affected_rows();
	@mysql_query('UNLOCK TABLES');
}

function aur_queryDB($aur_String) {
	$aur_Result = @mysql_query($aur_String);
	while($aur_Line = @mysql_fetch_assoc($aur_Result)) $aur_Data[] = $aur_Line;
	return @func_get_arg(1) ? @current(current($aur_Data)) : @$aur_Data;
}

function aur_queryFR($aur_String, $aur_Array=FALSE) {
	$aur_Result = @mysql_query($aur_String);
	if($aur_Result && $aur_Array) while($aur_Line = @mysql_fetch_assoc($aur_Result)) $aur_Data[] = $aur_Line;
	elseif($aur_Result) $aur_Data = @mysql_result($aur_Result, 0);
	return @$aur_Data;
}


///　MySQL文字コード変換関数
function aur_mysqlEncode($aur_EncodeType) {
	@mysql_query("SET NAMES ".$aur_EncodeType);
}

#
# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
#





# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
# セキュリティ モジュール関数群
# ----------------------------------------------------------------------------------------------------------------┤

// IP文字列チェック関数
function aur_isIP($aur_Text) {
	if (preg_match("/^[0-9.]+$/",$aur_Text)) return TRUE;
	else return FALSE;
}

// 半角数字チェック関数
function aur_isNum($aur_Text) {
	if (preg_match("/^[0-9]+$/",$aur_Text)) return TRUE;
	else return FALSE;
}

// 半角英字チェック関数
function aur_isAlpha($aur_Text) {
	if (preg_match("/^[a-zA-Z]+$/",$aur_Text)) return TRUE;
	else return FALSE;
}

// 半角英数チェック関数
function aur_isAlnum($aur_Text) {
	if (preg_match("/^[a-zA-Z0-9]+$/",$aur_Text)) return TRUE;
	else return FALSE;
}

// 半角英数記号チェック関数（※記号はハイフン[-]のみ）
function aur_isTelnum($aur_Text) {
	if (preg_match("/^[a-zA-Z0-9-]+$/",$aur_Text)) return TRUE;
	else return FALSE;
}

// 不正メールFromチェック関数
function aur_isMailFrom($aur_From) {
	if(preg_match('/^[-.\w]+@([-\w]+\.)\w+$/D', $aur_From)) return TRUE;
	else return FALSE;
}

// 不正メールチェック関数
function aur_isMail($aur_Str) {
	if(preg_match('/^[^@]+@[^@]+?\.[^@]+$/', $aur_Str)) {
		if(strpos($aur_Str, " ") || strpos($aur_Str, "　")) return FALSE;
		else return TRUE;
	} else return FALSE;
}

// 不正URIチェック関数
function aur_isUri($aur_Uri) {
	if(preg_match("|[^-/?:#@&=+$,\w.!~*;'()%]|", $aur_Uri)) return FALSE;
	if(!preg_match("!^(?:https?|ftp)://"."(?:\w+:\w+@)?"."("."(?:[-_0-9a-z]+\.)+(?:[a-z]+)\.?|"
	."\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}|"."localhost".")"."(?::\d{1,5})?(?:/|$)!iD",$aur_Uri)) {
		return FALSE;
	}
	return TRUE;
}

// HTMLタグ無効化関数
function aur_echoHtml($aur_Str) {
	$aur_Str = htmlspecialchars($aur_Str, ENT_QUOTES, 'UTF-8');
	return $aur_Str;
}

// HTMLエンティティーデコード関数
function aur_decodeHtml($aur_Str) {
	$aur_Str = html_entity_decode($aur_Str, ENT_QUOTES, 'UTF-8');
	return $aur_Str;
}

// フィンガープリント取得関数（セッションのセキュリティ強化）
function aur_getFingerprint($aur_Str) {
	$aur_Fingerprint = $aur_Str;
	if(!empty($_SERVER['HTTP_USER_AGENT']))     $aur_Fingerprint .= $_SERVER['HTTP_USER_AGENT'];
	if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) $aur_Fingerprint .= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$aur_Fingerprint .= session_id();
	return md5($aur_Fingerprint);
}

// register_globals をオフにする関数
function aur_unregisterGLOBALS() {
	if(!ini_get('register_globals')) return;
	if(isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS'])) die('GLOBALS overwrite attempt detected');
	$aur_NoUnset = array('GLOBALS', '_GET', '_POST', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
	$aur_Input = array_merge($_GET, $_POST, $_COOKIE, $_SERVER, $_ENV, $_FILES, isset($_SESSION) && 
						 is_array($_SESSION) ? $_SESSION : array());
	foreach ($aur_Input as $aur_K=>$aur_V) {
		if(!in_array($aur_K, $aur_NoUnset) && isset($GLOBALS[$aur_K])) unset($GLOBALS[$aur_K]);
	}
}

// セッション＆クッキーを削除する関数
function aur_sessionOff() {
	// クッキー破棄
	if(isset($_COOKIE['loginAuth'])) @setcookie('loginAuth', '', time()-60*24*3600, '/');
	if(isset($_COOKIE['auto_login'])) @setcookie('auto_login', '', time()-60*24*3600, '/');
	if(isset($_COOKIE['user'])) @setcookie('user', '', time()-60*24*3600, '/');
	if(isset($_COOKIE['pass'])) @setcookie('pass', '', time()-60*24*3600, '/');
	// セッション破壊
	@session_destroy();
}

#
# ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛
#
?>