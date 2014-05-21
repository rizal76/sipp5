<?php
/* @var $this PelamarController */
/* @var $model Pelamar */

$this->breadcrumbs=array(
	'Pelamars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pelamar', 'url'=>array('index')),
	array('label'=>'Create Pelamar', 'url'=>array('create')),
	array('label'=>'View Pelamar', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pelamar', 'url'=>array('admin')),
);
?>

<h1>Edit Data Diri  <?php echo $model->nama; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,  'pengalamans'=>$pengalamans)); ?>