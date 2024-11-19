<?php

/**
 * This is the model class for table "plan".
 *
 * The followings are the available columns in table 'plan':
 * @property integer $id
 * @property string $name
 * @property integer $package
 * @property integer $interval
 * @property string $amount
 * @property string $currency
 *
 * The followings are the available model relations:
 * @property Subscription[] $subscriptions
 */
class Plan extends CActiveRecord
{

    public $intervalList = [
        3 => 'day',
        1 => 'month',
        2 => 'year',
    ];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    ['name, currency, amount', 'required'],
			array('package, interval', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
            array('currency', 'length', 'min' => 3, 'max'=>5),
			array('amount', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, package, interval, amount', 'safe', 'on'=>'search'),
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
			'subscriptions' => array(self::HAS_MANY, 'Subscription', 'plan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'package' => 'Package',
			'interval' => 'Interval',
			'amount' => 'Amount',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('package',$this->package);
		$criteria->compare('interval',$this->interval);
		$criteria->compare('amount',$this->amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Plan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Customize the beforeSave method to perform operations without Stripe.
     */
	public function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                if (!isset($this->intervalList[$this->interval])) {
                    throw new CException(500, 'Invalid interval selected.');
                }
            }
            return true;
        } else {
            return false;
        }
	}

    /**
     * Customize the afterDelete method to perform operations without Stripe.
     */
    public function afterDelete()
    {
        parent::afterDelete();
        // Perform any additional cleanup if needed.
        // No action is required here as we are no longer using Stripe plans.
    }
}
