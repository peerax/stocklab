<?php

/**
 * This is the model class for table "ls_stock".
 *
 * The followings are the available columns in table 'ls_stock':
 * @property string $stock_id
 * @property string $item_id
 * @property string $item_lot
 * @property string $item_amnt
 * @property string $item_price
 * @property string $item_exp
 * @property string $stock_last_update
 */
class LsStock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsStock the static model class
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
		return 'ls_stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, item_amnt', 'length', 'max'=>19),
			array('item_lot', 'length', 'max'=>100),
			array('item_price', 'length', 'max'=>15),
			array('item_exp, stock_last_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('stock_id, item_id, item_lot, item_amnt, item_price, item_exp, stock_last_update', 'safe', 'on'=>'search'),
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
			'stock_id' => 'Stock',
			'item_id' => 'Item',
			'item_lot' => 'Item Lot',
			'item_amnt' => 'Item Amnt',
			'item_price' => 'Item Price',
			'item_exp' => 'Item Exp',
			'stock_last_update' => 'Stock Last Update',
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

		$criteria->compare('stock_id',$this->stock_id,true);
		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('item_lot',$this->item_lot,true);
		$criteria->compare('item_amnt',$this->item_amnt,true);
		$criteria->compare('item_price',$this->item_price,true);
		$criteria->compare('item_exp',$this->item_exp,true);
		$criteria->compare('stock_last_update',$this->stock_last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}