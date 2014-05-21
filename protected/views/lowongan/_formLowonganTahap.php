<?php
/* @var $this LowonganTahapController */
/* @var $model LowonganTahap */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'lowongan-tahap-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        )
            //'action'=>Yii::app()->createUrl('//LowonganTahap/create'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>


<?php 

$count = 0;
foreach ($tahaps as $i => $item): ?>
    <?php echo $form->errorSummary($item, null , null, array('class'=>'alert alert-danger')); ?>
            <?php echo $form->labelEx($item, $item->tahaps->nama); ?>
            
                   
        
            <?php echo $form->hiddenField($item, '[' . $count . ']id_tahap', array('value' => $item->id_tahap)); ?>
            <?php echo $form->error($item, '[' . $count . ']id_tahap'); ?>
      
            <?php echo $form->hiddenField($item, '[' . $count . ']id_lowongan', array('value' => $idLowongan)); ?>
            <?php echo $form->error($item, '[' . $count . ']id_lowongan'); ?>
   <table class="table-condensed">
                <tbody>
        <tr> 
    <th><?php echo $form->labelEx($item, 'deskripsi'); ?></th>
    <td><?php echo $form->textArea($item, '[' . $count . ']deskripsi', array('size' => 60, 'maxlength' => 500)); ?></td>
        </tr>
        <tr>
    <th><?php echo $form->labelEx($item, 'file_tugas'); ?></th>
    <td><?php echo $form->fileField($item, '[' . $count . ']file_tugas', array('size' => 60, 'maxlength' => 500)); ?></td>
      </tr>

</tbody>
</table>
<br>
    <?php $count++;
endforeach; ?>
<?php echo CHtml::submitButton('Simpan', array( 'class'=>'btn btn-primary btn-sm' )); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->