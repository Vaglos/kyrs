<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "podrob".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $img
 * @property int $cat_id
 *
 * @property Catalog $cat
 */
class Podrob extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'podrob';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'img', 'cat_id'], 'required'],
            [['body'], 'string'],
            [['cat_id'], 'integer'],
            [['title', 'img'], 'string', 'max' => 150],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::class, 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'img' => 'Img',
            'cat_id' => 'Cat ID',
        ];
    }

    /**
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Catalog::class, ['id' => 'cat_id']);
    }
}
