<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pessoa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pessoa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postograd')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nome_guerra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identidade')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
