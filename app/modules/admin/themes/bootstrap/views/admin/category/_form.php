<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form' 
    )
)); ?>

    <fieldset>
        <legend><?php echo Yii::t('admin', 'Category Details') ?></legend>

    <?php if ($model->getScenario() == 'update') : ?>
    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'category_id',
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

    <?php $this->renderPartial('/url/_form', array('model' => $url, 'form' => $form)); ?>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="<?php echo CHtml::normalizeUrl('/admin/category/index') ?>" class="btn btn-default"><?php echo Yii::t('admin', 'Cancel'); ?></a>

            <?php echo CHtml::submitButton(
                $model->getScenario() == 'create' ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'),
                array(
                    'class' => 'btn btn-warning'
                )
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
