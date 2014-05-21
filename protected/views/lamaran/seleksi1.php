
<h1>Seleksi Administrasi</h1>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'lowongan-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<table  class="table table-bordered"> 
    <thead> 
        <tr> 
            <th><?php echo $sort->link('pelamarNama')?></th> 
            <th><?php echo $sort->link('pelamarSex')?></th> 
            <th><?php echo $sort->link('pelamarEdu')?></th> 
            <th><?php echo $sort->link('pelamarUmur')?></th> 
            <th><?php echo $sort->link('pelamarStatus')?></th> 
            <th><?php echo $sort->link('pelamarKota')?></th> 
            <th><a href="">CV</a></th>
            <th><?php echo $sort->link('pelamarGaji')?></th>
            <th><?php echo $sort->link('lowonganNama')?></th>
            <th>Lolos Administrasi</th>
        </tr> 
    </thead> 
    <tbody> 
        <?php
        foreach ($modelsL as $key => $value) {

            echo "<tr><td>" . $value->pelamar->nama . "</td>";
            echo "<td>" . $value->pelamar->jenis_kelamin . "</td>";
            echo "<td>" . $value->pelamar->pendidikan . "</td>";
            echo "<td>" . $value->pelamar->umur . "</td>";
            echo "<td>" . $value->pelamar->status . "</td>";
            echo "<td>" . $value->pelamar->kota . "</td>";
            echo "<td><a href=" . Yii::app()->request->baseUrl . "/cv/" . $value->pelamar->cv . ">Download</a></td>";
            echo "<td>" . $value->pelamar->gaji . "</td>";
            echo "<td>" . $value->lowongan->nama . "</td>";
            $id_lt = $value->lowongan->lowongantahaps[0]->id;
            echo "<td>" . $form->checkBox($modelsL[$key], '[' . $key . ']id_lowongan_tahap', array('value' => $id_lt)) . "</td></tr>";
        }
        ?>
        <tr> 
        </tr> 

    </tbody> 
</table> 
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
))
?><br>
<?php echo CHtml::submitButton('Simpan', array('class' => 'btn btn-primary btn-sm')); ?>


<?php $this->endWidget(); ?>

