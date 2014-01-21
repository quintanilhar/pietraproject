<?php

$this->breadcrumbs=array(
    Yii::t('admin', 'Blog'),
	Yii::t('admin', 'Post List'),
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
    <?php echo Yii::t('admin', 'Post List') ?>
    <a href="<?php echo Yii::app()->createUrl('admin/blogPost/create') ?>" class="btn btn-success">
        <span class="glyphicon glyphicon-plus-sign"></span>
        <?php echo Yii::t('admin', 'Add') ?>
    </a>
</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
    'itemsCssClass' => 'table table-responsive',
	'columns'=>array(
        array(
            'name' => 'page_id',
            'header' => Yii::t('admin', 'Post Id'),
        ),
		'title',
		'created_date',
        array(
		    'name' => 'is_visible',
            'sortable' => true,
            'type'=>'raw',
            'value' => '$data->is_visible ?
                "<span class=\"label label-success\">" . Yii::t("admin", "Yes") . "</span>"
                : "<span class=\"label label-danger\">" . Yii::t("admin", "No") . "</span>"',
        ),
        array(
            'class' => 'admin.widgets.AdminButtonColumn',
        )
	),
)); ?>
