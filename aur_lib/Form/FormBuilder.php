<?php
require_once('Validater.php');

use Aura\Form\Validater;

class FormBuilder
{
    private $formNode;
    private $formName;
    private $action;
    private $validate;
    private $delimiter;
    private $emailIndex;
    private $passwordIndex;
    private $agree;
    private $agreeFlag;
    private $uploaddir;

    function __construct($prefix = 'contact', $action)
    {
        $this->formNode = array();
        $this->formName = $prefix;
        $this->action = $action;
        
        $this->validate = false;
        $this->delimiter = '/'; #区切り文字の指定
    }

    /**
     * ラベル名を格納
     *
     * @param string $indexName
     * @param string $label
     */
    public function setLabel($indexName, $label) {
        $this->formNode[$indexName]['label'] = $label;
    }

    /**
     * 入力タイプを格納
     *
     * @param string $indexName
     * @param string $type
     */
    public function setType($indexName, $type) {
        $this->formNode[$indexName]['type'] = $type;
    }

    /**
     * 項目名を格納
     *
     * @param string $indexName
     * @param string $name
     */
    public function setName($indexName, $name) {
        $this->formNode[$indexName]['name'] = $name;
        if($name === 'email') $this->emailIndex = $indexName;
    }

    /**
     * 値を格納
     *
     * @param string $indexName
     * @param string $value
     */
    public function setValue($indexName, $value) {
        $this->formNode[$indexName]['value'] = $value;
    }

    /**
     * クラス名を格納
     *
     * @param string $indexName
     * @param string $class
     */
    public function setClass($indexName, $class) {
        $this->formNode[$indexName]['class'] = $class;
    }

    /**
     * プレースホルダーを格納
     *
     * @param string $indexName
     * @param string $placeholder
     */
    public function setPlaceholder($indexName, $placeholder) {
        $this->formNode[$indexName]['placeholder'] = $placeholder;
    }

    /**
     * 保護フラグを格納
     *
     * @param string $indexName
     * @param int $protect
     */
    public function setProtect($indexName, $protect) {
        if($protect === 1) $this->formNode[$indexName]['protect'] = true;
        else $this->formNode[$indexName]['protect'] = false;
    }

    /**
     * 必須フラグを格納
     *
     * @param string $indexName
     * @param int $require
     */
    public function setRequire($indexName, $require) {
        $this->formNode[$indexName]['require'] = $require;
    }

    /**
     * バリデーションタイプを格納
     *
     * @param string $indexName
     * @param string $checktype
     */
    public function setCheckType($indexName, $checktype) {
        $this->formNode[$indexName]['checktype'] = $checktype;
    }

    /**
     * リレーションインデックスを格納
     *
     * @param string $indexName
     * @param string $relationItem
     */
    public function setRelationItem($indexName, $relationItem) {
        $this->formNode[$indexName]['relation'] = null;

        if($relationItem) {
            $relationItemArray = array();
            $relationItems = explode($this->delimiter, $relationItem);
            foreach($relationItems as $relationItem) {
                $relationItem = explode(':', $relationItem);
                $relationValue = array();
                if (isset($relationItem[1])) $relationValue = explode('|', $relationItem[1]);
                $relationItemArray[$relationItem[0]] = $relationValue;
            }
            $this->formNode[$indexName]['relation']['relationItems'] = $relationItemArray;
        } 
    }

    /**
     * リレーションインデックスのオペレーターを格納
     *
     * @param string $indexName
     * @param string $relationOperator
     */
    public function setRelationOperator($indexName, $relationOperator) {
        if ($relationOperator) $this->formNode[$indexName]['relation']['relationOperator'] = $relationOperator;
    }

    /**
     * フォームに入力された値を格納
     *
     * @param string|int $indexName
     * @param string $inputValue
     */
    public function setInputValue($indexName, $inputValue) {
        $this->formNode[$indexName]['inputValue'] = null;

        if( isset($inputValue) ) $this->formNode[$indexName]['inputValue'] = $inputValue;
    }

    /**
     * ファイルアップロードディレクトリのパスを格納
     *
     * @param string $uploaddir
     */
    public function setUploaddir($uploaddir) {
        $this->uploaddir = $uploaddir;
    }
    
    /**
     * 同意ボタンの値を格納
     *
     * @param string $inputValue
     */
    public function setAgree($inputValue) {
        $this->agree['inputValue'] = $inputValue;
    }

    /**
     * 同意ボタンの有無判定
     *
     * @param int $agreeFlag
     */
    public function setAgreeFlag($agreeFlag) {
        $this->agreeFlag = $agreeFlag;
    }

    /**
     * 区切り文字の変更(デフォルトは'/')
     * $this->createInput()より手前で使うこと。
     *
     * @param string $delimiter
     */
    public function setDelimiter($delimiter) {
        $this->delimiter = $delimiter;
    }

    /**
     * ラベル名の配列取得
     *
     * @return array
     */
    public function getLabelArray() {
        $labels = array();
        foreach($this->formNode as $node) {
            $labels[] = $node['label'];
        }
        return $labels;
    }

    /**
     * 項目名の配列取得
     *
     * @return array
     */
    public function getNameArray() {
        $names = array();
        foreach($this->formNode as $node) {
            $names[] = $node['name'];
        }
        return $names;
    }

    /**
     * ラベル名の取得
     *
     * @param string $indexName
     * @return string
     */
    public function getLabel($indexName) {
        return $this->formNode[$indexName]['label'];
    }

    /**
     * タイプの取得
     *
     * @param string $indexName
     * @return string
     */
    public function getType($indexName) {
        return $this->formNode[$indexName]['type'];
    }

    /**
     * 項目名の取得
     *
     * @param string $indexName
     * @return string
     */
    public function getName($indexName) {
        return $this->formNode[$indexName]['name'];
    }

    /**
     * 値の取得
     *
     * @param string $indexName
     * @return string|int
     */
    public function getValue($indexName) {
        return $this->formNode[$indexName]['value'];
    }

    /**
     * クラスの取得
     *
     * @param string $indexName
     * @return string
     */
    public function getClass($indexName) {
        return $this->formNode[$indexName]['class'];
    }

    /**
     * プレースホルダーの取得
     *
     * @param string $indexName
     * @return string
     */
    public function getPlaceholder($indexName) {
        return $this->formNode[$indexName]['placeholder'];
    }

    /**
     * リレーションインデックスが設定されている項目の取得
     *
     * @return array
     */
    public function getRelationItems() {
        $relationItems = array();
        foreach($this->formNode as $indexName => $node) {
            if( isset( $this->formNode[$indexName]['relation']) ) {
                $relationItems[$indexName] = $node['relation'];
            }
        }
        return $relationItems;
    }

    /**
     * 保護項目の判定を取得
     *
     * @param string $indexName
     * @return int
     */
    private function getProtectFlag($indexName) {
        return $this->formNode[$indexName]['protect'];
    }

    /**
     * フォームに入力された値の取得
     *
     * @param string $indexName
     * @return string|int
     */
    public function getInputValue($indexName) {
        return $this->formNode[$indexName]['inputValue'];
    }

    /**
     * ファイルタイプのインプット要素を取得
     *
     * @return array
     */
    public function getFileInputs() {
        $fileInputs = array();
        foreach($this->formNode as $node) {
            if($node['type'] === 'file') $fileInputs[] = $node;
        }
        return $fileInputs;
    }

    /**
     * フォームのアイテムを取得
     * @param string $indexName
     * @return array
     */
    private function getNode($indexName) {
        return $this->formNode[$indexName];
    }
    
    /**
     * 同意ボタンの値の取得
     *
     * @return string
     */
    private function getAgree() {
        return $this->agree['inputValue'];
    }
    
    /**
     * エラーの取得
     *
     * @param $indexName
     * @return string
     */
    public function getError($indexName) {
        return isset($this->formNode[$indexName]['error']) ? $this->formNode[$indexName]['error'] : null;
    }
    
    /**
     * ラベル名とバリュー値の取得
     *
     * @return array
     */
    public function getParameters() {
        $inputParameters = array();
        foreach($this->formNode as $indexName => $node) {
            if(isset($node['name'])) {
                if(isset($node['label'])) $inputParameters[$node['name']]['label'] = $node['label'];
                if(isset($node['inputValue'])) {
                    if(is_array($node['inputValue'])) {
                        $inputParameters[$node['name']]['value'] = '';
                        foreach($node['inputValue'] as $value) {
                            $inputParameters[$node['name']]['value'] .= $value."・";
                        }
                        $inputParameters[$node['name']]['value'] = rtrim($inputParameters[$node['name']]['value'], '・');
                    } else {
                        $inputParameters[$node['name']]['value'] = $node['inputValue']; 
                    }
                }
            }
        }
        return $inputParameters;
    }
    
    /**
     * 必須項目の判定
     *
     * @param string $indexName
     * @return int
     */
    public function isRequire($indexName) {
        return $this->formNode[$indexName]['require'];
    }
    
    /**
     * 同意ボタンのチェック
     *
     * @return bool
     */
    public function isAgree() {
        if(isset($this->agree['error'])) return $this->agree['error'];
        else return false;
    }

    /**
     * ファイルアップロードがあるか
     *
     * @return bool
     */
    public function isMultipart() {
        foreach($this->formNode as $node) {
            if($node['type'] === 'file') return true;
        }
        return false;
    }
    
    /**
     * バリデーションのチェック
     *
     * @return bool
     */
    public function isValidate() {
        return $this->validate;
    }
    
    /**
     * 入力項目にエラーがあるかのチェック
     *
     * @param string $indexName
     * @return string|bool
     */
    public function hasError($indexName) {
        if(isset($this->formNode[$indexName]['error']) && $this->formNode[$indexName]['error']) return $this->formNode[$indexName]['error'];
        else return false;
    }

    /**
     * リレーション項目のチェック
     *
     * @param string $indexName
     * @return string
     */
    public function checkRelation($indexName) {
        $chackRelation = 'input_'.$indexName;

        if(isset($this->formNode[$indexName]['relation']['relationItems'])) {
            $checkFlag = true;

            if (!isset($this->formNode[$indexName]['relation']['relationOperator'])) $this->formNode[$indexName]['relation']['relationOperator'] = null;
            $operator = $this->formNode[$indexName]['relation']['relationOperator'];
            $andFlag = false;
            
            foreach($this->formNode[$indexName]['relation']['relationItems'] as $parentIndex => $relationValue) {
                if(empty($relationValue)) { #リレーションバリューが空配列の場合、親要素はテキスト入力形式のinput要素になる
                    if($this->formNode[$parentIndex]['inputValue']) $checkFlag = false;
                    elseif ($operator === 'and') $andFlag = true;
                } else { #リレーションバリューが空配列でない場合、親要素はラジオボタン・チェックボックス・セレクトのいずれか
                    if( is_array($this->formNode[$parentIndex]['inputValue']) ) { #inputValueが配列の場合はチェックボックス
                        $matchFlag = false;
                        foreach($this->formNode[$parentIndex]['inputValue'] as $inputValue) {
                            if(
                                isset($inputValue) && 
                                array_search($inputValue, $relationValue) !== false
                            ) {
                                $checkFlag = false;
                                $matchFlag = true;
                                break;
                            }
                        }
                        if (!$matchFlag && $operator === 'and') $andFlag = true;
                    } else {
                        if(array_search($this->formNode[$parentIndex]['inputValue'], $relationValue) !== false) $checkFlag = false;
                        elseif ($operator === 'and') $andFlag = true;
                    }
                }
            }
            
            if($andFlag || $checkFlag) $chackRelation .= ' relation_item';
        }
        
        return $chackRelation;
    }

    /**
     * formNodeの出力
     */
    public function printFormNode() {
        print_r($this->formNode);
    }
    
    /**
     * agreeの出力
     *
     * @return array
     */
    public function printAgree() {
        print_r($this->agree);
    }

    /**
     * 入力要素を生成して出力する
     *
     */
    public function createInput($indexName, $hidden=false) {
        // 単一行入力タイプ
        if($this->getType($indexName) === 'text' || 
           $this->getType($indexName) === 'email' || 
           $this->getType($indexName) === 'tel' || 
           $this->getType($indexName) === 'password' ||
           $this->getType($indexName) === 'url') {
            $html = $this->getTextInputHtml($indexName, $hidden);
        }

        // ファイルタイプ
        if($this->getType($indexName) === 'file') {
            $html = $this->getFileInputHtml($indexName, $hidden);
        }

        // hiddenタイプ
        if($this->getType($indexName) === 'hidden') {
            $html = $this->getHiddenInputHtml($indexName, $hidden);
        }

        // セレクトタイプ
        if($this->getType($indexName) === 'select') {
            $html = $this->getSelectHtml($indexName, $hidden);
        }

        // ラジオボタン
        if($this->getType($indexName) === 'radio') {
            $html = $this->getRadioboxesHtml($indexName, $hidden);
        }

        // チェックボックス
        if($this->getType($indexName) === 'check') {
            $html = $this->getCheckboxesHtml($indexName, $hidden);
        }

        // テキストエリア
        if($this->getType($indexName) === 'textarea') {
            $html = $this->getTextareaHtml($indexName, $hidden);
        }

        echo $html;
    }
    
    /**
     * 同意ボタンを生成して出力する
     *
     */
    public function createAgreement() {
        if($this->agreeFlag) {
            $input = '<div class="check_item">';
            $input .= '<input type="checkbox" id="agree" name="agree" value="agree" class="checkbox input"';
            if($this->getAgree()) $input .= ' checked="checked"';
            if($this->action === 'confirm' && $this->validate) $input .= ' disabled="disabled"';
            $input .= '>';
            $input .= '<label for="agree" class="label __checkbox">'.$this->getPlaceholder('agree').'</label></div>';
            if($this->action === 'confirm' && $this->validate) {
                $input .= '<input type="hidden" name="agree" value="agree">';
            }

            //エラーの出力
            if($this->isAgree()) $input .= '<div class="color_text_alert text_small">'.$this->agree['error'].'</div>';

            echo $input;
        }
    }
    
    /**
     * 入力された項目のバリデーション
     * @return bool
     */
    public function inputValidater() {
        $errorflag = false;
        if($this->action !== 'input') {
            #print_r($this->formNode);
            foreach($this->formNode as $indexName => $node) {
                if($node['require']) {
                    $checkRequire = true;
                    $andFlag = true;

                    if($node['type'] !== 'agree' && !is_null($node['relation'])) {
                        $operator = $node['relation']['relationOperator'];
                        foreach($node['relation']['relationItems'] as $parentIndex => $valueArray) {
                            if(empty($valueArray)) {
                                if(!$this->formNode[$parentIndex]['inputValue']) {
                                    $checkRequire = false;
                                    if( $operator === 'and') $andFlag = false;
                                } else $checkRequire = true;
                            } elseif (is_array( $this->formNode[$parentIndex]['inputValue'] )) {
                                foreach($this->formNode[$parentIndex]['inputValue'] as $inputValue) {
                                    if( array_search($inputValue, $valueArray) !== false ) $checkRequire = true;
                                    else {
                                        $checkRequire = false;
                                        if( $operator === 'and') $andFlag = false;
                                    }
                                }
                            } else {
                                if( array_search($this->formNode[$parentIndex]['inputValue'], $valueArray) === false ) {
                                    $checkRequire = false;
                                    if( $operator === 'and') $andFlag = false;
                                } else $checkRequire = true;
                            }
                        }
                    }

                    if($checkRequire && $andFlag) { 
                        if($node['type'] === 'text' || $node['type'] === 'email' || $node['type'] === 'tel' || $node['type'] === 'url' || $node['type'] === 'password') {
                            if($node['inputValue'] === '') {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が入力されていません。';
                            }
                        } elseif($node['type'] === 'select') {
                            if($node['inputValue'] === 'unselected') {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が選択されていません。';
                            }
                        } elseif(!($node['type'])) {
                            if($node['inputValue'] === '') {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が選択されていません。';
                            }
                        } elseif($node['type'] === 'check') {
                            if(!($node['inputValue'])) {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が選択されていません。';
                            }
                        } elseif($node['type'] === 'radio') {
                            if(!($node['inputValue'])) {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が選択されていません。';
                            }
                        } elseif($node['type'] === 'textarea') {
                            if($node['inputValue'] === '') {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が入力されていません。';
                            }
                        } elseif($node['type'] === 'file') {
                            if($node['inputValue'] === '') {
                                $errorflag = true;
                                $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が選択されていません。';
                            }
                        }
                    }
                }

                if(isset($node['checktype'])) {
                    switch($node['checktype']) {
                        #氏名(name)
                        case 'name':
                            if($node['inputValue']) {
                                if(!Validater::name($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                } 
                            }  
                            break;
                        #フリガナ(カナ)
                        case 'kana':
                            if($node['inputValue']) {
                                if(!Validater::kana($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;
                        #ふりがな(かな)
                        case 'hirakana':
                            if($node['inputValue']) {
                                if(!Validater::hirakana($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                        break;

                        #英語
                        case 'english':
                            if($node['inputValue']) {
                                if(!Validater::alphanumeric($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;

                        #郵便番号1(半角数字のみ)
                        case 'zip1':
                            if($node['inputValue']) {
                                if(!Validater::numeric1($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                        break;
                        #郵便番号2(ハイフン+半角数字のみ)
                        case 'zip2':
                            if($node['inputValue']) {
                                if(!Validater::numericWithHyphen1($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                        break;
                        #郵便番号3(ハイフン+半角数字+全角数字のみ)
                        case 'zip3':
                            if($node['inputValue']) {
                                if(!Validater::numericWithHyphen2($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                        break;
                        #メールアドレス
                        case 'email':
                            if($node['inputValue']) {
                                if(!Validater::email($node['inputValue'])) {
                                    $errorflag = false;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;
                        #確認用メールアドレス
                        case 'email_check':
                            if($node['inputValue']) {
                                $email = $this->formNode[$this->emailIndex]['inputValue'];
                                if($node['inputValue'] !== $email) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = 'メールアドレスの入力が一致しません。';
                                }
                            }
                            break;
                        #電話番号1(半角数字のみ)
                        case 'tel1':
                            if($node['inputValue']) {
                                if(!Validater::numeric1($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;
                        #電話番号2(ハイフン+半角数字のみ)
                        case 'tel2':
                            if($node['inputValue']) {
                                if(!Validater::numericWithHyphen1($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;
                        #電話番号3(ハイフン+半角数字+全角数字のみ)
                        case 'tel3':
                            if($node['inputValue']) {
                                if(!Validater::numericWithHyphen2($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;
                        #URL
                        case 'url':
                            if($node['inputValue']) {
                                if(!Validater::url($node['inputValue'])) {
                                    $errorflag = true;
                                    $this->formNode[$indexName]['error'] = $this->getLabel($indexName).'が正しく入力されていません。';
                                }
                            }
                            break;

                    }
                }
            }
            
            if(!$this->getAgree() && $this->agreeFlag) {
                $errorflag = true;
                $this->agree['error'] = 'チェックが入っていません。';
            }
            
            if(!$errorflag) $this->validate = true;
            return $this->validate;
        } else {
            return false;
        }
    }

    /**
     * 入力された項目の要素を生成して出力する
     * @param string $indexName
     * @param bool $hidden
     * @return string
     */
    private function createChecker($indexName, $hidden) {
        $node = $this->getNode($indexName);

        $inputValue='';
        if($node['inputValue']) {
            if($node['type'] === 'radio' || $node['type'] === 'check') {
                $arrayValue = array();
                $arrayValue = explode($this->delimiter, $node['placeholder']);

                foreach($arrayValue as $value) {
                    if(is_array($node['inputValue'])) {
                        $inputValue = '';
                        foreach($node['inputValue'] as $getValue) {
                            $inputValue .= $getValue;
                            $inputValue .= $this->delimiter;
                        }
                        $inputValue = rtrim($inputValue, $this->delimiter);
                    } else {
                        if($value === $node['inputValue']) {
                            $inputValue = $node['inputValue'];
                            break;
                        }
                    }
                    
                }
            } elseif($node['type'] === 'select') {
                $arrayValue = array();
                if($node['name'] === 'year') { # 年(1950~)
                    $nowYear = date("Y");
                    for($x=1950;$x<=$nowYear;$x++) array_push($arrayValue,$x);

                } elseif ($node['name'] === 'month') { # 月
                    for($x=1;$x<13;$x++) array_push($arrayValue,$x);

                } elseif ($node['name'] === 'day') { # 日
                    for($x=1;$x<32;$x++) array_push($arrayValue,$x);

                } elseif($node['name'] === 'country') { # 国
                    $arrayValue = array(
                        'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Anguilla', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Canary Island', 'Cape Verde', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 'Curacao', 'Czech Republic', 'Democratic Republic of Congo', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Eq. Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Finland', 'France', 'G.Bissau', 'Gabon', 'Gambia', 'Georgia', 'Ghana', 'Gibraltar', 'Grand Cayman', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guatemala', 'Guinea', 'Guyana', 'Haiti', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Ivory Coast', 'Jamaica', '日本', 'Jordan', 'Kazakhstan', 'Kenya', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macedonia', 'Madagascar', 'Madeira', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Moldova', 'Monaco', 'Montserrat', 'Morocco', 'Mozambique', 'Namibia', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Northern Africa', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romania', 'Russia', 'Rwanda', 'Tome and Prinicipe', 'San Marino', 'Saudi Arabia', 'Senegal', 'Serbia and Montenegro', 'Seychelles', 'Sierra-Leone', 'Singapore', 'Sint Maarten', 'Slovak Republic', 'Slovenia', 'Somalia', 'South Africa', 'South Korea', 'Spain', 'Sri Lanka', 'St. Kitts and Nevis', 'St. Lucia', 'St. Vincent and The Grenadines', 'Sudan', 'Suriname', 'Swaziland', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tanzania', 'Thailand', 'Togo', 'Trinidad y Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'UAE', 'Uganda', 'Ukraine', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vatican City State', 'Venezuela', 'Vietnam', 'Virgin Islands', 'Yemen', 'Zambia', 'Zimbabwe');

                } elseif($node['name'] === 'pref') { # 都道府県
                    $arrayValue = array(
                        '北海道', '青森県', '岩手県', '秋田県', '宮城県', '山形県', '福島県', '東京都', '神奈川県', '埼玉県', '千葉県', '茨城県', '栃木県', '群馬県',  '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県',   '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府',   '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県',   '広島県', '山口県', '徳島県', '香川県', '愛媛県',  '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県',   '宮崎県', '鹿児島県', '沖縄県');

                } else { # その他
                    $arrayValue = explode($this->delimiter, $node['placeholder']);
                }
                
                foreach($arrayValue as $value) {
                    if($value == $node['inputValue']) {
                        $inputValue = $node['inputValue'];
                        break;
                    }
                }
            } else {
                $inputValue = $node['inputValue'];
            }
        }
        $input = '';

        if($hidden === false && $node['type'] !== 'hidden') {
            $input = '<span class="check">'.hsc($inputValue).'</span>'."\n";
        }
        $input .= '<input type="hidden" name="'.$node['name'].'" value="'.$inputValue.'">';

        if ($node['type'] === 'file') {
            $input .= '<input type="hidden"';
            $input .= $this->insertName($node['name'].'_name');
            $input .= $this->insertId($node['name'].'_name');
            $input .= $this->insertValue($node['value']);
            $input .= '>'."\n";
        }

        return $input;
    }
    
    /**
     * 入力された項目がバリデーションエラーの場合 エラー要素を生成する
     * @param string $indexName
     * @return string
     */
    private function createError($indexName) {
        if($this->getError($indexName)) $errorValue = $this->getError($indexName);
        else $errorValue = '';
        
        $input = '<div class="color_text_alert text_small">'.$errorValue.'</div>';

        return $input;
    }

    /**
     * 単一テキスト入力inputのHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getTextInputHtml($indexName, $hidden=false) {
        $node = $this->getNode($indexName);

        if(!$this->getProtectFlag($indexName)) {
            $errorClass = $this->getError($indexName) ? '__error' : null;

            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden);
            } else {
                $html = '<input type="'.$node['type'].'"';
                $html .= $this->insertName($node['name']);
                $html .= $this->insertId($node['name']);
                $html .= $this->insertClassname($node['class'], array('input',$errorClass));
                $html .= $this->insertValue($node['value']);
                $html .= $this->insertPlaceholder($node['placeholder']);

                if($node['type'] === 'text') {
                    if($node['name'] === 'zip') { #郵便番号
                        $html = preg_replace('/class="/', 'class="p-postal-code ',$html);
                        $html .= ' maxlength="8"';
                        $html .= ' autocomplete="postal-code"';
                    } elseif($node['name'] === 'address') { #住所
                        $html = preg_replace('/class="/', 'class="p-region p-locality p-street-address p-extended-address ',$html);
                        $html .= ' autocomplete="address-line1"';
                    } elseif($node['name'] === 'name') { #名前
                        $html .= ' autocomplete="name"';
                    } elseif($node['name'] === 'company') { #会社名
                        $html .= ' autocomplete="organization"';
                    }
                } elseif($node['type'] === 'email') { #メールアドレス
                    $html .= ' autocomplete="email"';
                } elseif($node['type'] === 'tel') { #電話番号
                    $html .= ' autocomplete="tel"';
                }

                $html .= '>'."\n";
                
                //エラーの出力
                if ($this->hasError($indexName)) $html .= $this->createError($indexName);
            }
        } else {
            $html = '<span class="check">'.$node['value'].'</span>';
            $html .= '<input type="hidden"';
            $html .= $this->insertName($node['name']);
            $html .= $this->insertId($node['name']);
            $html .= $this->insertValue($node['value']);
            $html .= '>';
        }

        return $html;
    }

    /**
     * テキストエリアのHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getTextareaHtml($indexName, $hidden=false) {
        $errorClass = $this->getError($indexName) ? '__error' : null;

        $node = $this->getNode($indexName);
        if(!$this->getProtectFlag($indexName)) {
            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden);
            } else {
                $html = '<textarea';
                $html .= $this->insertName($node['name']);
                $html .= $this->insertId($node['name']);
                $html .= $this->insertClassname($node['class'], array($errorClass));
                $html .= $this->insertPlaceholder($node['placeholder']);
                $html .= '>';
                $html .= $node['value'];
                $html .= '</textarea>';
                
                //エラーの出力
                if ($this->hasError($indexName)) $html .= $this->createError($indexName);
            }
        } else {
            $html = '<span class="check">'.$node['value'].'</span>';
            $html .= '<input type="hidden"';
            $html .= $this->insertName($node['name']);
            $html .= $this->insertId($node['name']);
            $html .= $this->insertValue($node['value']);
            $html .= '>';
        }

        return $html;
    }

    /**
     * ラジオボタンのHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getRadioboxesHtml($indexName, $hidden=false) {
        $node = $this->getNode($indexName);
        
        $arrayValue = array();
        $arrayValue = explode($this->delimiter, $this->getPlaceholder($indexName));

        if(!$this->getProtectFlag($indexName)) {
            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden);
            } else {
                if(is_array($arrayValue)) {
                    $i = 1;
                    $html = '';
                    foreach($arrayValue as $value) {
                        $html .= '<div class="radio_item">';
                        $html .= '<input type="radio"';
                        $html .= $this->insertName($node['name']);
                        $html .= $this->insertId($node['name'].$i);
                        $html .= $this->insertClassname($node['class'], array('radio','input'));
                        $html .= $this->insertValue($value);
                        if($node['value'] === $value) $html .= ' checked="checked"';
                        $html .= '>';
                        $html .= '<label for="form_'.$this->formName.'_'.$node['name'].$i.'" class="label __radio">';
                        $html .= $value;
                        $html .= '</label>'."\n";
                        $html .= '</div>'."\n";

                        $i++;
                    }
                    
                    //エラーの出力
                    if ($this->hasError($indexName)) $html .= '<br>'.$this->createError($indexName);
                }
            }
        } else {
            $html = '<span class="check">'.$node['value'].'</span>';
            $html .= '<input type="hidden"';
            $html .= $this->insertName($node['name']);
            $html .= $this->insertId($node['name'].$i);
            $html .= $this->insertValue($node['value']);
            $html .= '>';
        }

        return $html;
    }

    /**
     * チェックボックスのHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getCheckboxesHtml($indexName, $hidden=false) {
        $node = $this->getNode($indexName);
        
        $arrayValue = array();
        $arrayValue = explode($this->delimiter, $node['placeholder']);

        if(!$this->getProtectFlag($indexName)) {
            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden);
            } else {
                if(is_array($arrayValue)) {
                    $i = 1;
                    $html = '';
                    foreach($arrayValue as $value) {
                        $html .= '<div class="check_item">';
                        $html .= '<input type="checkbox"';
                        $html .= $this->insertName($node['name'].'[]');
                        $html .= $this->insertId($node['name'].$i);
                        $html .= $this->insertClassname($node['class'], array('checkbox','input'));
                        if(is_array($node['value']))
                            foreach($node['value'] as $getValue) {
                                if($getValue === $value) $html .= ' checked="checked"';
                            }
                            if($node['value'] === $value) $html .= ' checked="checked"';
                        $html .= 'value="'.$value.'"';
                        $html .= '>';
                        $html .= '<label for="form_'.$this->formName.'_'.$node['name'].$i.'" class="label __checkbox">';
                        $html .= $value;
                        $html .= '</label>';
                        $html .= '</div>'."\n";

                        $i++;
                    }
                    
                    //エラーの出力
                    if ($this->hasError($indexName)) $html .= '<br>'.$this->createError($indexName);
                }
            }
        } else {
            $html = '<span class="check">'.$node['value'].'</span>';
            $html .= '<input type="hidden"';
            $html .= $this->insertName($node['name'].'[]');
            $html .= $this->insertId($node['name'].$i);
            $html .= $this->insertValue($node['value']);
            $html .= '>';
        }

        return $html;
    }

    /**
     * プルダウンメニュー（セレクトボックス）のHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getSelectHtml($indexName, $hidden=false) {
        $node = $this->getNode($indexName);
        
        $arrayValue = array();

        if(!$this->getProtectFlag($indexName)) {
            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden);
            } else {
                $html = '<label for="form_'.$this->formName.'_'.$node['name'].'" class="select_item '.$node['class'].'">';
                $html .= '<select';
                $html .= $this->insertName($node['name']);
                $html .= $this->insertId($node['name']);
                $html .= $this->insertClassname("input select");
                $html .= '>';

                if($node['name'] === 'year') { # 年(1950~)
                    $nowYear = date("Y");
                    for($x=1950;$x<=$nowYear;$x++) array_push($arrayValue,$x);

                    $html .= '<option value="unselected">'.$node['placeholder'].'</option>';

                } elseif ($node['name'] === 'month') { # 月
                    for($x=1;$x<13;$x++) array_push($arrayValue,$x);

                    $html .= '<option value="unselected">'.$node['placeholder'].'</option>';

                } elseif ($node['name'] === 'day') { # 日
                    for($x=1;$x<32;$x++) array_push($arrayValue,$x);

                    $html .= '<option value="unselected">'.$node['placeholder'].'</option>';

                } elseif($node['name'] === 'country') { # 国
                    $html .= '<option value="unselected">'.$node['placeholder'].'</option>';
                    
                    $arrayValue = array(
                        'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Anguilla', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Canary Island', 'Cape Verde', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 'Curacao', 'Czech Republic', 'Democratic Republic of Congo', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Eq. Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Finland', 'France', 'G.Bissau', 'Gabon', 'Gambia', 'Georgia', 'Ghana', 'Gibraltar', 'Grand Cayman', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guatemala', 'Guinea', 'Guyana', 'Haiti', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Ivory Coast', 'Jamaica', '日本', 'Jordan', 'Kazakhstan', 'Kenya', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macedonia', 'Madagascar', 'Madeira', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Moldova', 'Monaco', 'Montserrat', 'Morocco', 'Mozambique', 'Namibia', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Northern Africa', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romania', 'Russia', 'Rwanda', 'Tome and Prinicipe', 'San Marino', 'Saudi Arabia', 'Senegal', 'Serbia and Montenegro', 'Seychelles', 'Sierra-Leone', 'Singapore', 'Sint Maarten', 'Slovak Republic', 'Slovenia', 'Somalia', 'South Africa', 'South Korea', 'Spain', 'Sri Lanka', 'St. Kitts and Nevis', 'St. Lucia', 'St. Vincent and The Grenadines', 'Sudan', 'Suriname', 'Swaziland', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tanzania', 'Thailand', 'Togo', 'Trinidad y Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks and Caicos Islands', 'UAE', 'Uganda', 'Ukraine', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vatican City State', 'Venezuela', 'Vietnam', 'Virgin Islands', 'Yemen', 'Zambia', 'Zimbabwe');

                } elseif($node['name'] === 'pref') { # 都道府県
                    $html .= '<option value="unselected">'.$node['placeholder'].'</option>';
                    
                    $arrayValue = array(
                        '北海道', '青森県', '岩手県', '秋田県', '宮城県', '山形県', '福島県', '東京都', '神奈川県', '埼玉県', '千葉県', '茨城県', '栃木県', '群馬県',  '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県',   '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府',   '大阪府', '兵庫県', '奈良県', '和歌山県', '鳥取県', '島根県', '岡山県',   '広島県', '山口県', '徳島県', '香川県', '愛媛県',  '高知県', '福岡県', '佐賀県', '長崎県', '熊本県', '大分県',   '宮崎県', '鹿児島県', '沖縄県');

                } else { # その他
                    $arrayValue = explode($this->delimiter, $node['placeholder']);

                    if(is_array($arrayValue)){
                        $html .= '<option value="unselected">選択してください</option>';
                    }
                }

                foreach($arrayValue as $value){
                    $html .= '<option value="'.$value.'"';
                    if($node['value'] == $value) $html .= ' selected';
                    $html .= '>'.$value.'</option>'."\n";
                }

                $html .= '</select>';
                $html .= '</label>';
                
                //エラーの出力
                if ($this->hasError($indexName)) $html .= $this->createError($indexName);
            }
        } else {
            if(is_array($arrayValue)) {
                foreach($arrayValue as $value) {
                    if($value === $node['value']) {
                        $html = '<span class="check">'.$value.'</span>';
                        $html .= '<input type="hidden"';
                        $html .= $this->insertName($node['name']);
                        $html .= $this->insertId($node['name']);
                        $html .= $this->insertValue($value);
                        $html .= '>';
                    }
                }
            }
        }

        return $html;
    }

    /**
     * input[type=hiddn]のHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getHiddenInputHtml($indexName, $hidden=false) {
        $node = $this->getNode($indexName);
        
        if(!$this->getProtectFlag($indexName)) {
            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden);
            } else {
                $html = '<input type="hidden"';
                $html .= $this->insertName($node['name']);
                $html .= $this->insertId($node['name']);
                $html .= $this->insertValue($node['value']);
                $html .= '>'."\n";
                
                //エラーの出力
                if ($this->hasError($indexName)) $html .= $this->createError($indexName);
            }
        } else {
            $html .= '<input type="hidden"';
            $html .= $this->insertName($node['name']);
            $html .= $this->insertId($node['name']);
            $html .= $this->insertValue($node['value']);
            $html .= '>';
        }

        return $html;
    }

    /**
     * input[type=file]のHTMLを生成・取得
     * @param string $indexName
     * @return string
     */
    private function getFileInputHtml($indexName, $hidden=false) {
        $node = $this->getNode($indexName);
        
        if(!$this->getProtectFlag($indexName)) {
            if($this->action === 'confirm' && $this->validate) {
                $html = $this->createChecker($indexName, $hidden=false);
            } else {
                $html = '<input type="file"';
                $html .= $this->insertName($node['name']);
                $html .= $this->insertId($node['name']);
                $html .= $this->insertClassname($node['class']);
                $html .= $this->insertValue($node['value']);
                $html .= '>'."\n";
                $html .= '<button type="button"';
                $html .= $this->insertClassname('btn_file');
                $html .= $this->insertId($node['name'].'_btn');$html .= 'onclick="fileUpload(this);">ファイルを選択</button>'."\n";
                $html .= '<span';
                $html .= $this->insertClassname('file placeholder'); 
                $html .= $this->insertId($node['name'].'_text');
                $html .= '>';
                $html .= $node['placeholder'].'</span>'."\n";
                $html .= '<input type="hidden"';
                $html .= $this->insertName($node['name'].'_name');
                $html .= $this->insertId($node['name'].'_name');
                $html .= $this->insertValue($node['value']);
                $html .= '>'."\n";
                
                //エラーの出力
                if ($this->hasError($indexName)) $html .= $this->createError($indexName);
            }
        } else {
            $html = '<span class="check">'.$node['value'].'</span>';
            $html .= '<input type="hidden"';
            $html .= $this->insertName($node['name']);
            $html .= $this->insertId($node['name']);
            $html .= $this->insertValue($node['value']);
            $html .= '>';
        }

        // ファイルタイプの場合はアップロードディレクトリのパスを記載したhiddeninputを用意
        $html .= '<input type="hidden" name="uploaddir" value="'.$this->uploaddir.'">';

        return $html;
    }

    /**
     * name属性を生成・取得
     * @param string $name
     * @return string
     */
    private function insertName($name) {
        if($this->formName && $name) return ' name="'.$name.'"';
        return '';
    }

    /**
     * id属性を生成・取得
     * @param string $name
     * @return string
     */
    private function insertId($name) {
        if($this->formName && $name) return ' id="form_'.$this->formName.'_'.$name.'"';
        return '';
    }

    /**
     * class属性を生成・取得
     * @param string $classname
     * @return string
     */
    private function insertClassname($classname, $add=array()) {
        if($classname) {
            if (!empty($add)) foreach($add as $item) $classname .= " ${item}";
            return ' class="'.$classname.'"';
        }
        return '';
    }

    /**
     * placeholder属性を生成・取得
     * @param string $placeholder
     * @return string
     */
    private function insertPlaceholder($placeholder) {
        if($placeholder) return ' placeholder="'.$placeholder.'"';
        return '';
    }

    /**
     * value属性を生成・取得
     * @param string $value
     * @return string
     */
    private function insertValue($value) {
        if($value) return ' value="'.$value.'"';
        return '';
    }
}