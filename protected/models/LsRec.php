<?php

/**
 * This is the model class for table "ls_rec".
 *
 * The followings are the available columns in table 'ls_rec':
 * @property string $rec_id
 * @property string $rec_date
 * @property string $rec_bill_no
 * @property string $com_id
 * @property string $u_id
 * @property string $rec_add_date
 */
class LsRec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsRec the static model class
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
		return 'ls_rec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rec_bill_no', 'length', 'max'=>255),
			array('com_id, u_id', 'length', 'max'=>19),
			array('rec_date, rec_add_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rec_id, rec_date, rec_bill_no, com_id, u_id, rec_add_date', 'safe', 'on'=>'search'),
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
			'rec_id' => 'Rec',
			'rec_date' => 'Rec Date',
			'rec_bill_no' => 'เลขที่บิล',
			'com_id' => 'Com',
			'u_id' => 'U',
			'rec_add_date' => 'Rec Add Date',
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

		$criteria->compare('rec_id',$this->rec_id,true);
		$criteria->compare('rec_date',$this->rec_date,true);
		$criteria->compare('rec_bill_no',$this->rec_bill_no,true);
		$criteria->compare('com_id',$this->com_id,true);
		$criteria->compare('u_id',$this->u_id,true);
		$criteria->compare('rec_add_date',$this->rec_add_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}