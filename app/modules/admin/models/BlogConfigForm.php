<?php

class BlogConfigForm extends CFormModel
{
    public $blogName;
    public $homeBlog;
    public $postsPerPage;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('blogName, homeBlog, postsPerPage', 'required'),
			array('blogName, homeBlog, postsPerPage', 'length', 'max' => 255),
            array('postsPerPage', 'numerical', 'integerOnly' => true),
		);
	}
    
    public function attributeLabels()
    {
        return array(
            'blogName'      => Yii::t('admin', 'Blog name'),
            'homeBlog'      => Yii::t('admin', 'Blog url'),
            'postsPerPage'  => Yii::t('admin', 'Posts per page'),
        );
    }

    public function extractFromConfig(Config $config)
    {
        if (property_exists($this, $config->name)) {
            $this->{$config->name} = $config->value; 
        }
    }
} 
