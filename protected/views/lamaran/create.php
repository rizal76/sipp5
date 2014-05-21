<?php
/* @var $this LamaranController */
/* @var $model Lamaran */

$this->breadcrumbs=array(
	'Lamarans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lamaran', 'url'=>array('index')),
	array('label'=>'Manage Lamaran', 'url'=>array('admin')),
);
?>

<h1>Create Lamaran</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>