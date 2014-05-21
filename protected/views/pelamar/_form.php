<?php
/* @var $this PelamarController */
/* @var $model Pelamar */
/* @var $form CActiveForm */
//load jquery
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.js');
?>

<div class="form">

    <?php
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-info flash-' . $key . '">' . $message . "</div>\n";
    }
    ?>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pelamar-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'span12',
            'enctype' => 'multipart/form-data',
        )
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
   <p class="error-msg"><?php echo $form->errorSummary($model , null , null, array('class'=>'alert alert-danger')); ?></p>
			
    <?php
    if ($pengalamans != null)
        echo $form->errorSummary($pengalamans , null , null, array('class'=>'alert alert-danger'));
    ?>
    <table class="table-condensed">
        <tbody>
            <tr>
                <th><?php echo $form->labelEx($model, 'no_ktp'); ?></th>
                <td><?php echo $form->textField($model, 'no_ktp', array('size' => 70, 'maxlength' => 20, 'class' => 'textinput')); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'nama'); ?></th>
                <td><?php echo $form->textField($model, 'nama', array('size' => 70, 'maxlength' => 30)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'tempat_lahir'); ?></th>
                <td><?php echo $form->textField($model, 'tempat_lahir', array('size' => 30, 'maxlength' => 20)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'umur'); ?></th>
                <td><?php echo $form->textField($model, 'umur'); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'jenis_kelamin'); ?></th>
                <td><?php
                    echo $form->dropDownList($model, 'jenis_kelamin', array(
                        'M' => 'M',
                        'F' => 'F'));
                    ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'status'); ?></th>
                <td><?php
                    echo $form->dropDownList($model, 'status', array(
                        'Belum_Menikah' => 'Belum_Menikah',
                        'Menikah' => 'Menikah',
                        'Duda' => 'Duda',
                        'Janda' => 'Janda',
                    ));
                    ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'jumlah_anak'); ?></th>
                <td><?php echo $form->textField($model, 'jumlah_anak'); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'alamat'); ?></th>
                <td><?php echo $form->textArea($model, 'alamat', array('size' => 70, 'maxlength' => 999)); ?>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'kota'); ?></th>
                <td><?php echo $form->textField($model, 'kota', array('size' => 70, 'maxlength' => 20)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'No Telepon / HP *'); ?></th>
                <td><?php echo $form->textField($model, 'tlp', array('size' => 70, 'maxlength' => 20)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'Nama Institusi Pendidikan*'); ?></th>
                <td><?php echo $form->textField($model, 'pendidikan', array('size' => 70, 'maxlength' => 100)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'jenjang'); ?></th>
                <td><?php echo $form->textField($model, 'jenjang', array('size' => 10, 'maxlength' => 10)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'jurusan'); ?></th>
                <td><?php echo $form->textField($model, 'jurusan', array('size' => 70, 'maxlength' => 20)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'tahun_lulus'); ?></th>
                <td><?php echo $form->textField($model, 'tahun_lulus', array('size' => 4, 'maxlength' => 4)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'skill'); ?></th>
                <td><?php echo $form->textArea($model, 'skill', array('size' => 70, 'maxlength' => 100)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'Gaji*'); ?></th>
                <td><?php echo $form->textField($model, 'gaji', array('size' => 100, 'maxlength' => 30)); ?></td>
            </tr>
            <tr>
                <th><?php echo $form->labelEx($model, 'File CV*'); ?></th>
                <td><?php echo $form->fileField($model, 'cv', array('size' => 70, 'maxlength' => 30)); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model, 'Pengalaman_Kerja'); ?></td>
            </tr>
        </tbody>
    </table>
    <!-- //untuk pengalaman kerja array -->
    <div id="pengalaman">
        <table class="table-condensed">
            <tbody>
                <?php
                if (Yii::app()->controller->action->id != 'create') {
                    foreach ($pengalamans as $i => $item):
                        ?>
                        <tr><th>Nama Perusahaan</th><td><?php echo CHtml::activeTextField($item, "[$i]nama_perusahaan"); ?></td></tr>
                        <tr><th>Gaji Terakhir</th><td> <?php echo CHtml::activeTextField($item, "[$i]gaji_terkahir"); ?></td></tr>
                        <tr><th>Tanggal Mulai</th><td> <?php echo CHtml::activeDateField($item, "[$i]tanggal_mulai"); ?>  Misal: 2014-04-01</td></tr>
                        <tr><th>Tanggal Akhir</th><td> <?php echo CHtml::activeDateField($item, "[$i]tanggal_akhir"); ?>  Misal: 2014-12-31</td></tr>
                        <tr><th>Posisi</th><td> <?php echo CHtml::activeTextField($item, "[$i]posisi"); ?></td></tr>
                        <tr><th>Jenis</th><td> <?php echo CHtml::activeTextField($item, "[$i]jenis"); ?></td></tr>
                        <tr><th>Alasan Berhenti</th><td> <?php echo CHtml::activeTextArea($item, "[$i]alasan_berhenti"); ?></td></tr>
                    <?php endforeach;
                }
                ?>
            </tbody>
        </table>	
    </div>
    <div id="add-pengalaman" onclick="tambah()" style="color:#428bca; cursor:pointer">(+) Tambah Pengalaman Kerja</div><br>
<?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', array('class' => 'btn btn-primary btn-sm')); ?>
<?php $this->endWidget(); ?>
</div><!-- form sip -->
<!-- untuk tambah pengalaman -->
<script type="text/javascript">
    var jumlah = <?php echo count($pengalamans); ?>;
    function tambah() {
        var isi = '<table class="table-condensed"><tbody><tr><td></td></tr><tr><th>Nama Perusahaan</th><td><input name="PengalamanKerja[' + jumlah + '][nama_perusahaan]" id="PengalamanKerja_' + jumlah + '_nama_perusahaan" type="text"></td></tr><tr><th>Gaji Terakhir</th><td><input name="PengalamanKerja[' + jumlah + '][gaji_terkahir]" id="PengalamanKerja_' + jumlah + '_gaji_terkahir" type="text" maxlength="30" /></td></tr><tr><th>Tanggal Mulai</th><td> <input name="PengalamanKerja[' + jumlah + '][tanggal_mulai]" id="PengalamanKerja_' + jumlah + '_tanggal_mulai" type="date" />   Misal: 2014-12-31 </td></tr><tr><th>Tanggal Akhir</th><td> <input name="PengalamanKerja[' + jumlah + '][tanggal_akhir]" id="PengalamanKerja_' + jumlah + '_tanggal_akhir" type="date" />  Misal: 2015-10-31</td></tr> <tr><th>Posisi</th><td> <input name="PengalamanKerja[' + jumlah + '][posisi]" id="PengalamanKerja_' + jumlah + '_posisi" type="text" maxlength="20" /></td></tr> <tr><th>Jenis</th><td> <input name="PengalamanKerja[' + jumlah + '][jenis]" id="PengalamanKerja_' + jumlah + '_jenis" type="text" maxlength="20" /> </td></tr> <tr><th>Alasan Berhenti</th><td> <textarea name="PengalamanKerja[' + jumlah + '][alasan_berhenti]" id="PengalamanKerja_' + jumlah + '_alasan_berhenti"></textarea></td></tr></tbody></table>';
        $("#pengalaman").append(isi);
        jumlah++;       // Append new elements
    }
</script>