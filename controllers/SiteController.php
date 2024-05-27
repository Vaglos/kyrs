<?php

namespace app\controllers;

use app\models\Catalog;
use app\models\Podrob;
use app\models\SignupForm;
use app\models\User;
use app\models\Zayvka;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'kabinet'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['kabinet'],
                        'allow'=>true,
                        'roles'=>['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if(Yii::$app->user->identity->isAdmin()) {
                return $this->redirect(['/admin/zayvka/index']);
            }
            return $this->redirect(['/site/kabinet']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()){
            $this->refresh();
        }
        return $this->render('signup', ['model'=>$model]);
    }

    public function actionContinf()
    {
        return $this->render('continf');
    }

    public function actionZayvka()
    {
        $model = new Zayvka();
        if ($model->load(Yii::$app->request->post())) {
            $model -> img = UploadedFile::getInstance($model, 'img');
            if ($model->save()) {
                if ($model->upload()) {
                    Yii::$app->session->setFlash('success','Заявка успешно отправлена');
                    return $this->goHome();
                }
            }
        } return $this->render('zayvka', ['model'=> $model]);
    }

    public function actionKabinet()
    {
        $user = User::findOne(Yii::$app->user->id);
        $zayv = Zayvka::find()->all();
        return $this->render('kabinet',['zayv'=>$zayv,'user'=>$user]);
    }

    public function actionCatalog()
    {
        $сart = Catalog::find()->all();
        return $this->render('catalog',['cart'=>$сart]);
    }

    public function actionPodrob()
    {
        $id = Yii::$app->request->get('id');
        $pro = Podrob::find()->where(['cat_id'=>$id])->all();

        return $this->render('podrob', ['pro'=>$pro]);
    }
}
