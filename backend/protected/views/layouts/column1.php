<?php $this->beginContent('//layouts/main'); ?>
            <div class="leftpanel">
		<?php echo $this->renderPartial('//layouts/page_left',$this->left); ?>
            </div>
            <div class="contextpanel contextpanel1">
                <div class="panel-caption">
                    CONTENT
                </div>
                <div class="panel-body">
                    <div class="panel-tree col-md-12">
                        
                    </div>
                </div>
            </div>
            <div class="contextpanel contextpanel2 actionpanel">
                <div class="panel-caption">
                    OPTIONS <span class="pull-right glyphicon glyphicon-remove"></span>
                </div>
                <div class="panel-body">

                </div>
            </div>
            <div class="mainpanel">
		<?php echo $this->renderPartial('//layouts/page_header',$this->header); ?>
                <!--<div class="pageheader">
                      <h2><i class="fa fa-home"></i> Dashboard <span>Subtitle goes here...</span></h2>
                      <div class="breadcrumb-wrapper">
                        <span class="label">You are here:</span>
                            <?php /*$this->widget('application.components.Breadcrumbs',array(
                                            'items'=>$this->breadcrumbs,
                                    ));*/
                            ?>
                      </div>
                </div>-->
                <div class="contentpanel">
                    <?php echo $content; ?>
                </div>
            </div>
            <div class="rightpanel">
                <?php //echo $this->renderPartial('//layouts/page_right',$this->right); ?>
            </div>
<?php $this->endContent(); ?>