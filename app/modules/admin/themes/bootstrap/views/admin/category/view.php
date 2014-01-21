<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?php echo Yii::t('admin', 'View Category #{category_id}', array('{category_id}' => $model->category_id)); ?></h4>
  </div>
  <div class="modal-body">
    <?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
            'category_id',
            'title',
            'url.url',
        ),
    )); ?>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('admin', 'Close') ?></button>
  </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
