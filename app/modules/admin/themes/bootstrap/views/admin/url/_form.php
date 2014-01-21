<fieldset>
    <legend><?php echo Yii::t('admin', 'Website Address'); ?></legend>

    <?php 
        if ($model->getScenario() != 'create') {
            echo CHtml::activeHiddenField($model, 'url_id');
            echo CHtml::activeHiddenField($model, 'type');
        }
    ?>

    <?php $this->widget('admin.widgets.BInputRow', array(
        'form' => $form,
        'model' => $model,
        'attribute' => 'url',
        'type' => 'text',
        'prependText' => $this->createAbsoluteUrl('/') . '/'
    ));
    ?>

</fieldset>
