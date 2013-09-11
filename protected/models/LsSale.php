<?php

/**
 * This is the model class for table "ls_sale".
 *
 * The followings are the available columns in table 'ls_sale':
 * @property string $sale_id
 * @property string $sale_name
 * @property string $sale_tel
 * @property string $sup_id
 * @property integer $sale_act
 */
class LsSale extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsSale the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ls_sale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale_act', 'numerical', 'integerOnly'=>true),
			array('sale_name, sale_tel', 'length', 'max'=>255),
			array('sup_id', 'length', 'max'=>19),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sale_id, sale_name, sale_tel, sup_id, sale_act', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sale_id' => 'Sale',
			'sale_name' => 'Sale Name',
			'sale_tel' => 'Sale Tel',
			'sup_id' => 'Sup',
			'sale_act' => 'Sale Act',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('sale_id',$this->sale_id,true);
		$criteria->compare('sale_name',$this->sale_name,true);
		$criteria->compare('sale_tel',$this->sale_tel,true);
		$criteria->compare('sup_id',$this->sup_id,true);
		$criteria->compare('sale_act',$this->sale_act);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}