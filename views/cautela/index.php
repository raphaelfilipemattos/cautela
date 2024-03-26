<?php

use app\controllers\CautelaController;
use app\models\Cautela;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cautelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cautela-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Incluir Cautela', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           
            'data',
            'hora',
            'nome_cautelador',
            'nome_guerra_cautelador',
            'cpf_cautelador',
            'om_cautelador',          
            'datahora_retorno',            
            ['attribute' => 'flagbaixa', 'label' => 'Recebido', 'value' => function ($data) {                
                return $data->flagbaixa ? "Sim" : "Não";
             }
            ],         
            ['attribute' => 'idpessoa_recebeu', 'label' => 'Pessoa que Recebeu', 'value' => function ($data) {
                $pessoa = $data->getPessoaRecebeu();
                if (empty($pessoa)) return "";
                return $pessoa->nome_guerra;
             }
            ],
            //'obs:ntext',
            [
                'class' => ActionColumn::className(),
                "template" => '{view} {update} {delete} {imprimir} {baixar}',            
                'urlCreator' => function ($action, Cautela $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idcautela' => $model->idcautela]);
                 },
                 "buttons" =>[
                    "imprimir" => function ($url, $model, $key) {
                        return Html::a('<i class="bi bi-printer imprimir_cautela" ></i>',Url::toRoute(["print", 'idcautela' => $model->idcautela]), ["title" =>"Imprimir"]);
                     },
                     "baixar" => function ($url, $model, $key) {
                        return Html::a('<i class="bi bi-check2-all baixar_cautela"></i>', Url::toRoute(["baixar", 'idcautela' => $model->idcautela]),["title" => "Receber cautela"]);
                     },
                 ]
                
            ],
        ],
    ]); ?>


</div>
