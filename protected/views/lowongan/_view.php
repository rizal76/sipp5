<?php
/* @var $this LowonganController */
/* @var $data Lowongan */
?>

<div class="info-lowongan">
	<ul>
		<li><b><?php echo CHtml::link(CHtml::encode($data->nama), array('view', 'id'=>$data->id)); ?></b></li>
	</ul>
</div>