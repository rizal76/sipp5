<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo Yii::app()->name; ?></title>
       
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">

        <?php
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/bootstrap.css'); 
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap.js');
        ?> 

        <script>
    //untuk login        
    function pop() {
                $('.pop').popover();
            }
            $(document).ready(function() {
                $('.pop').popover({
                    html: true,
                    content: function() {
                        return $('.log').html();
                    }
                });
                if ($(".login-salah")[0]) {
                   $('.pop').popover('show')

                }
            });
        </script>

    </head>
    <body onload="pop()">
        <div class="frame">
            <div class="header">
                <div class="head">
                    <div class="navigasi">
                        <ul>
                            <div class="left-nav">
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>"><img src="images/logo.png" ></a></li>
                            </div>
                            <div class="right-nav">


                                <li><?php echo CHtml::link('Kenapa TRASPAC', array('/site/page', 'view' => 'kenapa')); ?></li>
                                <li class="active"><a href=<?php echo Yii::app()->request->baseUrl; ?>>Info Lowongan</a></li>
                                <?php
                                if (Yii::app()->user->isGuest) {
                                    echo "<a type='button' class='pop' data-container='body' data-toggle='popover' data-placement='bottom' data-content='' data-html='true'>
  								Login
							</a>";
                                    ?>
                                    <li><?php echo CHtml::link('Register', array('user/create')); ?></li>

    <?php
}
/////////////////MENU UNTUK MASING MASING ROLE ////////////
if (!Yii::app()->user->isGuest) {
    // MENU FOR SUPER ADMIN ////
    if (Yii::app()->user->isSuperAdmin()) {
        echo "<li>";
        echo CHtml::link('Manage Admin', array('/user/admin'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Lowongan', array('/lowongan/admin'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Pelamar', array('/pelamar/admin'));
        echo "<ul class='dropdown'>";
        echo "<li>";
        echo CHtml::link('Daftar Pelamar', array('/pelamar/admin'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Seleksi Administrasi', array('lamaran/seleksiDokumen'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Seleksi Lanjut', array('lamaran/seleksiLanjut'));
        echo "</li>";
        echo "</ul>";
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Logout', array('/site/logout'));
        echo "</li>";
    }
    // MENU FOR ADMIN ////
    else if (Yii::app()->user->isAdmin()) {
        echo "<li>";
        echo CHtml::link('Lowongan', array('/lowongan/admin'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Pelamar', array('/pelamar/admin'));
        echo "<ul class='dropdown'>";
        echo "<li>";
        echo CHtml::link('Daftar Pelamar', array('/pelamar/admin'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Seleksi Administrasi', array('lamaran/seleksiDokumen'));
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Seleksi Lanjut', array('lamaran/seleksiLanjut'));
        echo "</li>";
        echo "</ul>";
        echo "</li>";
        echo "<li>";
        echo CHtml::link('Logout', array('/site/logout'));
        echo "</li>";
    } else {
        // MENU FOR MEMBER////
        //cek kalo user belum buat data diri maka create
        $id = Pelamar::model()->findByPk(Yii::app()->user->id);
        if ($id == null) {
            echo "<li>";
            echo CHtml::link('Data Diri', array('/pelamar/create'));
            echo "</li>";
        } else {
            echo "<li>";
            echo CHtml::link('Data Diri', array('/pelamar/view', 'id' => Yii::app()->user->id));
            echo "</li>";
        }
        echo "<li>";
        echo CHtml::link('Pengumuman', array('/lamaran/pengumuman'));
        echo "</li>";
        echo "<li class=\"logout\">";
        echo CHtml::link('Logout', array('/site/logout'));
        echo "</li>";
    }
}
?>
                            </div>
                        </ul>	
                    </div>
                </div>
                <div class="log" style="display:none">

<?php
$this->widget('application.extensions.login.XLoginPortlet', array(
    'visible' => Yii::app()->user->isGuest,
));
?>
                </div>

            </div>
            <div class="content">
                <div class="frame-content">
<?php echo $content;
?>
                </div>
            </div>
            <div class="footer">
                <div class="frame-footer">
                    Sistem Informasi Perekrutan Pegawai PT. TRASPAC <br>
                    &copy; 2014 - Propensi B02 Fasilkom UI
                </div>
            </div>
        </div>
    </body>
</html>