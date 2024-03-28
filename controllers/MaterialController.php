<?php

namespace app\controllers;

use app\models\Material;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        if ( User::getUsuarioLogado() == false ) {
            $this->redirect("/site/login");
       }
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
     * Lists all Material models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Material::getQueryMateriaisUsuario(User::getUsuarioLogado()->id),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idmaterial' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Material model.
     * @param int $idmaterial Idmaterial
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idmaterial)
    {
        return $this->render('view', [
            'model' => $this->findModel($idmaterial),
        ]);
    }

    /**
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Material();

        if ($this->request->isPost) {

            $patrimonios = explode(',', $this->request->post("Material")["patrimonios"] );           
            foreach($patrimonios as $patrimonio){
                if (empty(trim($patrimonio))) continue;
                
                $material = new Material();
                if ($material->load($this->request->post()) ) {
                    $material->num_patrimonio = trim($patrimonio);
                    $material->save();
                }

            }    
           
            return $this->redirect(['index']);           
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Material model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idmaterial Idmaterial
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idmaterial)
    {
        $model = $this->findModel($idmaterial);

        if ($this->request->isPost && $model->load($this->request->post()) &&  $model->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Material model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idmaterial Idmaterial
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idmaterial)
    {
        $this->findModel($idmaterial)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idmaterial Idmaterial
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idmaterial)
    {
        if (($model = Material::findOne(['idmaterial' => $idmaterial])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
