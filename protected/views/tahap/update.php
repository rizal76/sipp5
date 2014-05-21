<?php
/* @var $this TahapController */
/* @var $model Tahap */

$this->breadcrumbs=array(
	'Tahaps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tahap', 'url'=>array('index')),
	array('label'=>'Create Tahap', 'url'=>array('create')),
	array('label'=>'View Tahap', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tahap', 'url'=>array('admin')),
);
?>

<h1>Update Tahap <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>