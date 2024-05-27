<?php

use yii\bootstrap5\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([]); ?>

<h1 style="display: flex; justify-content: center; padding-top: 15%">Регистрация</h1>

<div class="row" style="display:flex; flex-direction: row; flex-wrap: nowrap; justify-content: center;">
    <div class="col-lg-5">

        <?= $form->field($model, 'username')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div style="display: flex; justify-content: center">
                <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
