<?php

$this->breadcrumbs=array(
    Yii::t('admin', 'Blog'),
	Yii::t('admin', 'Category List') => array('index'),
	$model->title => array('view','id'=>$model->category_id),
	Yii::t('admin', 'Update'),
);

?>

<h1><?php echo Yii::t('admin', 'Update the category {name}', array('{name}' => $model->title)); ?></h1>

<?php $this->renderPartial('/category/_form', array('model' => $model, 'url' => $url)); ?>
