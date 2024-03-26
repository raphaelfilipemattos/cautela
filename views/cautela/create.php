<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cautela $model */

$this->title = 'Incluir Cautela';
$this->params['breadcrumbs'][] = ['label' => 'Cautelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cautela-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "materiaisdisponiveis" => $materiaisdisponiveis,
        "materiais" => $materiais,
        "novo" => true
    ]) ?>

</div>
