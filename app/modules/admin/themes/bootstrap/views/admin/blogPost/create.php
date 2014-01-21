<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
    Yii::t('admin', 'Blog'),
	Yii::t('admin', 'Post List') => array('index'),
	Yii::t('admin', 'Create a Post'),
);

?>

<h1><?php echo Yii::t('admin', 'Create a Post') ?></h1>

<?php
    $this->renderPartial(
        '/page/_form',
        array(
            'model' => $model,
            'url' => $url,
            'media' => $media,
            'categories' => $categories
        )
    );
?>
