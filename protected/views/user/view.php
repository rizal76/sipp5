<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);


?>

<h1>View Admin <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
	),
)); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$admin,
	'attributes'=>array(
		'departemen',
	),
)); ?>