<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>
<div class="register">
	<div class="register-form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			));
               
                ?>
			<p class="note">Fields with <span class="required">*</span> are required.</p>
			<p class="error-msg"><?php echo $form->errorSummary($model , null , null, array('class'=>'alert alert-danger')); ?></p>
			<?php
			if (Yii::app()->controller->action->id == 'create' ) {
				?>

				<div class="row">
					<div class="col-sm-2">
						<?php echo $form->emailField($model,'username',array('class'=>'form-control','placeholder'=>'email*', 'id'=>'nama', 'size'=>30,'maxlength'=>30)); ?>
					</div>
				</div>
				<?php
			} else {
				?>
				<div class="row" style="display: none; visibility: hidden;">
					<?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>'username*', 'id'=>'nama', 'size'=>30,'maxlength'=>30)); ?>
				</div>
				<?php
			}
			?>
			<div class="row">
				<div class="col-sm-2">
					<?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>'password*','id'=>'password', 'size'=>30,'maxlength'=>128)); ?>
				</div>
			</div>
			<?php if (extension_loaded('gd')): ?> 
				<div class="row"> 
					<?php echo CHtml::activeLabelEx($model, 'verifyCode') ?> 
					<div> 
						<?php $this->widget('CCaptcha'); ?><br/> 

					</div> 
				</div> 
				<div class="row"> 
					<div class="col-sm-2">
						<?php echo CHtml::activeTextField($model,'verifyCode', array('class'=>'form-control', 'placeholder'=>'verify code*')); ?> 
					</div>
				</div>
			<?php endif; ?> 
			
			<p class="login button">
				<?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save',  array('value'=>'Daftar', 'class'=>'btn btn-primary btn-sm' )); ?>
			</p>
			<?php $this->endWidget(); ?>
		</div>
</div><!-- form -->