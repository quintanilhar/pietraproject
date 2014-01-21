<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Banner List') => array('index'),
	$model->banner_id => array('view','id'=> $model->banner_id),
	Yii::t('admin', 'Update'),
);

?>

<h1><?php echo Yii::t('admin', 'Update banner #{id}', array('{id}' => $model->banner_id)); ?></h1>

<?php
    $this->renderPartial(
        '_form',
        array(
            'model' => $model,
            'media' => $media,
        )
    );
?>
