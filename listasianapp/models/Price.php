<?php

class Price extends CActiveRecord
{
	
	public function tableName()
	{
		return 'Price';
	}
	
	public function rules()
	{
		return [
            ['description', 'length', 'max' => 255],
			['value', 'numerical']
		];
	}
	
	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	
	public function getList()
	{
		return CHtml::listData($this->findAll(), 'id', 'name');
	}
}