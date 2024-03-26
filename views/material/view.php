<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Material $model */

$this->title = $model->idmaterial;
$this->params['breadcrumbs'][] = ['label' => 'Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="material-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idmaterial' => $model->idmaterial], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idmaterial' => $model->idmaterial], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idmaterial',
            'num_patrimonio',
            'num_ficha',
            'cod_material',
            'contacontabil',
            'descricao',
            'iddetentor',
            'iddependencias',
            'valoruni',
            'ativo',
        ],
    ]) ?>

</div>
