
<h1>Data Diri Pelamar <?php echo $model->nama; ?></h1>
<?php
foreach(Yii::app()->user->getFlashes() as $key => $message) {
echo '<div class="alert alert-info flash-' . $key . '">' . $message . "</div>\n";
}
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'no_ktp',
		'nama',
		'tempat_lahir',
		'umur',
		'jenis_kelamin',
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
		array(               // cv
            'label'=>'CV',
            'type'=>'raw',
            'value'=>CHtml::link('Download CV', Yii::app()->baseUrl.'/cv/'.$model->cv ),
        ),
	),
)); 
?>

<?php
if (count($pengalamans)!=0){
    echo 'Pengalaman Kerja <br>';
}
foreach ($pengalamans as $j=>$item) {
	$this->widget('zii.widgets.grid.CDetailView', array(
		'data'=>$pengalamans[$j],
		'attributes'=>array(
			'nama_perusahaan',
			'gaji_terkahir',
			'tanggal_mulai',
			'tanggal_akhir',
			'posisi',
			'jenis',
			'alasan_berhenti',
		)));
}
//nampilin edit
echo CHtml::link('Edit Data Diri', array('pelamar/update', 'id'=>$model->id) );

?>



