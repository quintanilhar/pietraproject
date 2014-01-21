<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	Yii::t('admin', 'Users List') => array('index'),
	'Update',
);

?>

<h1><?php echo Yii::t('admin', 'Update user {name}', array('{name}' => $model->first_name . ' ' . $model->last_name)); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
