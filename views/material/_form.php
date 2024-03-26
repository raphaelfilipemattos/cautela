<?php

use app\models\Dependencias;
use app\models\Pessoa;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Material $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'descricao')->textarea() ?>    
    <?php 
       if ($novo){
          echo $form->field($model, 'patrimonios')->textarea() ;
       } else{
        echo $form->field($model, "num_patrimonio")->textInput(['maxlength' => true]) ;
       }
    ?>
    
    <?= $form->field($model, 'iddependencias')->dropDownList(ArrayHelper::map(Dependencias::find()->all(),'id','nome')  ) ?>
    

    <?= $form->field($model, 'num_ficha')->textInput() ?>

    <?= $form->field($model, 'cod_material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacontabil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valoruni')->textInput(["type" => "number","pattern"=>"[0-9]+([\.,][0-9]+)?", "step"=>"0.01"]) ?>

    <?= $form->field($model, 'ativo')->checkbox(["value" => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
