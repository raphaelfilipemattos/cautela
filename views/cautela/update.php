<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cautela $model */

$this->title = 'Atualizar Cautela: ' . $model->idcautela;
$this->params['breadcrumbs'][] = ['label' => 'Cautelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcautela, 'url' => ['view', 'idcautela' => $model->idcautela]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cautela-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "materiaisdisponiveis" =>  $materiaisdisponiveis,
        "materiais" => $materiais,
        "novo" => false
    ]) ?>

</div>
