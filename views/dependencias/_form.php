<?php

use app\models\Pessoa;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Dependencias $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dependencias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'iddetentor_direto')->dropDownList(ArrayHelper::map(Pessoa::find()->all(),'idpessoa','nome_guerra')  ) ?>
    <?= $form->field($model, 'iddetentor_indireto')->dropDownList(ArrayHelper::map(Pessoa::find()->all(),'idpessoa','nome_guerra')  ) ?>

    <div class="form-group">
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
