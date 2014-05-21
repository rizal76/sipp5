<?php
/* @var $this TahapController */
/* @var $model Tahap */

$this->breadcrumbs=array(
	'Tahaps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tahap', 'url'=>array('index')),
	array('label'=>'Manage Tahap', 'url'=>array('admin')),
);
?>

<h1>Create Tahap</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>