<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

?>

<div class="login-form">
	
	<h2 class="judul" style="text-align:center">Daftar Akun Baru</h2>
	

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

</div>