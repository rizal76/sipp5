<?php
/* @var $this PelamarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pelamars',
);

$this->menu=array(
	array('label'=>'Create Pelamar', 'url'=>array('create')),
	array('label'=>'Manage Pelamar', 'url'=>array('admin')),
);
?>

<h1>Pelamars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
