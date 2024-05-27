<?php

namespace app\modules\admin\controllers;

use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function behaviors()
    {
        return [
            'access'=> [
                'class'=> AccessControl::class,
                'only'=>['*'],
                'rules'=>[
                    [
                        'actions'=>['index'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                    [
                        'actions'=>['index','create','admin','good','verybad'],
                        'allow'=> true,
                        'roles'=>['@'],
                        'matchCallback'=>function($rule, $action) {
                            return \Yii::$app->user->identity->isAdmin();
                        }
                    ],
                ],
            ],
            'verbs'=>[
                'class'=>VerbFilter::class,
                'actions'=> [
                    'delete'=>['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }
}
