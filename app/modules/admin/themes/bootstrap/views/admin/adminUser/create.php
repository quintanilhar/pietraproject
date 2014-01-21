<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Users List') => array('index'),
	'Create',
);

?>

<h1><?php echo Yii::t('admin', 'Create an User') ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
