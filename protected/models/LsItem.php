<?php

/**
 * This is the model class for table "ls_item".
 *
 * The followings are the available columns in table 'ls_item':
 * @property string $item_id
 * @property string $item_barcode
 * @property string $item_name
 * @property string $cat_id
 * @property string $item_des
 * @property string $item_adate
 * @property string $item_last_edit
 * @property string $item_picture
 * @property string $unit_id
 * @property string $item_rop
 * @property string $in_use
 */
class LsItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsItem the static model class
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
		return 'ls_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_barcode', 'length', 'max'=>45),
			array('item_name, item_des, item_picture', 'length', 'max'=>255),
			array('cat_id, unit_id', 'length', 'max'=>19),
			array('item_rop', 'length', 'max'=>10),
			array('item_adate, item_last_edit', 'safe'),
                        array('item_barcode', 'unique'),
                        array('item_rop', 'numerical'),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('item_id,in_use, item_barcode, item_name, cat_id, item_des, item_adate, item_last_edit, item_picture, unit_id, item_rop', 'safe', 'on'=>'search'),
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
			'item_id' => 'Item',
			'item_barcode' => 'Barcode',
			'item_name' => 'ชื่อวัสดุ',
			'cat_id' => 'Cat',
			'item_des' => 'Item Des',
			'item_adate' => 'Item Adate',
			'item_last_edit' => 'Item Last Edit',
			'item_picture' => 'Item Picture',
			'unit_id' => 'หน่วยนับ',
			'item_rop' => 'ปริมาณ Re-order point',
                        'in_use' => 'เปิดใช้งาน',
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

		$criteria->compare('item_id',$this->item_id,true);
		$criteria->compare('item_barcode',$this->item_barcode,true);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('cat_id',$this->cat_id,true);
		$criteria->compare('item_des',$this->item_des,true);
		$criteria->compare('item_adate',$this->item_adate,true);
		$criteria->compare('item_last_edit',$this->item_last_edit,true);
		$criteria->compare('item_picture',$this->item_picture,true);
		$criteria->compare('unit_id',$this->unit_id,true);
		$criteria->compare('item_rop',$this->item_rop,true);
		$criteria->compare('in_use',$this->in_use,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}