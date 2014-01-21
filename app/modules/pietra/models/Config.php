<?php

/**
 * This is the model class for table "config".
 *
 * The followings are the available columns in table 'config':
 * @property string $config_id
 * @property integer $scope_id
 * @property string $name
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Scope $scope
 */
class Config extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'config';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('config_id, scope_id, name, value', 'required'),
            array('scope_id', 'numerical', 'integerOnly'=>true),
            array('config_id', 'length', 'max'=>11),
            array('name', 'length', 'max'=>60),
            array('name', 'unique', 'allowEmpty'=>false),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('config_id, scope_id, name, value', 'safe', 'on'=>'search'),
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
            'scope' => array(self::BELONGS_TO, 'Scope', 'scope_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'config_id'     => 'Config Id',
            'scope_id'      => 'Scope',
            'name'          => 'Name',
            'value'         => 'Value',
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

        $criteria->compare('config_id',$this->config_id,true);
        $criteria->compare('scope_id',$this->scope_id);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('value',$this->value,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Config the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getConfig($name)
    {
        $config = $this->find(
            'name=:name',
            array(':name' => $name)
        ); 

        if ($config === null) {
            return;
        }

        return $config->value;
    }

    public function setConfig($name, $value)
    {
        return $this->updateAll(
            array('value' => $value),
            'name=:name',
            array(':name' => $name)
        );
    }
}
