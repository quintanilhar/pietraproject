<div class="panel panel-default">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('admin', 'Search an Page') ?></h3>
    </div>
    <div class="panel-body">

        <div>
		<?php echo $form->label($model,'media_id'); ?>
		<?php echo $form->textField($model,'media_id',array('size'=>11,'maxlength'=>11)); ?>
        </div>

        <div>
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>180)); ?>
        </div>

    </div>
    <div class="panel-footer">
        <button class="btn btn-default"><?php echo Yii::t('admin', 'Search') ?></button>
    </div>

    <?php $this->endWidget(); ?>
</div>
