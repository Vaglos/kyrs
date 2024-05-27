<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Zayvka $model */

$this->title = 'Create Zayvka';
$this->params['breadcrumbs'][] = ['label' => 'Заявки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zayvka-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
