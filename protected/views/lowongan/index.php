<?php
/* @var $this LowonganController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lowongans',
);

$this->menu=array(
	array('label'=>'Create Lowongan', 'url'=>array('create')),
	array('label'=>'Manage Lowongan', 'url'=>array('admin')),
);
?>

<h1>Lowongans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
