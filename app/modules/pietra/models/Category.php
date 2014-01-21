<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $category_id
 * @property string $url_id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Url $url
 * @property Page[] $pages
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('scope_id', 'default', 'value' => Scope::DEFAULT_SCOPE, 'on' => 'create'),
			array('url_id, title', 'required'),
			array('url_id', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			// The following rule is used by search().
			array('category_id, title', 'safe', 'on'=>'search'),
		);
	}

    public function scopes()
    {
        return array(
            'site' => array(
                'condition'=>'scope_id=' . Scope::DEFAULT_SCOPE,
            ),
            'blog' => array(
                'condition' => 'scope_id=' . Scope::BLOG_SCOPE,
                'order' => 'title ASC'
            )
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
			'url' => array(self::BELONGS_TO, 'Url', 'url_id'),
			'pages' => array(self::MANY_MANY, 'Page', 'page_category(category_id, page_id)'),
			'scope' => array(self::BELONGS_TO, 'Scope', 'scope_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'category_id' => 'Category Id',
			'url_id' => 'Url',
			'title' => 'Title',
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

		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('scope_id',$this->scope_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function beforeDelete()
    {
        $this->url->delete();

        return parent::beforeDelete();
    }
}
