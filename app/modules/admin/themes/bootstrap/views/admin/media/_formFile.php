<?php if ($model->getScenario() == 'update'): ?>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo Yii::t('admin', 'Current file') ?></label>
    <div class="col-sm-9">
        <p class="form-control-static">
        <img src="<?php echo $model->getUrl() ?>" class="img-thumbnail" />
        </p>
    </div>
</div>

<?php endif; ?>

<?php $this->widget('admin.widgets.BInputRow', array(
    'form' => $form,
    'model' => $model,
    'attribute' => 'file',
    'type' => 'file',
));
?>
