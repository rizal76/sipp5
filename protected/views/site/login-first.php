<?php
//load jquery yg ga otomatis
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
if(Yii::app()->user->isGuest) {
?>
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert ' . $key . '">' . $message . "</div>\n";
    }
?>
<h3>Silahkan Login terlebih dahulu. </h3>
<?php } else  {?>
<h3>Selamat ! anda sudah login.</h3>
<?php  } ?>
