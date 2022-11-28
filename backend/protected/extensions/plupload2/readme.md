##plupload
The following container integrates the Plupload (http://www.plupload.com)
component, allowing you to add multiple images interactively.

##Configure
If you want to change settings, first check the documentation component
(http://www.plupload.com/documentation.php)
 
##Requirements

Yii 1.14

##Usage

1) Extract content in your extensions directory

1) Call the widget in your view:
~~~
<?php $this->widget('ext.plupload.Plupload'); ?>
~~~
3) Embed this actions in the controller that makes the call:
~~~
public function actions() {
  ...
  'upload' => 'ext.plupload.actions.UploadAction',
  'destroy' => 'ext.plupload.actions.DestroyAction',
  ...
}
~~~