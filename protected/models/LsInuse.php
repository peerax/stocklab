<?php

/**
 * This is the model class for table "ls_inuse".
 *
 * The followings are the available columns in table 'ls_inuse':
 * @property string $use_id
 * @property string $stock_id
 * @property string $qty
 * @property string $use_mo
 * @property string $use_ye
 * @property string $u_id
 * @property string $use_date
 */
class LsInuse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsInuse the static model class
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
		return 'ls_inuse';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('stock_id, u_id', 'length', 'max'=>19),
			array('qty', 'length', 'max'=>3),
			array('use_mo', 'length', 'max'=>2),
			array('use_ye', 'length', 'max'=>4),
			array('use_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('use_id, stock_id, qty, use_mo, use_ye, u_id, use_date', 'safe', 'on'=>'search'),
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
			'use_id' => 'Use',
			'stock_id' => 'Stock',
			'qty' => 'Qty',
			'use_mo' => 'Use Mo',
			'use_ye' => 'Use Ye',
			'u_id' => 'U',
			'use_date' => 'Use Date',
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

		$criteria->compare('use_id',$this->use_id,true);
		$criteria->compare('stock_id',$this->stock_id,true);
		$criteria->compare('qty',$this->qty,true);
		$criteria->compare('use_mo',$this->use_mo,true);
		$criteria->compare('use_ye',$this->use_ye,true);
		$criteria->compare('u_id',$this->u_id,true);
		$criteria->compare('use_date',$this->use_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}