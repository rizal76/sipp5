<?php
/* @var $this TahapController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tahaps',
);

$this->menu=array(
	array('label'=>'Create Tahap', 'url'=>array('create')),
	array('label'=>'Manage Tahap', 'url'=>array('admin')),
);
?>

<h1>Tahaps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
