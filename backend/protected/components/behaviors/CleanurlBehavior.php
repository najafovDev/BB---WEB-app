<?php
class CleanurlBehavior extends CActiveRecordBehavior
{
    /*
     * @todo Dynamic relation addition needed 
     * 
     *      */
    /*protected function afterConstruct($event) {
        parent::afterConstruct($event);
        $obj = $this->Owner;

        $class = ActiveRecord::HAS_ONE;

        $obj->getMetaData()->relations['cleanurls'] =
            new $class('cleanurls',
                'Cleanurls',
                'parent_id',
                array(
                    'condition' => sprintf("`cleanurls`.`type`='%s'", get_class($obj)),
                    'index'=>'language',
                    'together'=>true
                )
            );

        
    }*/
    public function getCleanurl($lang){
        if ( isset($this->Owner->cleanurls[$lang]))
            return $this->Owner->cleanurls[$lang];
        else {
            $tmp = new Cleanurls();
            $tmp->type=get_class($this->Owner);
            $tmp->parent_id = $this->Owner->id;
            $tmp->url = Utilities::str2url((isset($this->Owner->translations)?$this->Owner->getTranslation($lang)->name:$this->Owner->name));
            $tmp->language = $lang;
            $tmp->save();
            return $tmp;
        }
    }
    
}
