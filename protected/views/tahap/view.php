<?php
/* @var $this TahapController */
/* @var $model Tahap */

$this->breadcrumbs=array(
	'Tahaps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tahap', 'url'=>array('index')),
	array('label'=>'Create Tahap', 'url'=>array('create')),
	array('label'=>'Update Tahap', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tahap', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tahap', 'url'=>array('admin')),
);
?>

<h1>View Tahap #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama',
	),
)); ?>
