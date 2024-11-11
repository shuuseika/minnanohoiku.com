<?php
namespace Aura\Form;

class Validater {

    /**
     * 「氏名」の入力チェック
     * @param string $value
     */
    static public function name ($value) {
        return !preg_match("/^[a-zA-Zぁ-んァ-ヶー一-龠 　]+$/", $value) ? false : true;
    }

    /**
     * 「フリガナ」の入力チェック
     * @param string $value
     */
    static public function kana ($value) {
        return !preg_match("/^[ァ-ヶー\s　]+$/u", $value) ? false : true;
    }

    /**
     * 「ふりがな」の入力チェック
     * @param string $value
     */
    static public function hirakana ($value) {
        return !preg_match("/^[ぁ-んー\s　]+$/u", $value) ? false : true;
    }

    /**
     * 「英数字」の入力チェック
     * @param string $value
     */
    static public function alphanumeric ($value) {
        return !preg_match("/^[a-zA-Z0-9\s]+$/u", $value) ? false : true;
    }

    /**
     * 「半角数字のみ」の入力チェック
     * @param string $value
     */
    static public function numeric1 ($value) {
        return !preg_match("/^[0-9]+$/", $value) ? false : true;
    }

    /**
     * 「半角数字+全角数字のみ」の入力チェック
     * @param string $value
     */
    static public function numeric2 ($value) {
        return !preg_match("/^[０-９0-9]+$/", $value) ? false : true;
    }

    /**
     * 「ハイフン+半角数字のみ」の入力チェック
     * @param string $value
     */
    static public function numericWithHyphen1 ($value) {
        return !preg_match("/^[0-9-]+$/", $value) ? false : true;
    }

    /**
     * 「ハイフン+半角数字+全角数字のみ」の入力チェック
     * @param string $value
     */
    static public function numericWithHyphen2 ($value) {
        return !preg_match("/^[０-９0-9ー−-]+$/", $value) ? false : true;
    }

    /**
     * 「メールアドレス」の入力チェック
     * @param string $value
     */
    static public function email ($value) {
        return !preg_match("/^[a-zA-Z0-9\.!#$%&'\*+\/=\?\^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $value) ? false : true;
    }

    /**
     * 「URL」の入力チェック
     * @param string $value
     */
    static public function url ($value) {
        return !preg_match("/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/", $value) ? false : true;
    }
}