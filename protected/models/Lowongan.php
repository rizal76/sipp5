<?php

/**
 * This is the model class for table "lowongan".
 *
 * The followings are the available columns in table 'lowongan':
 * @property integer $id
 * @property string $nama
 * @property string $deskripsi
 * @property string $persyaratan
 * @property string $departemen
 */
class Lowongan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lowongan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, deskripsi, persyaratan, departemen', 'required'),
			array('nama, new', 'length', 'max'=>130),
			array('deskripsi', 'length', 'max'=>74000),
			array('persyaratan', 'length', 'max'=>71000),
                         array('departemen', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, deskripsi, persyaratan, new, departemen', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                     'lowongantahaps'   => array(self::HAS_MANY,   'LowonganTahap',    'id_lowongan'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama',
			'deskripsi' => 'Deskripsi',
			'persyaratan' => 'Persyaratan',
			'new' => 'New',
                        'departemen' => 'Departemen',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
               
		$criteria->compare('id',$this->id);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('persyaratan',$this->persyaratan,true);
		$criteria->compare('new',$this->new,true);
                 //cek jika dia admin maka cari departemen dan filter departemen
            
                if(Yii::app()->user->isAdmin()) {
                    //cari departemen
                    $id = Yii::app()->user->id;
                     $model = Admin::model()->findByAttributes(array('id_user' =>$id));                    
                     $criteria->compare('departemen',$model->departemen,true);
                     
                } else {
                    $criteria->compare('departemen',$this->departemen,true);
                }
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lowongan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
