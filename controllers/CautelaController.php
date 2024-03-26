<?php

namespace app\controllers;

use app\models\Cautela;
use app\models\Cautelaitens;
use app\models\Material;
use Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CautelaController implements the CRUD actions for Cautela model.
 */
class CautelaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cautela models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cautela::find()->where("excluido = false"),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idcautela' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cautela model.
     * @param int $idcautela Idcautela
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idcautela)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcautela),
        ]);
    }

    /**
     * Creates a new Cautela model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cautela();

        if ($this->request->isPost) {          
            if ($model->load($this->request->post()) ) {
               
                $model->hash = "xxxx";
                if ($model->save()){
                   $hash = ""; 
                   $materiais = explode(',' , $_POST['maerialcautelado_id']);
                   foreach($materiais  as $idmaterial){
                      $materialCautela = new Cautelaitens();
                      $materialCautela->idmaterial = $idmaterial;
                      $materialCautela->idcautela = $model->idcautela;
                      $materialCautela->descricaoitem = Material::find()->where("idmaterial = :idmaterial", ['idmaterial' => $idmaterial])->one()->descricao;
                      $hash .= $materialCautela->descricaoitem.";";                    
                      if (! $materialCautela->save() ){
                        var_dump($materialCautela->getErrors());
                        die;
                      }

                   }                   
                   $model->hash = md5($hash);
                   $model->save();
                   return $this->redirect(['index']);
                }else{
                    var_dump($model->getErrors());
                    die;
                }
            }
        } else {            
            $model->loadDefaultValues();
            $model->data = date("Y-m-d");
            $model->hora = date("H:i");
        }

        return $this->render('create', [
            'model' => $model,
            "materiaisdisponiveis" => Material::getMateriaisUsuario(1),
            "materiais" => []
        ]);
    }

    /**
     * Updates an existing Cautela model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idcautela Idcautela
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idcautela)
    {
        $model = $this->findModel($idcautela);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
      
        $materiais = [];
        foreach($model->getItens() as $item){
            $materiais[] = ["idmaterial" =>   $item->idmaterial,
                            "descricao" =>  $item->getMaterial()->descricao
                           ];  
        }

        return $this->render('update', [
            'model' => $model,
            "materiaisdisponiveis" => Material::getMateriaisUsuario(1),
            "materiais" => $materiais
        ]);
    }

    /**
     * Deletes an existing Cautela model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idcautela Idcautela
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idcautela)
    {
        $model =  $this->findModel($idcautela);
        $model->excluido = true;
        $model->save();

        return $this->redirect(['index']);
    }
    public function actionPrint($idcautela){
        $model =  $this->findModel($idcautela);
        return $this->renderPartial('cautela', [
            'model' => $model
        ]);
    }

    public function actionBaixar($idcautela){
        $model =  $this->findModel($idcautela);
        if (empty($model)){
            throw new Exception("Cautela não encontrada");
        }
        
        if ($model->flagbaixa){
            throw new Exception("Cautela já baixada");
        }

        
        $model->flagbaixa = true;
        $model->idpessoa_recebeu = 1; //TODO: REVER
        $model->datahora_retorno = date('Y-m-d H:i:s');
        return $model->save();

    }

    /**
     * Finds the Cautela model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idcautela Idcautela
     * @return Cautela the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcautela)
    {
        if (($model = Cautela::findOne(['idcautela' => $idcautela])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
