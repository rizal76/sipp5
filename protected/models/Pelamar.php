<?php

/**
 * This is the model class for table "pelamar".
 *
 * The followings are the available columns in table 'pelamar':
 * @property integer $id
 * @property string $no_ktp
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $umur
 * @property string $jenis_kelamin
 * @property string $status
 * @property integer $jumlah_anak
 * @property string $alamat
 * @property string $kota
 * @property string $tlp
 * @property string $pendidikan
 * @property string $jenjang
 * @property string $jurusan
 * @property string $tahun_lulus
 * @property string $skill
 * @property string $gaji
 * @property string $cv
 */
class Pelamar extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pelamar';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('no_ktp, nama, tempat_lahir, umur, jenis_kelamin, status, jumlah_anak, alamat, kota, tlp, pendidikan, tahun_lulus, skill, gaji, cv', 'required'),
           
            array('no_ktp', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('no_ktp', 'length', 'max' => 16, 'min' => 16, 'tooLong'=>'This NO_KTP should be 16 characters', 'tooShort'=>'This NO_KTP should be 16 characters'),
            array('no_ktp', 'unique', 'message' => 'This NO_KTP already exists.'),
            
            array('tlp, gaji,  jumlah_anak, umur', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('tempat_lahir, jenis_kelamin, status, kota, tlp, jurusan', 'length', 'max' => 200),
            
            array('nama, gaji', 'length', 'max' => 300),
            array('alamat', 'length', 'max' => 999),
            array('pendidikan, jenjang', 'length', 'max' => 100),
            array('tahun_lulus', 'length', 'max' => 4),
            array('skill', 'length', 'max' => 400),
            array('cv', 'file', 'types' => 'pdf'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, no_ktp, nama, tempat_lahir, umur, jenis_kelamin, status, jumlah_anak, alamat, kota, tlp, pendidikan, jenjang, jurusan, tahun_lulus, skill, gaji, cv', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pengalaman' => array(self::HAS_MANY, 'PengalamanKerja', 'id'),
            'lamaran' => array(self::HAS_MANY, 'Lamaran', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'no_ktp' => 'No Ktp',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'umur' => 'Umur',
            'jenis_kelamin' => 'Jenis Kelamin',
            'status' => 'Status',
            'jumlah_anak' => 'Jumlah Anak',
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'tlp' => 'Tlp',
            'pendidikan' => 'Pendidikan',
            'jenjang' => 'Jenjang',
            'jurusan' => 'Jurusan',
            'tahun_lulus' => 'Tahun Lulus',
            'skill' => 'Skill',
            'gaji' => 'Gaji',
            'cv' => 'Cv',
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
        $criteria->compare('no_ktp', $this->no_ktp, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('tempat_lahir', $this->tempat_lahir, true);
        $criteria->compare('umur', $this->umur, true);
        $criteria->compare('jenis_kelamin', $this->jenis_kelamin, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('jumlah_anak', $this->jumlah_anak);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('kota', $this->kota, true);
        $criteria->compare('tlp', $this->tlp, true);
        $criteria->compare('pendidikan', $this->pendidikan, true);
        $criteria->compare('jenjang', $this->jenjang, true);
        $criteria->compare('jurusan', $this->jurusan, true);
        $criteria->compare('tahun_lulus', $this->tahun_lulus, true);
        $criteria->compare('skill', $this->skill, true);
        $criteria->compare('gaji', $this->gaji, true);
        $criteria->compare('cv', $this->cv, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'nama ASC',
                'multiSort' => true,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pelamar the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
