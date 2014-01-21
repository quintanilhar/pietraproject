<?php

$this->breadcrumbs=array(
    Yii::t('admin', 'Blog'),
	Yii::t('admin', 'Configuration')
);

?>

<?php if(Yii::app()->user->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span class="glyphicon glyphicon-ok"></span>
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<h1><?php echo Yii::t('admin', 'Blog configuration'); ?></h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    )
)); ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'blogName',
        'type' => 'text',
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'homeBlog',
        'type' => 'text',
        'prependText' => $this->createAbsoluteUrl('/') . '/'
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'postsPerPage',
        'type' => 'text',
    ));
    ?>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <?php echo CHtml::submitButton(
                Yii::t('admin', 'Update'),
                array(
                    'class' => 'btn btn-warning'
                )
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
