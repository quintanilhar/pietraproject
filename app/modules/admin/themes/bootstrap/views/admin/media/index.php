<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Media Gallery'),
);

?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="glyphicon glyphicon-ok"></span>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h1>
<?php echo Yii::t('admin', 'Media Gallery') ?>

<a class="btn btn-success" href="<?php echo Yii::app()->createUrl('admin/media/create') ?>">
    <span class="glyphicon glyphicon-plus-sign"></span>
    <?php echo Yii::t('admin', 'Add'); ?>
</a>
</h1>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php 

$provider = $model->search(); 

?>

<h5><?php $this->widget('admin.widgets.BSummaryPager', array('dataProvider' => $provider)) ?></h5>

<div class="row">
<?php $counter = 1; ?>
<?php foreach ($provider->getData() as $media) : ?>
    <div class="col-sm-3 col-md-3">
        <div class="thumbnail">
            <img src="<?php echo $media->getUrl() ?>" alt="" class="img-thumbnail">
            <div class="caption">
                <h4><?php echo $media->title; ?></h4>
                <p>
                    <a href="<?php echo Yii::app()->createUrl('admin/media/update', array('id' => $media->media_id)); ?>" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="<?php echo Yii::app()->createUrl('admin/media/delete', array('id' => $media->media_id)); ?>" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-remove"></span></a>
                </p>
            </div>
        </div>
    </div>
<?php 

if ($counter++ == 4) {
    echo '</div><div class="row">';
    $counter = 1;
}

?>
<?php endforeach; ?>
</div>

<?php 

$this->widget('admin.widgets.BLinkPager', array(
    'pages' => $provider->pagination,
)) 

?>
