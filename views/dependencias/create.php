<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Dependencias $model */

$this->title = 'Incluir Dependências';
$this->params['breadcrumbs'][] = ['label' => 'Dependencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
