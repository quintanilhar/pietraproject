<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	Yii::t('admin', 'Categories') => array('index'),
	$model->title => array('view','id'=>$model->category_id),
	Yii::t('admin', 'Update'),
);

?>

<h1><?php echo Yii::t('admin', 'Update the category {name}', array('{name}' => $model->title)); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model, 'url' => $url)); ?>
