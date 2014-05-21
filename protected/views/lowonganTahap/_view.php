<?php
/* @var $this LowonganTahapController */
/* @var $data LowonganTahap */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lowongan')); ?>:</b>
	<?php echo CHtml::encode($data->id_lowongan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tahap')); ?>:</b>
	<?php echo CHtml::encode($data->id_tahap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_tugas')); ?>:</b>
	<?php echo CHtml::encode($data->file_tugas); ?>
	<br />


</div>