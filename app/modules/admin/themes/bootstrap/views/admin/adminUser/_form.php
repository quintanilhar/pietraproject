<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-user-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form' 
    )
)); ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'first_name',
        'type' => 'text',
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'last_name',
        'type' => 'text',
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'email',
        'type' => 'text',
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'password',
        'type' => 'password',
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'is_active',
        'type' => 'radiobuttonlist_inline',
        'data' => array(
            1 => Yii::t('admin', 'Yes'),
            0 => Yii::t('admin', 'No'),
        )
    ));
    ?>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="<?php echo Yii::app()->createUrl('admin/adminUser/index') ?>" class="btn btn-default"><?php echo Yii::t('admin', 'Cancel'); ?></a>

            <?php echo CHtml::submitButton(
                $model->getScenario() == 'create' ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'),
                array(
                    'class' => 'btn btn-warning'
                )
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
