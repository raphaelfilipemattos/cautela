<?php

use app\models\Dependencias;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dependências';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dependencias-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Incluir Dependencias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nome',
            ['attribute' => 'iddetentor', 'label' => 'Detentor', 'value' => function ($data) {
                return $data->getDetentor()->nome_guerra;
             }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Dependencias $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
