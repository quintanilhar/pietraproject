<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Banner List'),
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
    <?php echo Yii::t('admin', 'Banner List') ?>
    <a href="<?php echo Yii::app()->createUrl('admin/banner/create') ?>" class="btn btn-success">
        <span class="glyphicon glyphicon-plus-sign"></span>
        <?php echo Yii::t('admin', 'Add') ?>
    </a>
</h1>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'itemsCssClass' => 'table table-responsive',
	'columns'=>array(
		'banner_id',
        'media.title',
		'order',
        array(
            'class' => 'admin.widgets.AdminButtonColumn',
        )
	),
)); ?>
