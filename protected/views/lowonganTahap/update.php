<?php
/* @var $this LowonganTahapController */
/* @var $model LowonganTahap */

$this->breadcrumbs=array(
	'Lowongan Tahaps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LowonganTahap', 'url'=>array('index')),
	array('label'=>'Create LowonganTahap', 'url'=>array('create')),
	array('label'=>'View LowonganTahap', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LowonganTahap', 'url'=>array('admin')),
);
?>

<h1>Update LowonganTahap <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>