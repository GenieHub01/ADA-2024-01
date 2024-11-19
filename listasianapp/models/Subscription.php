<?php

/**
 * This is the model class for table "subscription".
 *
 * The followings are the available columns in table 'subscription':
 * @property integer $id
 * @property integer $advert_id
 * @property integer $plan_id
 *
 * The followings are the available model relations:
 * @property Advert $advert
 * @property Plan $plan
 */
class Subscription extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'subscription';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('advert_id, plan_id', 'numerical', 'integerOnly'=>true),
            array('id, advert_id, plan_id', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'advert' => array(self::BELONGS_TO, 'Advert', 'advert_id'),
            'plan' => array(self::BELONGS_TO, 'Plan', 'plan_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'advert_id' => 'Advert',
            'plan_id' => 'Plan',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('advert_id', $this->advert_id);
        $criteria->compare('plan_id', $this->plan_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
