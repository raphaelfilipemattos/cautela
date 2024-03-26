<?php

use app\helpers\FormHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cautela $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="cautela-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">            
        <div class="col-md-2">
            <?= $form->field($model, 'data')->textInput(["type" => "date", ]) ?>
        </div>    
        <div class="col-md-2">
            <?= $form->field($model, 'hora')->textInput(["type" => "time"]) ?>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <h3>
                 Cautelador 
                 <span class="fs-6 fst-italic fw-lighter">Pessoa que está solicitando o material</span>
            </h3>
        </div>
    
            
        <div class="card col-md-7 p-3 m-2">
            <div class="row">
                <div class="col-md-7">
                    <?= $form->field($model, 'nome_cautelador')->textInput(['maxlength' => true,"autofocus" =>true  ]) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'nome_guerra_cautelador')->textInput(['maxlength' => true]) ?>
                </div>               
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'cpf_cautelador')->textInput(['maxlength' => true, "class" => "cpf form-control"]) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'om_cautelador')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <?= $form->field($model, 'obs')->textarea(['rows' => 6, "class"=>"form-control"]) ?>
    </div>
    <div class="w-100">
        <?php 
           if ($novo){
              echo FormHelper::criaSelecaoMultiplo("Materiais","Materiais cautelados","maerialcautelado",$materiais,"idmaterial","descricao","materialtodos",$materiaisdisponiveis,"idmaterial",["descricao","num_patrimonio"],"Materiais disponíveis");

           } else{
               echo "<span class='badge  text-bg-danger m-2 p-2'>Os itens não podem ser alterados </span>"; 
           }
        ?>
        

    </div>
    
    

    <div class="form-group">
        <?= Html::submitButton('Gravar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
