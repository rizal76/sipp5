<?php

/**
 * This is the model class for table "lowongan_tahap".
 *
 * The followings are the available columns in table 'lowongan_tahap':
 * @property integer $id_lowongan
 * @property integer $id_tahap
 * @property string $deskripsi
 * @property string $file_tugas
 */
class LowonganTahap extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'lowongan_tahap';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_lowongan, id_tahap, deskripsi', 'required'),
            array('id_lowongan, id_tahap', 'numerical', 'integerOnly' => true),
            array('deskripsi, file_tugas', 'length', 'max' => 500),
             array('file_tugas','file', 'allowEmpty' => true, 'types'=>'pdf'), 
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_lowongan, id_tahap, deskripsi, file_tugas', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tahaps' => array(self::BELONGS_TO, 'Tahap', 'id_tahap'),
            'lowongans' => array(self::BELONGS_TO, 'Lowongan', 'id_lowongan'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id_lowongan' => 'Id Lowongan',
            'id_tahap' => 'Id Tahap',
            'deskripsi' => 'Deskripsi',
            'file_tugas' => 'File Tugas',
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

        $criteria->compare('id_lowongan', $this->id_lowongan);
        $criteria->compare('id_tahap', $this->id_tahap);
        $criteria->compare('deskripsi', $this->deskripsi, true);
        $criteria->compare('file_tugas', $this->file_tugas, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LowonganTahap the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
