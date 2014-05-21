<h1>Pengumuman</h1>
<hr>
<?php
//tampilin notifikasi yang ada
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert ' . $key . '">' . $message . "</div>\n";
}
?>

<?php
if (count($model) == 0) {
    echo "Tidak ada pengumuman";
}
foreach ($model as $j => $modelp) {
    echo 'Nama Lowongan: ' . $modelp->lowongan->nama . '<br>';
    if (!isset($modelp->proses->deskripsi)) {
        echo 'Sedang seleksi administrasi<br>';
    } else {

        //cek kalo ada yang submit tugas
        echo 'Sampai tahap: ' . $modelp->proses->tahaps->nama . '<br>';
        echo 'Deskripsi  ' . $modelp->proses->deskripsi . '<br>';
        if($modelp->proses->file_tugas!=null) {
        echo 'File Keterangan : ';
        echo '<a href=' . Yii::app()->baseUrl . '/file_tugas/' . $modelp->proses->file_tugas . '>Download</a><br>';
        }
        ?>

        <!-- kalo ini merupakan tahap 1 atau 2 -->
        <?php if ($modelp->proses->tahaps->id == 1) { ?>
            
                <div class="form">

                    <?php
                    if ($modelp->hasil_tugas != null)
                        echo '<a href=' . Yii::app()->baseUrl . '/hasil_tugas/' . $modelp->hasil_tugas . '>Download pengerjaan tugas</a><br>';
                  
                    
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'tahap-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <p class="note">Isi hasil tugas anda </p>
                    <?php echo $form->errorSummary($modelp); ?>
                    <?php echo $form->hiddenField($modelp, 'id', array('value' => $modelp->id)); ?>

                    <?php echo $form->labelEx($modelp, 'hasil_tugas'); ?>
                    <?php echo $form->fileField($modelp, 'hasil_tugas', array('size' => 30, 'maxlength' => 30)); ?>
                    <?php echo $form->error($modelp, 'hasil_tugas'); ?>

                    <br>
                    <?php echo CHtml::submitButton($modelp->isNewRecord ? 'Create' : 'Simpan', array('class' => 'btn btn-primary btn-sm')); ?>

                    <?php $this->endWidget(); ?>

                </div><!-- form -->
                <?php
            
        }//akhir tugas 1
        //kalo dia udah sampai tugas 2 / tahap 2
        elseif (($modelp->proses->tahaps->id == 2)) {
            ?>
            <?php if ($modelp->hasil_tugas2 != null)
                        echo '<a href=' . Yii::app()->baseUrl . '/hasil_tugas/' . $modelp->hasil_tugas2 . '>Download pengerjaan tugas</a><br>';
                  
                ?>
                <div class="form">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'tahap-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <p class="note">Isi hasil tugas anda </p>
                    <?php echo $form->errorSummary($modelp); ?>
                    <?php echo $form->hiddenField($modelp, 'id', array('value' => $modelp->id)); ?>
                    
                        <?php echo $form->labelEx($modelp, 'hasil_tugas2'); ?>
                        <?php echo $form->fileField($modelp, 'hasil_tugas2', array('size' => 30, 'maxlength' => 30)); ?>
                        <?php echo $form->error($modelp, 'hasil_tugas2'); ?>

                    
                    <br>
                    
                        <?php echo CHtml::submitButton($modelp->isNewRecord ? 'Create' : 'Simpan', array('class' => 'btn btn-primary btn-sm')); ?>
                    
                    <?php $this->endWidget(); ?>

                </div><!-- form -->
                <?php
            
        }
    }
    echo "<hr>";
}
?>