<?php
/* @var $this LowonganTahapController */
/* @var $model LowonganTahap */

$this->breadcrumbs=array(
	'Lowongan Tahaps'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List LowonganTahap', 'url'=>array('index')),
	array('label'=>'Create LowonganTahap', 'url'=>array('create')),
	array('label'=>'Update LowonganTahap', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete LowonganTahap', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LowonganTahap', 'url'=>array('admin')),
);
?>

<h1>View LowonganTahap #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_lowongan',
		'id_tahap',
		'deskripsi',
		'file_tugas',
		'id',
	),
)); ?>
