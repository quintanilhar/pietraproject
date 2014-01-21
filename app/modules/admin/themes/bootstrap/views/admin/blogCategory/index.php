<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
    Yii::t('admin', 'Blog'),
	Yii::t('admin', 'Category List'),
);

?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="glyphicon glyphicon-ok"></span>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h1><?php echo Yii::t('admin', 'Category List') ?>

<a class="btn btn-success" href="<?php echo CHtml::normalizeUrl(array('blogCategory/create')) ?>">
    <span class="glyphicon glyphicon-plus-sign"></span>
    <?php echo Yii::t('admin', 'Add'); ?>
</a></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
    'itemsCssClass' => 'table table-responsive',
	'columns'=>array(
		'category_id',
		'title',
        array(
            'class' => 'admin.widgets.AdminButtonColumn',
        )
	),
)); ?>
