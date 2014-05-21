<?php

/**
 * This is the model class for table "pengalaman_kerja".
 *
 * The followings are the available columns in table 'pengalaman_kerja':
 * @property integer $id
 * @property integer $id_pelamar
 * @property integer $nama_perusahaan
 * @property string $gaji_terkahir
 * @property string $tanggal_mulai
 * @property string $tanggal_akhir
 * @property string $posisi
 * @property string $jenis
 * @property string $alasan_berhenti
 */
class PengalamanKerja extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pengalaman_kerja';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_pelamar, nama_perusahaan, gaji_terkahir, tanggal_mulai, tanggal_akhir, posisi, jenis, alasan_berhenti', 'required'),
            array('id_pelamar, gaji_terkahir', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('gaji_terkahir', 'length', 'max' => 30),
            array('posisi, nama_perusahaan, jenis, alasan_berhenti', 'length', 'max' => 400),
            array('tanggal_mulai, tanggal_akhir', 'type', 'type' => 'date', 'message' => '{attribute}: is not a date!', 'dateFormat' => 'yyyy-MM-dd'),
            array('tanggal_akhir','compare','compareAttribute'=>'tanggal_mulai','operator'=>'>','message'=>'Tanggal Mulai must be less than Tanggal Akhir'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_pelamar, nama_perusahaan, gaji_terkahir, tanggal_mulai, tanggal_akhir, posisi, jenis, alasan_berhenti', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pelamar' => array(self::BELONGS_TO, 'Pelamar', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'id_pelamar' => 'Id Pelamar',
            'nama_perusahaan' => 'Nama Perusahaan',
            'gaji_terkahir' => 'Gaji Terkahir',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_akhir' => 'Tanggal Akhir',
            'posisi' => 'Posisi',
            'jenis' => 'Jenis',
            'alasan_berhenti' => 'Alasan Berhenti',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('id_pelamar', $this->id_pelamar);
        $criteria->compare('nama_perusahaan', $this->nama_perusahaan);
        $criteria->compare('gaji_terkahir', $this->gaji_terkahir, true);
        $criteria->compare('tanggal_mulai', $this->tanggal_mulai, true);
        $criteria->compare('tanggal_akhir', $this->tanggal_akhir, true);
        $criteria->compare('posisi', $this->posisi, true);
        $criteria->compare('jenis', $this->jenis, true);
        $criteria->compare('alasan_berhenti', $this->alasan_berhenti, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PengalamanKerja the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
