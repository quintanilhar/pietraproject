<?php

$this->breadcrumbs=array(
	'Admin Users'=>array('index'),
	$model->first_name . ' ('. $model->email .')',
);
?>

<h1>View User #<?php echo $model->admin_user_id; ?></h1>

<div class="row">
    <div class="col-sm-2">
        <?php echo $model->getAttributeLabel('admin_user_id') ?>
    </div>
    <div class="col-sm-10">
        <?php echo $model->admin_user_id ?>
    </div>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'admin_user_id',
		'first_name',
		'last_name',
		'email',
		'is_active',
		'created_date',
	),
)); ?>
