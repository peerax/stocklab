<?php

/**
 * This is the model class for table "ls_com".
 *
 * The followings are the available columns in table 'ls_com':
 * @property string $com_id
 * @property string $com_name
 * @property string $com_addr
 * @property string $com_tel
 * @property string $com_last_update
 * @property string $u_id
 */
class LsCom extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsCom the static model class
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
		return 'ls_com';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('com_name, com_addr, com_tel', 'length', 'max'=>255),
                        array('com_name','unique'),
			array('u_id', 'length', 'max'=>19),
			array('com_last_update', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('com_id, com_name, com_addr, com_tel, com_last_update, u_id', 'safe', 'on'=>'search'),
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
			'com_id' => 'Com',
			'com_name' => 'ชื่อบริษัท',
			'com_addr' => 'ที่อยู่บริษัท',
			'com_tel' => 'เบอร์ติดต่อ',
			'com_last_update' => 'Com Last Update',
			'u_id' => 'U',
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

		$criteria->compare('com_id',$this->com_id,true);
		$criteria->compare('com_name',$this->com_name,true);
		$criteria->compare('com_addr',$this->com_addr,true);
		$criteria->compare('com_tel',$this->com_tel,true);
		$criteria->compare('com_last_update',$this->com_last_update,true);
		$criteria->compare('u_id',$this->u_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}