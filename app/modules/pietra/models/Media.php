<?php

/**
 * This is the model class for table "media".
 *
 * The followings are the available columns in table 'media':
 * @property string $media_id
 * @property string $media
 * @property string $type
 *
 * The followings are the available model relations:
 */
class Media extends CActiveRecord
{
    private $validExtensions = array(
        'png',
        'jpg',
        'jpeg',
        'gif',
    );

    private $oldFile;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'media';
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
			array('title, created_date', 'required'),
            array('file', 'required', 'on' => 'create'),
			array('title', 'length', 'max'=>60),
			array('file', 'length', 'max'=>40),
            array('file' , 'file', 'allowEmpty' => true, 'types' => implode(',', $this->validExtensions)),
			// The following rule is used by search().
			array('media_id, title', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'media_id'      => Yii::t('admin', 'Media Id'),
			'title'         => Yii::t('admin', 'Title'),
			'file'          => Yii::t('admin', 'File'),
            'create_date'   => Yii::t('admin', 'Created Date'),
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

		$criteria->compare('media_id',$this->media_id,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20
            )
        ));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return media the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function afterFind()
    {
        parent::afterFind();
        $this->oldFile = $this->file;
    }

    public function beforeSave()
    {
        $mediaPath = Yii::app()->getModule('pietra')->mediaPath;

        if ($this->file instanceof CUploadedFile) {

            $fileName = md5(time()) . '.' . $this->file->extensionName;

            $this->file->saveAs($mediaPath . '/' . $fileName);

            $this->file = $fileName;

            if (!empty($this->oldFile)) {
                $file = $mediaPath . '/' . $this->oldFile;
                if(file_exists($file)) {
                    unlink($file);
                }
            }
        }

        if(empty($this->file) && !empty($this->oldFile)) {
            $this->file = $this->oldFile;
        }

        return parent::beforeSave();
    }

    public function afterDelete()
    {
        $mediaPath = Yii::app()->getModule('pietra')->mediaPath;

        $file = $mediaPath . '/' . $this->file; 

        if (file_exists($file)) {
            unlink($file);
        }

        return parent::afterDelete();
    }

    public function getUrl()
    {
        $homeUrl = Yii::app()->homeUrl;

        if ($homeUrl == '/') {
            $homeUrl = null;
        }

        return $homeUrl . '/' . Yii::app()->getModule('pietra')->mediaUrl . $this->file;
    }
}
