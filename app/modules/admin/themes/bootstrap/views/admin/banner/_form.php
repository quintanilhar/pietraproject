<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
        'enctype' => 'multipart/form-data' 
    )
)); ?>

    <fieldset>

    <?php if ($model->getScenario() == 'update') : ?>
    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'banner_id',
        'type' => 'static',
    ));
    ?>
    <?php endif; ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $media,
        'attribute' => 'title',
        'type' => 'text',
    ));
    ?>

    <?php $this->renderPartial('/media/_formFile', array('model' => $media, 'form' => $form)); ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'order',
        'type' => 'text',
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'link',
        'type' => 'text',
        'helperText' => Yii::t('admin', 'Use a full url. Ex.: http://mysite.com/url')
    ));
    ?>

    </fieldset>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="<?php echo Yii::app()->createUrl('admin/banner/index') ?>" class="btn btn-default"><?php echo Yii::t('admin', 'Cancel'); ?></a>

            <?php echo CHtml::submitButton(
                $model->getScenario() == 'create' ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'),
                array(
                    'class' => 'btn btn-warning'
                )
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
