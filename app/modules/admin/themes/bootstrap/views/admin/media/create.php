<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Media List') => array('index'),
	Yii::t('admin', 'Create'),
);
?>

<h1><?php echo Yii::t('admin', 'Create a Media') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
