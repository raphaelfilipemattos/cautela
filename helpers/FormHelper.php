<?php 

namespace app\helpers;

use Yii;

class FormHelper {
 
     public static function criaSelecaoMultiplo(string $titulo, string $textoDescicaoDestino,string $nomeCampoDestino, array $arrayDestino, string $nome_id_destino,string $nome_descricao_destino, 
                                                string $nomeCampoOrigem, array $array_origem, string $nome_id_origem,string|array $nome_descricao_origem, string $textoDescicaoOrigem = 'Todos'){
                                                        
        $resposta = "<div class='row '>
                  <div class='col-md-5 m-auto'>
                      <label class='titulo' for='{$nomeCampoDestino}'>{$textoDescicaoDestino}</label>
                         <ul class='form-control multiplo  multiplo_destino ' name='{$nomeCampoDestino}' >";               
                            $temp  = [];
                            foreach( $arrayDestino as $destino ){
                                $temp[]  = $destino[$nome_id_destino];   
                                $resposta .= "<li data-id='{$destino[$nome_id_destino]}'> ".$destino[$nome_descricao_destino]."</li>";            
                            }
        $temp = join(',', $temp);                            
        $resposta .="         </ul>   
                          <input type='hidden' class='multiplo_destino_id' name='{$nomeCampoDestino}_id' value='".$temp."' >
                   </div>
                   <div class='col-md-1 multiplo_container_btn' >
                       <a href='#' class='bnt add_multiplo' title='Adicionar'> <i class='bi bi-chevron-double-left'></i> </a>
                       <a href='#' class='bnt del_multiplo' title='remover'> <i class='bi bi-chevron-double-right'></i> </a>
                   </div>
                   <div class='col-md-5 m-auto'>
                       <label  class='titulo' for='{$nomeCampoOrigem}'>{$textoDescicaoOrigem}</label>
                       <ul class='form-control multiplo multiplo_origem ' name='{$nomeCampoOrigem}'   > ";                                       
                    foreach( $array_origem as $origem ){     
                          $descricao = "";
                         if (is_array($nome_descricao_origem)){
                             $tmpdesc = [];
                             foreach($nome_descricao_origem as $desc){
                              $tmpdesc[] =$origem[$desc]; 
                             } 
                             $descricao = join(" - ",$tmpdesc);
                         }else{
                            $descricao =$origem[$nome_descricao_origem]; 

                         }
                         $resposta .="<li data-id='{$origem[$nome_id_origem]}'>".$descricao."</li>";
                    }    
         $resposta .="  </ul> 
                   </div>
                 </div>";

         

        $div = "<div class='card multiplo_region'>
                         <h6 class='card-header header-multiplo'>{$titulo} </h6>
                          <div class='col-md-12 bloco_multiplo'>                                                            
                              {$resposta}
                            </div>
                       </div> ";
                 

       return $div;
     }


     public static function msgErro($msg){
        return Yii::$app->session->setFlash('error', $msg);
     }

     public static function msgSucesso($msg){
        return Yii::$app->session->setFlash('success', $msg);
     }

     public static function msgAlerta($msg){
        return Yii::$app->session->setFlash('warning', $msg);
     }

     public static function formataCPF($cpf){
       return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4",$cpf);
     }


}