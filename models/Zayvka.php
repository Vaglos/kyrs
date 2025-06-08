<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zayvka".
 *
 * @property int $id
 * @property string $name
 * @property string $body
 * @property string $img
 * @property int $category_id
 *
 * @property Category $category
 */
class Zayvka extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zayvka';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'body', 'img','ph'], 'required'],
            [['body'], 'string'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
            ['user_id', 'default', 'value'=>Yii::$app->user->getId()]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'body' => 'Описание',
            'ph'=>'Номер телефона',
            'img' => 'Изображение',
            'category_id' => 'Категория',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->img->saveAs('upload/'. $this->img->baseName .'.'. $this->img->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getStatus()
    {
        switch ($this->status){
            case 0: return'Ожидание';
            case 1: return'Отклонено';
            case 2: return'Принято';
        }
    }

       public function good()
    {
    	$this->status=2;
    	return $this->save(false);
    }

    public function verybad()
    {
    	$this->status=1;
    	return $this->save(false);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function good()
    {
        $this->status=2;
        return $this->save(false);
    }

    public function verybad()
    {
        $this->status=1;
        return $this->save(false);
    }
}

