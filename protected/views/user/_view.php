<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view" style="text-align:center">

	<b> Selamat </b>
	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />
	<b>, Anda telah terdaftar sebagai member. Silahkan isi data diri untuk melamar </b>
	


</div>