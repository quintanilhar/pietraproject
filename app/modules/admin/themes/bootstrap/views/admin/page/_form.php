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
        <legend><?php echo Yii::t('admin', 'Details') ?></legend>

    <?php if ($model->getScenario() == 'update') : ?>
    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'page_id',
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

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'small_description',
        'type' => 'textarea',
        'htmlOptions' => array(
            'rows' => 4,
        ),
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'description',
        'type' => 'textarea',
        'htmlOptions' => array(
            'rows' => 15,
            'class' => 'textEditor'
        ),
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'is_visible',
        'type' => 'radiobuttonlist_inline',
        'data' => array(
            1 => Yii::t('admin', 'Yes'),
            0 => Yii::t('admin', 'No'),
        )
    ));
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'tags',
        'type' => 'textarea',
        'htmlOptions' => array(
            'rows' => 4,
        ),
    ));
    ?>

    </fieldset>

    <?php $this->renderPartial('/url/_form', array('model' => $url, 'form' => $form)); ?>

    <fieldset>
        <legend><?php echo Yii::t('admin', 'Choose the category') ?></legend>

        <?php $this->widget('admin.widgets.BInputRow', array(
            'form' => $form,
            'model' => $model,
            'attribute' => 'categories',
            'data' => $categories,
            'type' => 'dropdownlist',
            'htmlOptions' => array(
                'multiple' => 'multiple'
            ),
        ));
        ?>
    </fieldset>

    <fieldset>
        <legend><?php echo Yii::t('admin', 'Upload an image') ?></legend>

        <?php $this->renderPartial('/media/_formFile', array('model' => $media, 'form' => $form)); ?>
    </fieldset>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="<?php echo CHtml::normalizeUrl('/admin/page/index') ?>" class="btn btn-default"><?php echo Yii::t('admin', 'Cancel'); ?></a>

            <?php echo CHtml::submitButton(
                $model->getScenario() == 'create' ? Yii::t('admin', 'Create') : Yii::t('admin', 'Update'),
                array(
                    'class' => 'btn btn-warning'
                )
            ); ?>
        </div>
	</div>

<?php $this->endWidget(); ?>
