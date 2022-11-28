<?php
class Sortable extends CActiveRecord
{
        public $translationClass;
        public $translationProperty='translations';
        public function getTranslation($lang) {
        if (isset($this->{$this->translationProperty}[$lang])){
                return $this->{$this->translationProperty}[$lang];
            }
            else return new $this->translationClass();
        }
}