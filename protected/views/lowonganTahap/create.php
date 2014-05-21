<?php
/* @var $this LowonganTahapController */
/* @var $model LowonganTahap */

$this->breadcrumbs=array(
	'Lowongan Tahaps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LowonganTahap', 'url'=>array('index')),
	array('label'=>'Manage LowonganTahap', 'url'=>array('admin')),
);
?>

<h1>Create LowonganTahap</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>