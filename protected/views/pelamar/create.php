<?php
/* @var $this PelamarController */
/* @var $model Pelamar */

$this->breadcrumbs=array(
	'Pelamars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pelamar', 'url'=>array('index')),
	array('label'=>'Manage Pelamar', 'url'=>array('admin')),
);
?>

<h1>Isi Data Diri</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'pengalamans'=>$pengalamans)); ?>