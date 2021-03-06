<?php

/**
 * @property integer $static_page_id
 * @property integer $journal_id
 * @property string $name
 * @property string $html_file_path
 * @property integer $is_visible
 */
class StaticPages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StaticPages the static model class
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
		return 'static_pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('journal_id, name, html_file_path, is_visible', 'required'),
			array('journal_id, is_visible', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('html_file_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('static_page_id, journal_id, name, html_file_path, is_visible', 'safe', 'on'=>'search'),
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
            'journal' => array(self::BELONGS_TO, 'Journals', 'journal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'static_page_id' => 'Static Page',
			'journal_id' => 'Journal',
			'name' => 'Name',
			'html_file_path' => 'Html File Path',
			'is_visible' => 'Is Visible',
		);
	}

    /**
      * Returns html content of page
      * @return String
      */
    public function getContent()
    {
        $pagePath = Yii::app()->params['webRoot'] . Yii::app()->params['staticPagesPath']
                  .  'journal_' . $this->journal->journal_id . '/' . $this->html_file_path . '.html';

        if (file_exists($pagePath)) {
            return file_get_contents($pagePath);
        } else {
            return 'Файл с содержанием страницы журнала не существует';
        }

        return null;
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

		$criteria->compare('static_page_id',$this->static_page_id);
		$criteria->compare('journal_id',$this->journal_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('html_file_path',$this->html_file_path,true);
		$criteria->compare('is_visible',$this->is_visible);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}