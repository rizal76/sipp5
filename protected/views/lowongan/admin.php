
<h1>Manage Lowongans</h1>

<div id="statusMsg"></div>
<?php echo CHtml::link('Create Lowongan', array('lowongan/create'), array('class' => 'btn btn-primary btn-sm')); ?>
<hr>
<?php
$arr_dept = array(
    'SIS' => 'SIS',
    'COM' => 'COM',
    'PMO' => 'PMO',
    'PRD' => 'PRD',
    'IMP' => 'IMP',
    'KOU' => 'KOU');
//kalo dia admin maka hanya dept nya aja
if(Yii::app()->user->isAdmin()) {
                    //cari departemen
                    $id = Yii::app()->user->id;
                     $modelAdm = Admin::model()->findByAttributes(array('id_user' =>$id)); 
                     $str = $modelAdm->departemen;
                 $arr_dept = array($str=>$str);
}


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'lowongan-grid',
    'itemsCssClass' => 'table table-bordered',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        
        'nama',
//		'deskripsi',
//		'persyaratan',
        array('name' => 'departemen',
            'value' => '(isset($data->departemen)) ? CHtml::encode($data->departemen) :""',
            'filter' => $arr_dept,
        ),
        array(
            'class' => 'CButtonColumn',
            'afterDelete' => 'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
        ),
    ),
));
?>
