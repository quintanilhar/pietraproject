<?php
/* @var $this AdminUserController */
/* @var $model AdminUser */

$this->breadcrumbs=array(
	Yii::t('admin', 'Users List')
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

<?php echo Yii::t('admin', 'Users List') ?>

<a class="btn btn-success" href="<?php echo Yii::app()->createUrl('admin/adminUser/create') ?>">
    <span class="glyphicon glyphicon-plus-sign"></span>
    <?php echo Yii::t('admin', 'Add'); ?>
</a>
</h1>

<p>
<button class="btn btn-default" id="search"><span class="glyphicon glyphicon-search"></span> <?php echo Yii::t('admin', 'Search'); ?></button>
</p>

<div class="searchForm" style="display:none;">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 

$provider = $model->search(); 

?>

<h5 style="text-align:right"><?php $this->widget('admin.widgets.BSummaryPager', array('dataProvider' => $provider)) ?></h5>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-user-grid',
	'dataProvider'=>$provider,
    'template' => '{items}',
    'itemsCssClass' => 'table table-responsive',
	'columns'=>array(
		'admin_user_id',
		'first_name',
		'last_name',
		'email',
        array(
		    'name' => 'is_active',
            'sortable' => true,
            'type'=>'raw',
            'value' => '$data->is_active ?
                "<span class=\"label label-success\">" . Yii::t("admin", "Yes") . "</span>"
                : "<span class=\"label label-danger\">" . Yii::t("admin", "No") . "</span>"',
        ),
        array(
            'class' => 'admin.widgets.AdminButtonColumn',
            'template' => '{view} {update}'
        )
	),
)); ?>

<?php 

$this->widget('admin.widgets.BLinkPager', array(
    'pages' => $provider->pagination,
)) 

?>
