<h2>Форма Заявки</h2>


<?php

use app\models\Category;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;


$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($model, 'name')->textInput()?>

<?= $form->field($model, 'body')->textarea(['row'=>6])?>

<?= $form->field($model, 'ph')->widget(\yii\widgets\MaskedInput::class, [
    'mask' => '+999-999-9999',
]) ?>

<?= $form->field($model, 'img')->fileInput() ?>


<?php echo $form->field($model, 'category_id')->dropdownList(
    Category::find()->select(['name', 'id'])->indexBy('id')->column(),
    ['prompt'=>'Выбрать категорию']
);?>


<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>