<?php

/**
 * This is the model class for table "ls_pay".
 *
 * The followings are the available columns in table 'ls_pay':
 * @property string $pay_id
 * @property string $u_id
 * @property string $pay_add_date
 * @property integer $paid
 * @property string $paid_date
 * @property string $paid_u_id
 */
class LsPay extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsPay the static model class
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
		return 'ls_pay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('paid', 'numerical', 'integerOnly'=>true),
			array('u_id, paid_u_id', 'length', 'max'=>19),
			array('pay_add_date, paid_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('pay_id, u_id, pay_add_date, paid, paid_date, paid_u_id', 'safe', 'on'=>'search'),
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
			'pay_id' => 'Pay',
			'u_id' => 'U',
			'pay_add_date' => 'Pay Add Date',
			'paid' => 'Paid',
			'paid_date' => 'Paid Date',
			'paid_u_id' => 'Paid U',
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

		$criteria->compare('pay_id',$this->pay_id,true);
		$criteria->compare('u_id',$this->u_id,true);
		$criteria->compare('pay_add_date',$this->pay_add_date,true);
		$criteria->compare('paid',$this->paid);
		$criteria->compare('paid_date',$this->paid_date,true);
		$criteria->compare('paid_u_id',$this->paid_u_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}