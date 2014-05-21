<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $level_id
 */
class User extends CActiveRecord {

    public $verifyCode;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, level_id', 'required'),
            array('username', 'unique', 'message' => 'This username already exists.'),
            array('level_id', 'numerical', 'integerOnly' => true),
            array('verifyCode', 'captcha', 'allowEmpty' => !extension_loaded('gd'), 'on' => 'buat'),
            array('username, password', 'length', 'max' => 128, 'min' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, level_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'admin' => array(self::HAS_ONE, 'Admin', 'id_user')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'level_id' => 'Level',
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
    //nyari admin
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('level_id', 1);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function validatePassword($password) {
        return CPasswordHelper::verifyPassword($password, $this->password);
    }

    public function hashPassword($password) {
        return CPasswordHelper::hashPassword($password);
    }

    public function beforeSave() {
        $this->password = $this->hashPassword($this->password);
        return true;
    }


    public function sendMail($to, $message) {
        $info = "Please click here to reset your password " . Yii::app()->getBaseUrl(true) . "/index.php?r=user/forgot&code=" . $message;
        $from = "darkempty99@gmail.com";
        $subject = "Reset Your Password";
        $mail = Yii::app()->Smtpmail;
        $mail->SetFrom($from, 'Admin Traspac');
        $mail->Subject = $subject;
        $mail->MsgHTML($info);
        $mail->AddAddress($to, "");
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

}
