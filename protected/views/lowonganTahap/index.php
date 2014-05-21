<?php
/* @var $this LowonganTahapController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lowongan Tahaps',
);

$this->menu=array(
	array('label'=>'Create LowonganTahap', 'url'=>array('create')),
	array('label'=>'Manage LowonganTahap', 'url'=>array('admin')),
);
?>

<h1>Lowongan Tahaps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
