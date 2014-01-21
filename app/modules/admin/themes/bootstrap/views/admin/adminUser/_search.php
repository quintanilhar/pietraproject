<div class="row">
    <div class="col-sm-5">
        <div class="panel panel-default">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'action'=>Yii::app()->createUrl($this->route),
                'method'=>'get',
            )); ?>

            <div class="panel-heading">
                <h3 class="panel-title"><?php echo Yii::t('admin', 'Search an User') ?></h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <?php echo $form->label($model,'admin_user_id'); ?>
                    <?php echo $form->textField($model,'admin_user_id',array('size'=>11,'maxlength'=>11, 'class' => 'form-control')); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>145, 'class' => 'form-control')); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model,'is_active'); ?>
                    <div class="checkbox">
                        <?php echo $form->radioButtonList($model,'is_active', array(1 => 'Yes', 0 => 'No')); ?>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button class="btn btn-default"><?php echo Yii::t('admin', 'Search') ?></button>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
