<?php
/* @var $this LamaranController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lamarans',
);

$this->menu=array(
	array('label'=>'Create Lamaran', 'url'=>array('create')),
	array('label'=>'Manage Lamaran', 'url'=>array('admin')),
);
?>

<h1>Lamarans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
