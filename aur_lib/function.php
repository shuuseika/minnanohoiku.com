<?php
/**************************************
 * Cache Busting
 *************************************/
function cashedate() {
  return  THIS_SERVER === 'public' ? 'xxxxxxxx' : date("YmdHis");
}
/**************************************
 * IMGタグの出力
 *************************************/
function set_img($path, $alt="", $class="", $ratio=2) {
  if($ratio == 3) { #３倍対応
    $src2x = str_replace('@3x', '@2x', $path);
    $src1x = str_replace('@2x', '', $src2x);
    $srcset = $src1x.'?version='.cashedate().' 1x, '.$src2x.'?version='.cashedate().' 2x,'.$path.'?version='.cashedate().' 3x';

    $html = '<img src="'.$src1x.'?version='.cashedate().'" srcset="'.$srcset.'" alt="'.$alt.'"';

  } else if($ratio == 2) { #２倍対応
    $src1x = str_replace('@2x', '', $path);
    $srcset = $src1x.'?version='.cashedate().' 1x, '.$path.'?version='.cashedate().' 2x';

    $html = '<img src="'.$src1x.'?version='.cashedate().'" srcset="'.$srcset.'" alt="'.$alt.'"';
  } else { #等倍のみ
    $html = '<img src="'.$path.'?version='.cashedate().'" alt="'.$alt.'"';
  }
  if($class) $html .= ' class="'.$class.'"';
  $html .= '>';

  echo $html;
}
/**************************************
 * htmlspecialchars関数によるエスケープ処理
 * 参考...http://qiita.com/mpyw/items/2f9955db1c02eeef43ea#%E3%83%A9%E3%82%AF%E3%81%AB%E8%A8%98%E8%BF%B0%E3%81%A7%E3%81%8D%E3%82%8B%E6%96%B9%E6%B3%95
 *************************************/
function hsc($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }

/**************************************
 * htmlspecialchars_decode
 *************************************/
function hscd($str) { return htmlspecialchars_decode($str); }

/**************************************
 * 文字コードの判定
 *
 * @param $value
 * @return string
 **************************************/
function characterEncoding($value, $encoding = array('UTF-8', 'SJIS', 'EUC-JP', 'ASCII', 'JIS', 'sjis-win'))
{
  foreach ($encoding as $encode) {
    if (mb_convert_encoding($value, $encode, $encode) == $value) return $encode;
  }
  return null;
}

/**************************************
 * CSVファイルの取得
 *
 * @param $csvPath
 * @return SplFileObject
 **************************************/
function getCsv($csvPath)
{
    $file = file_get_contents($csvPath);

    // アップロードされたファイルがUTF-8以外は文字コード変換を行う
    $encode = characterEncoding(substr($file, 0, 2048));
    if (strcmp($encode,'UTF-8') !== 0) $file = mb_convert_encoding($file, 'UTF-8', $encode);

    $tmp = tmpfile();
    $meta = stream_get_meta_data($tmp);
    fwrite($tmp, $file);

    $csv = new SplFileObject($meta['uri']);

    return $csv;
}

/**************************************
 * CSVファイルの中身を配列にする
 *
 * @param $csv
 * @return array
 **************************************/
function csvChangeArray($csv)
{
    $csv->setFlags(SplFileObject::READ_CSV);

    return $csv;
}

/**************************************
 * リファラチェック
 * リファラ値が異なるドメインの場合Trueを返す
 * @return bool
 **************************************/
function isNotSameReferer() {
  if(isset($_SERVER['HTTP_REFERER'])) {
    $parse_referer = parse_url( $_SERVER['HTTP_REFERER'] );
    if(strcmp($parse_referer['host'], $_SERVER['HTTP_HOST'] ) !== 0 ) return true;
    else return false;
  }
}

/**************************************
 * IE9以下のアクセス判定
 **************************************/
function is_under_ie9() {
    if(preg_match('/(?i)msie [1-9]\./',$_SERVER['HTTP_USER_AGENT'])) {  
        return true;
    }
    return false;
}
?>