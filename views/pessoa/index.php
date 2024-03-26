<?php

use app\models\Pessoa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pessoas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Incluir Pessoa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nome',            
            ['attribute' => 'nome_guerra', 'label' => 'Nome de Guerra', 'value' => function ($data) {                
                return $data->postograd.' '. $data->nome_guerra ;
             }
            ],   
            'identidade',
           
            //'ativo',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pessoa $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idpessoa' => $model->idpessoa]);
                 }
            ],
        ],
    ]); ?>


</div>
