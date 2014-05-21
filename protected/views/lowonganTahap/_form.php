<?php
/* @var $this LowonganTahapController */
/* @var $model LowonganTahap */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lowongan-tahap-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<?php foreach($model as $i=>$item): ?>
	<div class="row">
		<?php echo $form->labelEx($item,'id_tahap'); ?>
		<?php echo $form->hiddenField($item,'id_tahap', array('value'=>$item->id)); ?>
		<?php echo $form->error($item,'id_tahap'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($item,'deskripsi'); ?>
		<?php echo $form->textField($item,'['.$i.']deskripsi',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($item,'deskripsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($item,'file_tugas'); ?>
		<?php echo $form->textField($item,'['.$i.']file_tugas',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($item,'file_tugas'); ?>
	</div>

<?php endforeach; ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->