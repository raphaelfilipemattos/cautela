<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pessoa $model */

$this->title = $model->idpessoa;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pessoa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idpessoa' => $model->idpessoa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idpessoa' => $model->idpessoa], [
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
            'idpessoa',
            'nome',
            'nome_guerra',
            'identidade',
            'senha',
            'ativo',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
