<?php
/* @var $this LamaranController */
/* @var $model Lamaran */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lamaran-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pelamar'); ?>
		<?php echo $form->textField($model,'id_pelamar'); ?>
		<?php echo $form->error($model,'id_pelamar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lowongan'); ?>
		<?php echo $form->textField($model,'id_lowongan'); ?>
		<?php echo $form->error($model,'id_lowongan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tahap'); ?>
		<?php echo $form->textField($model,'id_tahap'); ?>
		<?php echo $form->error($model,'id_tahap'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hasil_tugas'); ?>
		<?php echo $form->textField($model,'hasil_tugas',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'hasil_tugas'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->