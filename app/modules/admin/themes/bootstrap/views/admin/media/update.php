<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	Yii::t('admin', 'Media List') => array('index'),
	Yii::t('admin', 'Media') . ' #' . $model->media_id => array('view','id'=>$model->media_id),
	Yii::t('admin', 'Update'),
);

?>

<h1><?php echo Yii::t('admin', 'Update the media {name}', array('{name}' => $model->title)); ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
