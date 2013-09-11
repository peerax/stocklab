<?php

/**
 * This is the model class for table "ls_user".
 *
 * The followings are the available columns in table 'ls_user':
 * @property string $u_id
 * @property string $u_name
 * @property string $u_pass
 * @property string $type_id
 * @property string $com_id
 * @property string $u_add
 * @property string $u_fname
 */
class LsUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LsUser the static model class
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
		return 'ls_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('u_name, u_fname', 'length', 'max'=>255),
			array('u_pass', 'length', 'max'=>18),
			array('type_id, com_id', 'length', 'max'=>19),
			array('u_add', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('u_id, u_name, u_pass, type_id, com_id, u_add, u_fname', 'safe', 'on'=>'search'),
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
			'u_id' => 'U',
			'u_name' => 'U Name',
			'u_pass' => 'U Pass',
			'type_id' => 'Type',
			'com_id' => 'Com',
			'u_add' => 'U Add',
			'u_fname' => 'U Fname',
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

		$criteria->compare('u_id',$this->u_id,true);
		$criteria->compare('u_name',$this->u_name,true);
		$criteria->compare('u_pass',$this->u_pass,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('com_id',$this->com_id,true);
		$criteria->compare('u_add',$this->u_add,true);
		$criteria->compare('u_fname',$this->u_fname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}