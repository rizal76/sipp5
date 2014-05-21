

<h1>Daftar Pelamar</h1>
<div id="statusMsg"></div>
<?php
//
//$this->widget('application.extensions.tablesorter.Sorter', array(
//    'data'=>$model,
//    'columns'=>array(	
//        'nama',
//        'umur', 
//        'jenis_kelamin', 
//        'status',
//		'kota',
//		'tlp',
//		'pendidikan',
//		'skill',
//		'cv',// Relation value given in model
//    )
//));
$link = Yii::app()->baseUrl . '/cv/';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pelamar-grid',
    'itemsCssClass' => 'table table-bordered',

    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        
        'nama',
        'kota',
        'umur',
        //'jenis_kelamin',
        array(
            'name' => 'jenis_kelamin',
            'header' => 'Gender',
            'value' => '(isset($data->jenis_kelamin)) ? CHtml::encode($data->jenis_kelamin) :""',
            'filter' => array('M'=>'M','F'=>'F'),
        ),
        'gaji',
        'jenjang',
        'jurusan',
        array('name' => 'cv',
            'type' => 'raw',
            'value' => 'CHtml::link( "CV", "cv/".$data->cv)',
        ),
        /*
          'status',
          'jumlah_anak',
          'alamat',
          'kota',
          'tlp',
          'pendidikan',
          'jenjang',
          'jurusan',
          'tahun_lulus',
          'skill',
          'gaji',
          'cv',
         */
        array(
            'class' => 'CButtonColumn',
            'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
    ),
));
?>
