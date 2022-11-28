<?php
class elRTE extends CInputWidget
{
   public $options = array();
   public $elfoptions = array();
   public $jui_elrte_css = "default";
   public $jui_elfinder_css = "default";

   public function run()
   {
      $cs=Yii::app()->clientScript;
      
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR;
      $baseUrl = Yii::app()->getAssetManager()->publish($dir).'/elrte';
      $baseUrlE = Yii::app()->getAssetManager()->publish($dir).'/elfinder';
      list($name, $id) = $this->resolveNameID();
      if(isset($this->htmlOptions['id']))
      {
            $id=$this->htmlOptions['id'];
      } else {
            $this->htmlOptions['id']=$id;
      }
      if(isset($this->htmlOptions['name']))
      {
            $name=$this->htmlOptions['name'];
      } else {
            $this->htmlOptions['name']=$name;
      }

      $clientScript = Yii::app()->getClientScript();

      //$clientScript->registerCssFile($baseUrl.'/js/ui-themes/base/ui.all.css');
      if(!empty($this->jui_elrte_css))
      {
        if($this->jui_elrte_css == "default") //backward Compatibility
        {
            $clientScript->registerCssFile($baseUrl.'/css/elrte.full.css');
        } else {
            $clientScript->registerCssFile($baseUrl.'/css/'.$this->jui_elrte_css);
        }
      } else {
		$clientScript->registerCssFile($baseUrl.'/css/elrte.full.css');
	  }
      //$clientScript->registerCoreScript('jquery');
	  //$clientScript->registerCoreScript('jquery.ui');
      //$clientScript->registerScriptFile($baseUrl.'/js/jquery-1.6.1.min.js');
      //$clientScript->registerScriptFile($baseUrl.'/js/jquery-ui-1.8.13.custom.min.js');
      $clientScript->registerCssFile($baseUrl.'/css/smoothness/jquery-ui-1.10.4.custom.min.css');
      $clientScript->registerScriptFile($baseUrl.'/js/elrte.full.js',CClientScript::POS_HEAD);
	  

	  

      if (isset($this->options['lang']))
            $clientScript->registerScriptFile($baseUrl.'/js/i18n/elrte.'.$this->options['lang'].'.js',CClientScript::POS_HEAD);
      if (!isset($this->options['name']))
            $this->options['name'] = $name;
      $this->options['toolbar'] = 'maxi';
      if(!empty($this->options['cssfiles']))
      {
         $css_paths = array();
         foreach ($this->options['cssfiles'] as $cssf)
         {
             $css_paths[] = $baseUrl.'/'.$cssf;
         }
         $this->options['cssfiles'] = $css_paths;
      }

      //from here
      $elfopts = "";
      if(!empty($this->options['fmAllow']))
      {
            //$clientScript->registerCssFile($baseUrlE.'/js/ui-themes/base/ui.all.css');
            $clientScript->registerCssFile($baseUrlE.'/css/elfinder.min.css');
            $clientScript->registerCssFile($baseUrlE.'/css/theme.css');//.$this->jui_elfinder_css);
            $clientScript->registerScriptFile($baseUrlE.'/js/elfinder.min.js',CClientScript::POS_HEAD);

          if(!empty($this->elfoptions))
          {
              if($this->elfoptions['url'] == 'auto') $this->elfoptions['url'] =  Yii::app()->controller->createUrl('site/connector');
          }
          else {
              $this->elfoptions = array(
                                                'url' =>Yii::app()->controller->createUrl('site/connector'),
                                                'commandsOptions'=>array(
                                                    'getfile'=>array(
                                                        'oncomplete'=>'destroy'
                                                    )
                                                ),
                                                'getFileCallback'=>'js:callback'
                                );
          }
          $elfopts = CJavaScript::encode($this->elfoptions);
      }

      //to here!
      $optsenc = CJavaScript::encode($this->options);
      if(!empty($elfopts)) $optsenc = str_replace('%elfopts%', $elfopts, $optsenc);
      $js="$().ready(function(){";
      $js.="var opts=";
      $js.= $optsenc;
      $js.=";";
      $js.="$('#".$id."').elrte(opts);";
      $js.="})";

      $cs->registerScript($id,$js,CClientScript::POS_HEAD);
      echo '<textarea id="'.$id.'" name="'.$name.'" rows="10" cols="40">';
          echo $this->model['attributes'][$this->attribute];
      echo '</textarea>';
    }
}
?>
