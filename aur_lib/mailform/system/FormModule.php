<?php

class FormModule {
    private $label;             // ラベル名
    private $type;              // インプットタイプ
    private $name;              // 名前
    private $value;             // value値
    private $inputValue;        // 更新value値
    private $classname;         // クラス名
    private $placeholder;       // プレースホルダー
    private $protect;           // 保護フラグ
    private $require;           // 入力必須フラグ
    private $checkType;         // バリデーションタイプ
    private $relationItem;      // 選択条件
    private $relationOperator;  // 選択条件の論理演算

    private $delimiter; // 区切り文字

    public function __construct() {
        $this->delimiter = '/';
        $this->relation;
    }
    
    /**
     * ラベル名を格納
     * @param string $label
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * インプットタイプを格納
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * 名前を格納
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * value値を格納
     * @param string $value
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * POST、GETで受け取った値を格納
     * @param string $inputValue
     */
    public function setInputValue($inputValue) {
        $this->inputValue = $inputValue;
    }

    /**
     * クラス名を格納
     * @param string $classname
     */
    public function setClassname($classname) {
        $this->classname = $classname;
    }

    /**
     * プレースホルダーを格納
     * @param string $placeholder
     */
    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;
    }

    /**
     * 保護フラグを格納
     * @param integer $protect
     */
    public function setProtect($protect) {
        $this->protect = $protect;
    }

    /**
     * 必須フラグを格納
     * @param integer $require
     */
    public function setRequire($require) {
        $this->require = $require;
    }

    /**
     * バリデーションタイプを格納
     * @param string $checktype
     */
    public function setCheckType($checktype) {
        $this->checktype = $checktype;
    }

    /**
     * リレーションインデックスを格納
     * @param string $relationItem
     */
    public function setRelationItem($relationItem) {
        if (!$this->relation) $this->relation = array();

        if($relationItem) {
            $relationItemArray = array();
            $relationItems = explode($this->delimiter, $relationItem);
            foreach($relationItems as $relationItem) {
                $relationItem = explode(':', $relationItem);
                $relationValue = array();
                if (isset($relationItem[1])) $relationValue = explode('|', $relationItem[1]);
                $relationItemArray[$relationItem[0]] = $relationValue;
            }
            $this->relation['relationItems'] = $relationItemArray;
        } 
    }

    /**
     * リレーションインデックスのオペレーターを格納
     * @param string $relationOperator
     */
    public function setRelationOperator($relationOperator) {
        if ($relationOperator) $this->formNode[$indexName]['relation']['relationOperator'] = $relationOperator;
    }

    

    /**
     * ラベル名を取得
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }
}