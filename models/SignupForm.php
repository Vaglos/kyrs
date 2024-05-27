<?php

namespace app\models;

use yii\db\ActiveRecord;

class SignupForm extends ActiveRecord
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [ ['username','password'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'email' => 'Почта',
        ];
    }


    public function signup()
    {
        $user=new User();
        $user->username=$this->username;
        $user->password=\Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $user->access_token=\Yii::$app->getSecurity()->generateRandomString();
        $user->auth_key=\Yii::$app->getSecurity()->generateRandomString();

        return $user->save();
    }

}