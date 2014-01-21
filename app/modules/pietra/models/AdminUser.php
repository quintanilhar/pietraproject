<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $admin_user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property integer $is_active
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Page[] $pages
 */
class AdminUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('created_date', 'default', 'value' => date('Y-m-d H:i:s'), 'on' => 'create'),
			array('first_name, last_name, email', 'required'),
            array('password, created_date', 'required', 'on' => 'create'),
            array('is_active', 'required', 'on' => 'update'),
			array('is_active', 'boolean'),
			array('first_name, last_name', 'length', 'max'=>50),
			array('email', 'email'),
			array('email', 'length', 'max' => 145),
            array('email', 'unique', 'allowEmpty' => false),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('admin_user_id, first_name, last_name, email, is_active', 'safe', 'on'=>'search'),
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
			'pages' => array(self::HAS_MANY, 'Page', 'admin_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'admin_user_id'     => Yii::t('admin', 'User Id'),
			'first_name'        => Yii::t('admin', 'First Name'),
			'last_name'         => Yii::t('admin', 'Last Name'),
			'email'             => Yii::t('admin', 'Email'),
			'password'          => Yii::t('admin', 'Password'),
			'password_confirm'  => Yii::t('admin', 'Confirm password'),
			'is_active'         => Yii::t('admin', 'Is Active'),
			'created_date'      => Yii::t('admin', 'Created Date'),
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

		$criteria->compare('admin_user_id',$this->admin_user_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeSave()
    {
        if (isset($this->password) && !empty($this->password)) {
            $this->password = crypt($this->password);
        } else {
            unset($this->password);
        }

        return parent::beforeSave();
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
