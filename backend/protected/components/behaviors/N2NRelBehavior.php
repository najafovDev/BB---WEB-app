<?php
class N2NRelBehavior extends CActiveRecordBehavior
{
    public function events()
    {
            return array(
//                  'onBeforeValidate'=>'beforeValidate',
                    'onBeforeSave'=>'beforeSave',
                    'onAfterSave'=>'afterSave',
                    'onAfterFind'=>'afterFind',
//                  'onBeforeDelete'=>'beforeDelete',
//                  'onAfterDelete'=>'afterDelete',
            );
    }
    public function afterFind($event) {
        foreach($this->owner->n2nrel_names as $rel){
            $tmp=  N2NRel::model()->findAllByAttributes(array(
                'type1'=>get_class($this->owner),
                'type2'=>$rel,
                'type1_id'=>$this->owner->id
            ));
            foreach($tmp as $model){
                $this->owner->n2nrel_ids[$rel][] = $model->type2_id;
                $tmpClassName = $model->type2;
                $this->owner->n2nrel[$rel][] = $tmpClassName::model()->findByPk($model->type2_id);
            }
        }

    }
    public function beforeSave($event) {
        foreach($this->owner->n2nrel_names as $rel){
            N2NRel::model()->deleteAllByAttributes(array('type1'=>get_class($this->owner),'type2'=>$rel,'type1_id'=>$this->owner->id));
            $this->owner->n2nrel[$rel] = array();
            if (isset($this->owner->n2nrel_ids[$rel]) && is_array(($this->owner->n2nrel_ids[$rel]))){
                foreach($this->owner->n2nrel_ids[$rel] as $id){
                    $model = new N2NRel;
                    $model->type1 = get_class($this->owner);
                    $model->type2 = $rel;
                    $model->type1_id = $this->owner->id;
                    $model->type2_id = $id;
                    if ($model->save()) {}
                    //else print_r($model->errors);
                }
            }
        }
        
    }
    public function getN2nrel_ids($rel=null){
        if (isset($this->owner->n2nrel_ids[$rel]))
            return $this->owner->n2nrel_ids[$rel];
        return array();
    }
    public function setN2nrel_ids($arr){
        foreach($this->owner->n2nrel_names2 as $rel){
            N2NRel::model()->deleteAllByAttributes(array('type1'=>get_class($this->owner),'type2'=>$rel,'type1_id'=>$this->owner->id));
            $this->owner->n2nrel[$rel] = array();
            if (isset($arr[$rel]) && is_array(($arr[$rel]))){
                foreach($arr[$rel] as $id){
                    $model = new N2NRel;
                    $model->type1 = get_class($this->owner);
                    $model->type2 = $rel;
                    $model->type1_id = $this->owner->id;
                    $model->type2_id = $id;
                    if ($model->save()) {}
                    //else print_r($model->errors);
                }
            }
        }
    }
    
}
