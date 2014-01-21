<h1><?php echo Yii::t('admin', 'View Page #') . $model->page_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'page_id',
		'title',
		'small_description',
		'description',
		'is_visible',
		'updated_date',
		'created_date',
        'url.url',
	),
)); ?>
