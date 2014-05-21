<?php
/* @var $this LamaranController */
/* @var $model Lamaran */

$this->breadcrumbs=array(
	'Lamarans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Lamaran', 'url'=>array('index')),
	array('label'=>'Create Lamaran', 'url'=>array('create')),
	array('label'=>'Update Lamaran', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lamaran', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lamaran', 'url'=>array('admin')),
);
?>

<h1>View Lamaran #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_pelamar',
		'id_lowongan',
		'id_tahap',
		'hasil_tugas',
		'id',
	),
)); ?>
