<head>
    <link href="/css/site.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<div class="print_cautela">
    <div class="text-center" >
           <img src="/img/brasao_republica.png" class="brasao"> 
           <h6>Ministério da Defesa</h6>
           <h6>Exército Brasileiro</h6>
           <h6>Diretoria de Educação Técnica Militar</h6>
           <h6>Centro de Educação a Distância do Exército</h6>           
    </div>
    <div class="row ">
        <div class="text-center">
           <h2> Cautela de Material</h2>
        </div>

    </div>
    <div class="text-end" >
        <span class="fw-bold text-danger">Cautela Nº <?= $model->idcautela ?> </span>
    </div>
    <div class="text-start" >
        <span><?= date("d  M  Y ", strtotime( $model->data)) ?></span>               
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row text-center">
                <h3>Requerente</h3>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            Nome:
                        </td>
                        <td>
                            <?= $model->nome_cautelador ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nome de guerra:
                        </td>
                        <td>
                            <?= $model->nome_guerra_cautelador ?>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            CPF:
                        </td>
                        <td>
                            <?= $model->cpf_cautelador ?>
                        </td>

                    </tr>
                    <tr>
                        
                        <td>
                            OM:
                        </td>
                        <td>
                            <?= $model->om_cautelador ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>   
    <div class="row">
           <div class="col-md-12">
               <div class="row text-center">
                    <h3>Materiais</h3>
               </div>
               <div class="row">
                   <table class="table table-bordered tabela_itens">
                        <thead>
                            <th>Nº Patrimômio</th>
                            <th>Descrição</th>
                        </thead>
                        <tbody>
                            <?php 
                               $itens = $model->getItens();
                               foreach($itens as $item){
                                 $material = $item->getMaterial();    
                            ?>
                               <tr>
                                  <td><?= $material->num_patrimonio ?></td>
                                  <td><?= $material->descricao ?></td>
                               </tr>
                            <?php
                               }
                            ?>
                        </tbody>
                   </table>
               </div>
           </div> 
    </div>
    <div class="row mt-5 text-center">
        <div class="col-md-12">
           
            <div class="row">
                <hr class="col-md-7 m-auto">
            </div>
            <div class="row">
                <h6><?= $model->nome_cautelador ?></h6>
            </div>
            <div class="row mt-5">
                <hr class="col-md-7  m-auto">
            </div>
            <div class="row">
                <h6><?= $model->getPessoaCriou()->nome_guerra ?></h6>
            </div>
        </div>
    </div>
    <div class="row text-end">
        <div class="col-md-12 hash">
            Código de segurança: <?= $model->hash ?>
        </div>
    </div>
</div>

