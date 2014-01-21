<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	Yii::t('admin', 'Categories') => array('index'),
	Yii::t('admin', 'Create'),
);
?>

<h1><?php echo Yii::t('admin', 'Create a Category') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model, 'url' => $url)); ?>
