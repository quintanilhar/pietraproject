<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	Yii::t('admin', 'Page List') => array('index'),
	Yii::t('admin', 'Create a Page'),
);

?>

<h1><?php echo Yii::t('admin', 'Create a Page') ?></h1>

<?php
    $this->renderPartial(
        '_form',
        array(
            'model' => $model,
            'url' => $url,
            'media' => $media,
            'categories' => $categories
        )
    );
?>
