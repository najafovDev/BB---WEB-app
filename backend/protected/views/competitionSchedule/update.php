<?php
/* @var $this CompetitionScheduleController */
/* @var $model CompetitionSchedule */

$this->breadcrumbs=array(
	'Competition Schedules'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CompetitionSchedule', 'url'=>array('index')),
	array('label'=>'Create CompetitionSchedule', 'url'=>array('create')),
	array('label'=>'View CompetitionSchedule', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CompetitionSchedule', 'url'=>array('admin')),
);
?>

<h1>Update Competition <?php echo $model->title; ?></h1>
<div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#CompetitionUpdateForm" data-toggle="tab"><strong>Competition Update Form</strong></a></li>
        <li class=""><a href="#Userslist" data-toggle="tab"><strong>Users list</strong></a></li>
        <li class=""><a href="#Results" data-toggle="tab"><strong>Results</strong></a></li>
    </ul>
    <div class="tab-content">
            <div class="tab-pane active" id="CompetitionUpdateForm">
                <?php $this->renderPartial('_form', array('model'=>$model)); ?>
            </div>
            <div class="tab-pane" id="Userslist">
                <?php 		
                    $user = new UserList();
                    $user->unsetAttributes();
                    $user->comp_id = $model->id;
                    if (isset($_GET['UserList']))
                        $user->attributes = $_GET['UserList'];

                    $this->renderPartial('//userList/admin',array(
                            'model'=>$user,
                    ));
                ?>
            </div>
            <div class="tab-pane" id="Results">
                <?php 		
                    $results = new CompetitionResults();
                    $results->unsetAttributes();
                    $results->compt_id = $model->id;
                    if (isset($_GET['CompetitionResults']))
                        $results->attributes = $_GET['CompetitionResults'];

                    $this->renderPartial('//competitionResults/admin',array(
                            'model'=>$results,
                    ));
                ?>
            </div>
    </div>
</div>