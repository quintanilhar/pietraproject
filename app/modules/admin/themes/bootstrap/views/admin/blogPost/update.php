<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
    Yii::t('admin', 'Blog'),
	Yii::t('admin', 'Post List') => array('index'),
	$model->title => array('view','id'=> $model->page_id),
	Yii::t('admin', 'Update'),
);

?>

<h1><?php echo Yii::t('admin', 'Update post {name}', array('{name}' => $model->title)); ?></h1>

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
