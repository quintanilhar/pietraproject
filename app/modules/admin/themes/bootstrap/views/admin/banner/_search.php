<div class="panel panel-default">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('admin', 'Search a Banner') ?></h3>
    </div>
    <div class="panel-body">

        <div>
		<?php echo $form->label($model,'banner_id'); ?>
		<?php echo $form->textField($model,'banner_id',array('maxlength'=>5)); ?>
        </div>

        <div>
		<?php echo $form->label($model,'order'); ?>
		<?php echo $form->textField($model,'order',array('maxlength'=>5)); ?>
        </div>

    </div>
    <div class="panel-footer">
        <button class="btn btn-default"><?php echo Yii::t('admin', 'Search') ?></button>
    </div>

    <?php $this->endWidget(); ?>
</div>
