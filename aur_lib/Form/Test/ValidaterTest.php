<?php
require_once('aur_lib/Form/FormBuilder.php');
require_once('aur_lib/Form/Validater.php');

use Aura\Form\Validater;

class ValidaterTest extends PHPUnit\Framework\TestCase {
    /**
     * テスト実行前の処理
     **/
    public static function setUpBeforeClass() {
        #self::$FormBuilder = new FormBuilder;
        #echo "Create FormBuilder Instance\n";
    }

    /**
     * 氏名の入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddNameTrueParam
     */
    public function nameTrue($value) {
        $this->assertTrue(Validater::name($value));
    }
    public function provideAddNameTrueParam() {
        return [
            ['山田太郎'],           # 通常
            ['山田 太郎'],          # 半角スペース
            ['山田　太郎'],         # 全角スペース
            ['Yamada Tarou'],   # 英語
            ['ヤマダタロウ'],       # カタカナ
            ['やまだたろう'],       # ひらがな
        ];
    }

    /**
     * 氏名の入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddNameFalseParam
     */
    public function nameFalse($value) {
        $this->assertFalse(Validater::name($value));
    }
    public function provideAddNameFalseParam() {
        return [
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎']           # 半角数字
        ];
    }

    /**
     * フリガナの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddKanaTrueParam
     */
    public function kanaTrue($value) {
        $this->assertTrue(Validater::kana($value));
    }
    public function provideAddKanaTrueParam() {
        return [
            ['ヤマダタロウ'],           # 通常
            ['ヤマダ タロウ'],          # 半角スペース
            ['ヤマダ　タロウ'],       # カタカナ
        ];
    }

    /**
     * フリガナの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddKanaFalseParam
     */
    public function kanaFalse($value) {
        $this->assertFalse(Validater::kana($value));
    }
    public function provideAddKanaFalseParam() {
        return [
            ['山田太郎'],           # 通常
            ['Yamada Tarou'],   # 英語
            ['やまだたろう'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎']           # 半角数字
        ];
    }

    /**
     * ふりがなの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddHirakanaTrueParam
     */
    public function hirakanaTrue($value) {
        $this->assertTrue(Validater::hirakana($value));
    }
    public function provideAddHirakanaTrueParam() {
        return [
            ['やまだたろう'],           # 通常
            ['やまだ たろう'],          # 半角スペース
            ['やまだ　たろう'],       # カタカナ
        ];
    }

    /**
     * ふりがなの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddHirakanaFalseParam
     */
    public function hirakanaFalse($value) {
        $this->assertFalse(Validater::hirakana($value));
    }
    public function provideAddHirakanaFalseParam() {
        return [
            ['山田太郎'],           # 通常
            ['Yamada Tarou'],   # 英語
            ['ヤマダタロウ'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎']           # 半角数字
        ];
    }

    /**
     * 英数字の入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddAlphanumericTrueParam
     */
    public function alphanumericTrue($value) {
        $this->assertTrue(Validater::alphanumeric($value));
    }
    public function provideAddAlphanumericTrueParam() {
        return [
            ['YamadaTarou'],           # 通常
            ['Yamada Tarou'],          # 半角スペース
            ['Yamada 1234567890'],         # 英数字
        ];
    }

    /**
     * 英数字の入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddAlphanumericFalseParam
     */
    public function alphanumericFalse($value) {
        $this->assertFalse(Validater::alphanumeric($value));
    }
    public function provideAddAlphanumericFalseParam() {
        return [
            ['山田太郎'],           # 通常
            ['やまだたろう'],   # 英語
            ['ヤマダタロウ'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎']           # 半角数字
        ];
    }

    /**
     * 半角数字のみの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddNumeric1TrueParam
     */
    public function numeric1True($value) {
        $this->assertTrue(Validater::numeric1($value));
    }
    public function provideAddNumeric1TrueParam() {
        return [
            ['0123456789'],           # 通常
        ];
    }

    /**
     * 半角数字のみの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddNumeric1FalseParam
     */
    public function numeric1False($value) {
        $this->assertFalse(Validater::numeric1($value));
    }
    public function provideAddNumeric1FalseParam() {
        return [
            ['０１２３４５６７８９'],           # 通常
            ['0123456789 '],                # 半角スペース
            ['0123456789　'],                # 全角スペース
            ['0123456789-'],                # ハイフン
            ['0123456789ー'],                # 全角ハイフン
        ];
    }

    /**
     * 半角数字+全角数字のみの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddNumeric2TrueParam
     */
    public function numeric2True($value) {
        $this->assertTrue(Validater::numeric2($value));
    }
    public function provideAddNumeric2TrueParam() {
        return [
            ['0123456789'],           # 通常
            ['０１２３４５６７８９'],           # 全角
        ];
    }

    /**
     * 半角数字+全角数字のみの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddNumeric2FalseParam
     */
    public function numeric2False($value) {
        $this->assertFalse(Validater::numeric2($value));
    }
    public function provideAddNumeric2FalseParam() {
        return [
            ['0123456789 '],                # 半角スペース
            ['0123456789　'],                # 全角スペース
            ['0123456789-'],                # ハイフン
            ['0123456789ー'],                # 全角ハイフン
        ];
    }

    /**
     * ハイフン+半角数字のみの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddNumericWithHyphen1TrueParam
     */
    public function numericWithHyphen1True($value) {
        $this->assertTrue(Validater::numericWithHyphen1($value));
    }
    public function provideAddNumericWithHyphen1TrueParam() {
        return [
            ['123-0123'],           # 通常
            ['1234567'],          # 半角スペース
        ];
    }

    /**
     * ハイフン+半角数字のみの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddNumericWithHyphen1FalseParam
     */
    public function numericWithHyphen1False($value) {
        $this->assertFalse(Validater::numericWithHyphen1($value));
    }
    public function provideAddNumericWithHyphen1FalseParam() {
        return [
			['１２３４５６７'],           # 全角数字
			['123ー4567'],           # 全角ハイフン
            ['山田太郎'],           # 通常
            ['やまだたろう'],   # 英語
            ['ヤマダタロウ'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎']           # 半角数字
        ];
    }

	/**
     * ハイフン+半角数字+全角数字のみの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddNumericWithHyphen2TrueParam
     */
    public function numericWithHyphen2True($value) {
        $this->assertTrue(Validater::numericWithHyphen2($value));
    }
    public function provideAddNumericWithHyphen2TrueParam() {
        return [
            ['123-0123'],           # 通常
            ['1234567'],          # 半角スペース
			['１２３ー４５６７'],          # 全角
        ];
    }

    /**
     * ハイフン+半角数字+全角数字のみの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddNumericWithHyphen2FalseParam
     */
    public function numericWithHyphen2False($value) {
        $this->assertFalse(Validater::numericWithHyphen2($value));
    }
    public function provideAddNumericWithHyphen2FalseParam() {
        return [
            ['山田太郎'],           # 通常
            ['やまだたろう'],   # 英語
            ['ヤマダタロウ'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎']           # 半角数字
        ];
    }

	/**
     * メールアドレスの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddEmailTrueParam
     */
    public function emailTrue($value) {
        $this->assertTrue(Validater::email($value));
    }
    public function provideAddEmailTrueParam() {
        return [
            ['Abc@example.com'],
            ['Abc.123@example.com'],
			['user+mailbox/department=shipping@example.com'],
			["!#$%&'*+-/=?^_`.{|}~@example.com"],
        ];
    }

    /**
     * メールアドレスの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddEmailFalseParam
     */
    public function emailFalse($value) {
        $this->assertFalse(Validater::email($value));
    }
    public function provideAddEmailFalseParam() {
        return [
            ['山田太郎'],           # 通常
            ['やまだたろう'],   # 英語
            ['ヤマダタロウ'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎'],           # 半角数字
			['https://xxx.com'],           # URL
        ];
    }

    /**
     * URLの入力内容チェック（Trueを返す）
     * @test
     * @dataProvider provideAddUrlTrueParam
     */
    public function urlTrue($value) {
        $this->assertTrue(Validater::url($value));
    }
    public function provideAddUrlTrueParam() {
        return [
            ['https://xxx.com'],
            ['ftp://xxx.com'],
			['http://test.1234.com'],
        ];
    }

    /**
     * URLの入力内容チェック（Falseを返す）
     * @test
     * @dataProvider provideAddUrlFalseParam
     */
    public function urlFalse($value) {
        $this->assertFalse(Validater::url($value));
    }
    public function provideAddUrlFalseParam() {
        return [
            ['山田太郎'],           # 通常
            ['やまだたろう'],   # 英語
            ['ヤマダタロウ'],       # ひらがな
            ['山田@太郎'],          # 記号
            ['やまだ１太郎'],         # 全角数字
            ['山田1太郎'],           # 半角数字
			['xxx.mail@mail.com'],           # URL
        ];
    }
}