<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pessoa $model */

$this->title = 'Atualizar Pessoa: ' . $model->idpessoa;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpessoa, 'url' => ['view', 'idpessoa' => $model->idpessoa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pessoa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
