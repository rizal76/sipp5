<?php
//load jquery yg ga otomatis
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');  
?>

<div style="text-align:center">
<h4>Selamat  <?php echo $model->username; ?> telah terdaftar.</h4>
Silahkan isi data diri untuk melamar pekerjaan yang anda minati.
</div>

