<?php

use app\models\Material;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Materials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Incluir Material', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'num_patrimonio',
            'descricao',                         
            ['attribute' => 'iddependencias', 'label' => 'Dependência', 'value' => function ($data) {
                return $data->getDependencias()->nome;
             }
            ],
            //'valoruni',
            //'ativo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Material $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idmaterial' => $model->idmaterial]);
                 }
            ],
        ],
    ]); ?>


</div>
