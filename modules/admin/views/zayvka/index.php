<?php

use app\models\Zayvka;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ZayvkaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zayvka-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!--<p>
        <//?= Html::a('Создать заявку', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'body:ntext',
            'ph',
            'img',
            //'category_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Zayvka $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
            [
                    'attribute'=>'status',
                    'value'=>function($zayvka){
                        return $zayvka->getStatus();
                    },
            ],
            [
                'attribute'=>'Администрирование',
                'format'=>'html',
                'value'=>function($data){
        switch ($data->status){
            case 0:
                return Html::a('Одобрить', 'good/?id='.$data->id)."|".
                    Html::a('Отклонить', 'verybad/?id='.$data->id);
            case 1:
                return Html::a('Одобрить', 'good/?id='.$data->id);
            case 2:
                return Html::a('Отклонить', 'verybad/?id='.$data->id);
        }
                }
            ]
        ],
    ]); ?>


</div>
