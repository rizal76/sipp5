<?php
/* @var $this LamaranController */
/* @var $model Lamaran */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id_pelamar'); ?>
		<?php echo $form->textField($model,'id_pelamar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_lowongan'); ?>
		<?php echo $form->textField($model,'id_lowongan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_tahap'); ?>
		<?php echo $form->textField($model,'id_tahap'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hasil_tugas'); ?>
		<?php echo $form->textField($model,'hasil_tugas',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->