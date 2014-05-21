<?php

/**
 * This is the model class for table "lamaran".
 *
 * The followings are the available columns in table 'lamaran':
 * @property integer $id_pelamar
 * @property integer $id_lowongan
 * @property integer $id_tahap
 * @property string $hasil_tugas
 *  @property string $hasil_tugas2
 * @property integer $id_lowongan_tahap
 * @property integer $id
 */
class Lamaran extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'lamaran';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_pelamar, id_lowongan', 'required'),
            array('id_pelamar, id_lowongan, id_lowongan_tahap', 'numerical', 'integerOnly' => true),
            //array('hasil_tugas', 'length', 'max'=>20),
            array('hasil_tugas2', 'file', 'types' => 'pdf', 'on'=>'tugas2'),
             array('hasil_tugas', 'file', 'types' => 'pdf', 'on'=>'tugas'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_pelamar, id_lowongan, hasil_tugas, hasil_tugas2 ,id_lowongan_tahap, id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'lowongan' => array(self::BELONGS_TO, 'Lowongan', 'id_lowongan'),
            'proses' => array(self::BELONGS_TO, 'LowonganTahap', 'id_lowongan_tahap'),
            'pelamar' => array(self::BELONGS_TO, 'Pelamar', 'id_pelamar'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_pelamar' => 'Id Pelamar',
            'id_lowongan' => 'Id Lowongan',
            'hasil_tugas' => 'Hasil Tugas',
            'hasil_tugas2' => 'Hasil Tugas2',
            'id' => 'ID',
            'id_lowongan_tahap' => 'Id Lowongan tahap',
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

        $criteria->compare('id_pelamar', $this->id_pelamar);
        $criteria->compare('id_lowongan', $this->id_lowongan);
        $criteria->compare('id_lowongan_tahap', $this->id_lowongan_tahap);
        $criteria->compare('hasil_tugas', $this->hasil_tugas, true);
        $criteria->compare('hasil_tugas2', $this->hasil_tugas2, true);

        $criteria->compare('id', $this->id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Lamaran the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
