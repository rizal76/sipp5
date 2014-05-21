<?php
/* @var $this LamaranController */
/* @var $data Lamaran */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pelamar')); ?>:</b>
	<?php echo CHtml::encode($data->id_pelamar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lowongan')); ?>:</b>
	<?php echo CHtml::encode($data->id_lowongan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tahap')); ?>:</b>
	<?php echo CHtml::encode($data->id_tahap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hasil_tugas')); ?>:</b>
	<?php echo CHtml::encode($data->hasil_tugas); ?>
	<br />


</div>