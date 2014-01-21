<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->admin_user_id), array('view', 'id'=>$data->admin_user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_visible')); ?>:</b>
	<?php echo $data->is_visible ? 'Sim' : 'Não'; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />


</div>
