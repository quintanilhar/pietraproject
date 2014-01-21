<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	'Categories',
);

?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="glyphicon glyphicon-ok"></span>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h1><?php echo Yii::t('admin', 'List of Categories') ?>

<a class="btn btn-success" href="<?php echo CHtml::normalizeUrl(array('category/create')) ?>">
    <span class="glyphicon glyphicon-plus-sign"></span>
    <?php echo Yii::t('admin', 'Add'); ?>
</a></h1>

<div class="search-form" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
    'itemsCssClass' => 'table table-responsive',
	'columns'=>array(
		'category_id',
		'title',
        array(
            'name' => 'url',
            'value' => '$data->url->url'
        ),
        array(
            'class' => 'admin.widgets.AdminButtonColumn',
        )
	),
)); ?>

<div class="modal fade" id="modal" tabindex="-1" role="dialog"></div><!-- /.modal -->
