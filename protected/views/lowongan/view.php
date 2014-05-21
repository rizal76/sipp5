

<h1>Lowongan <?php echo $model->nama; ?></h1>
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-info flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'nama',
        array(
            'name' => 'deskripsi',
            'value' => nl2br($model->deskripsi),
            'type'=>'raw',
        ),
        
        array(
            'name' => 'persyaratan',
            'value' => nl2br($model->persyaratan),
            'type'=>'raw',
        ),
    ),
));
?>
<br>
<?php
//yg boleh lamar hanya pelamar
if (Yii::app()->user->isMember()) {
    //kalo belum lamar
    $cekPelamar = Lamaran::model()->findByAttributes(
            array('id_pelamar' => Yii::app()->user->id, 'id_lowongan' => $model->id)
    );
    if ($cekPelamar == null)
        echo CHtml::link('Apply Lowongan', array('lowongan/apply', 'id' => $model->id), array('class' => 'btn btn-primary btn-sm'));

    //kalo udah lamar
    else
        echo "<div class='alert alert-info'>Anda sudah apply lowongan ini</div>";
}
if (Yii::app()->user->isGuest) {
    echo CHtml::link('Apply Lowongan', array('lowongan/apply', 'id' => $model->id), array('class' => 'btn btn-primary btn-sm'));
}
?>
