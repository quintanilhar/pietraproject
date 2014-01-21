<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $page_id
 * @property string $admin_user_id
 * @property string $url_id
 * @property string $created_date
 * @property string $updated_date
 * @property string $title
 * @property string $small_description
 * @property string $description
 * @property integer $is_visible
 *
 * The followings are the available model relations:
 * @property Url $url
 * @property User $user
 * @property Category[] $categories
 */
class Page extends CActiveRecord
{
    protected $createdDateTime;

    private $_oldTags;

    public function behaviors(){
        return array(
            'CAdvancedArBehavior' => array(
                'class' => 'application.extensions.CAdvancedArBehavior')
            );
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('created_date, updated_date', 'default', 'value' => date('Y-m-d H:i:s'), 'on' => 'create'),
            array('scope_id', 'default', 'value' => Scope::DEFAULT_SCOPE, 'on' => 'create'),
            array('admin_user_id', 'default', 'value' => Yii::app()->user->admin_user_id, 'on' => 'create'),
			array('admin_user_id, url_id, created_date, updated_date, title, small_description, description', 'required'),
			array('is_visible', 'boolean'),
			array('admin_user_id, url_id', 'length', 'max'=>11),
			array('title', 'length', 'max'=>180),
			array('small_description', 'length', 'max'=>200),
            array('created_date, updated_date', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss', 'allowEmpty' => false),
            array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
            array('tags', 'normalizeTags'),
            array('categories, tags', 'safe'),
            // The following rule is used by search().
			array('page_id, admin_user_id, url_id, title, is_visible, tags', 'safe', 'on'=>'search'),
		);
	}

    public function scopes()
    {
        return array(
            'site' => array(
                'condition' => 'scope_id=' . Scope::DEFAULT_SCOPE,
                'order' => 'page_id DESC',
            ),
            'blog' => array(
                'condition' => 't.scope_id=' .Scope::BLOG_SCOPE,
                'order'=>'created_date DESC',
            ),
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
            'url' => array(
                self::BELONGS_TO,
                'Url',
                'url_id',
                'together' => true
            ),
            'user' => array(
                self::BELONGS_TO,
                'AdminUser',
                'admin_user_id'
            ),
            'categories' => array(
                self::MANY_MANY,
                'Category',
                'page_category(page_id, category_id)'
            ),
            'media' => array(
                self::MANY_MANY,
                'Media',
                'page_media(page_id, media_id)'
            ),
            'scope' => array(
                self::BELONGS_TO,
                'Scope',
                'scope_id'
            ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'page_id'           => Yii::t('admin', 'Page Id'),
			'admin_user_id'     => Yii::t('admin', 'User'),
			'url_id'            => Yii::t('admin', 'Url'),
			'created_date'      => Yii::t('admin', 'Created Date'),
			'updated_date'      => yii::t('admin', 'Updated Date'),
			'title'             => yii::t('admin', 'Title'),
			'small_description' => Yii::t('admin', 'Small Description'),
			'description'       => Yii::t('admin', 'Description'),
			'is_visible'        => Yii::t('admin', 'Is Visible?'),
			'tags'              => Yii::t('admin', 'Tags'),
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
		$criteria=new CDbCriteria;

		$criteria->compare('page_id',$this->page_id,true);
		$criteria->compare('admin_user_id',$this->admin_user_id,true);
		$criteria->compare('url_id',$this->url_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('is_visible',$this->is_visible);
		$criteria->compare('scope_id',$this->scope_id);

        if (!isset($this->tags)) {
		    $criteria->addSearchCondition('tags', $this->tags);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' =>  array(
                'pageVar' => 'page'
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Page the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * This is invoked when a record is populated with data from a find() call.
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldTags=$this->tags;
    }

    /**
     * Set the updated_date to current datetime before save the row. 
     */
    public function beforeSave()
    {
        if (!$this->isNewRecord) {
            $this->updated_date = date('Y-m-d H:i:s');
        }

        return parent::beforeSave();
    }

    protected function afterSave()
    {
        parent::afterSave();
        Tag::model()->updateFrequency($this->_oldTags, $this->tags);
    }

    public function beforeDelete()
    {
        foreach ($this->media as $media) {
            $media->delete();
        }

        $this->url->delete();

        return parent::beforeDelete();
    }

    /**
     * This is invoked after the record is deleted.
     */
    protected function afterDelete()
    {
        parent::afterDelete();
        Tag::model()->updateFrequency($this->tags, '');
    }

    public function getFirstMedia()
    {
        $mediaList = $this->media;

        if (count($mediaList) > 0) {
            return $mediaList[0];
        }

        return false;
    }

    public function getCreatedDate()
    {
        if ($this->createdDateTime === null) {
            $this->createdDateTime = new DateTime($this->created_date);
        }
        return $this->createdDateTime;
    }

    /*
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links=array();
        foreach(Tag::string2array($this->tags) as $tag)
            $links[]=CHtml::link(CHtml::encode($tag), BlogConfig::getFullHomeUrl() . '?tag=' . $tag);
        return $links;
    }

    /**
     * Normalizes the user-entered tags.
     */
    public function normalizeTags($attribute,$params)
    {
        $this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
    }

}
