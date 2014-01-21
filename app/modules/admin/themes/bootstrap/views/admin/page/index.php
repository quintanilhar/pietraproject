<?php

$this->breadcrumbs=array(
	Yii::t('admin', 'Page List'),
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
    <?php echo Yii::t('admin', 'Page List') ?>
    <a href="<?php echo Yii::app()->createUrl('admin/page/create') ?>" class="btn btn-success">
        <span class="glyphicon glyphicon-plus-sign"></span>
        <?php echo Yii::t('admin', 'Add') ?>
    </a>
</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
    'itemsCssClass' => 'table table-responsive',
	'columns'=>array(
		'page_id',
		'title',
		'updated_date',
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
