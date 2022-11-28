<?php
class Translatable extends MfeActiveRecord
{
        public $translationClass;
        public $translationProperty='translations';
        public function getTranslation($lang) {
        if (isset($this->{$this->translationProperty}[$lang])){
                return $this->{$this->translationProperty}[$lang];
            }
            else {
                $tmp = new $this->translationClass();
                if ($tmp->hasAttribute('parent_id'))
                    $tmp->parent_id = $this->id;
                return $tmp;
            }
        }
        
        
}