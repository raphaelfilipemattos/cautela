<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cautela $model */

$this->title = $model->idcautela;
$this->params['breadcrumbs'][] = ['label' => 'Cautelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cautela-view">

    <h1>Cautela Nº <?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idcautela',            
            'data',
            'hora',
            'nome_cautelador',
            'nome_guerra_cautelador',
            'cpf_cautelador',
            'om_cautelador',
            'datahora_retorno',
            'flagbaixa',
            'idpessoa_recebeu',
            'obs:ntext',
            ['attribute' => 'idmaterial','format' => 'raw', 'label' => 'Itens', 'value' => function ($data) {
                $itens = $data->getItens();
                if (empty($itens)) return "";

                $trs = "";
                foreach($itens as $item){
                    $material = $item->getMaterial();
                    $trs .= "<tr>
                                 <td> $material->num_patrimonio </td>
                                 <td> $material->descricao </td>
                             </tr>";
                }

                $tabela = "<table class='table table-responsive'>
                               <thead>
                                   <th>Nº Patrimônio </th>
                                   <th>Descrição </th>
                               </thead>
                               <tbody>
                                  $trs 
                               </tbody>
                           </table>";

                return $tabela ;
             }
            ],
        ],
    ]) ?>

</div>
