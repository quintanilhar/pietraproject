<?php 

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'page-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
            'role' => 'form',
            'enctype' => 'multipart/form-data' 
        )
    )); 
?>

    <?php if ($model->getScenario() == 'update') : ?>
    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'media_id',
        'type' => 'static',
    ));
    ?>
    <?php endif; ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'title',
        'type' => 'text',
    ));
    ?>

    <?php $this->renderPartial('/media/_formFile', array('model' => $model, 'form' => $form)); ?>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="<?php echo Yii::app()->createUrl('admin/media/index') ?>" class="btn btn-default"><?php echo Yii::t('admin', 'Cancel'); ?></a>

            <?php echo CHtml::submitButton(
                $model->getScenario() == 'create' ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'),
                array(
                    'class' => 'btn btn-warning'
                )
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
