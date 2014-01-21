<?php

Yii::import('pietra.helpers.HomeUrlNormalized');

/**
 * This is the model class for table "url".
 *
 * The followings are the available columns in table 'url':
 * @property string $url_id
 * @property string $url
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Category[] $categories
 * @property Media[] $medias
 * @property Page[] $pages
 */
class Url extends CActiveRecord
{
    const TYPE_PAGE = 'page';
    const TYPE_CATEGORY = 'category';
    const TYPE_MEDIA = 'media';

    private $validTypes = array(
        self::TYPE_PAGE,
        self::TYPE_CATEGORY,
        self::TYPE_MEDIA,
    );

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'url';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('url, type', 'required'),
			array('url', 'length', 'max'=>255),
            array('type', 'in', 'range'=> $this->validTypes, 'allowEmpty'=>false),
            array('url_id', 'required', 'on' => 'update'),
            array('url', 'unique', 'allowEmpty' => false),
			// The following rule is used by search().
			array('url_id, url, type', 'safe', 'on'=>'search'),
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
			'category' => array(self::HAS_ONE, 'Category', 'url_id'),
			'page' => array(self::HAS_ONE, 'Page', 'url_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'url_id' => 'Url Id',
			'url' => 'Url',
			'type' => 'Type',
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

		$criteria->compare('url_id',$this->url_id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Url the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getFullUrl()
    {
        return HomeUrlNormalized::get() . $this->url;
    }
}
