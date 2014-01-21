<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Banner List') => array('index'),
	Yii::t('admin', 'Create a Banner'),
);

?>

<h1><?php echo Yii::t('admin', 'Create a Banner') ?></h1>

<?php
    $this->renderPartial(
        '_form',
        array(
            'model' => $model,
            'media' => $media,
        )
    );
?>
