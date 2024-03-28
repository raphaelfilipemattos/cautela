<?php

namespace app\controllers;

use app\helpers\FormHelper;
use app\models\Pessoa;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PessoaController implements the CRUD actions for Pessoa model.
 */
class PessoaController extends Controller
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
     * Lists all Pessoa models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Pessoa::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'idpessoa' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pessoa model.
     * @param int $idpessoa Idpessoa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idpessoa)
    {
        return $this->render('view', [
            'model' => $this->findModel($idpessoa),
        ]);
    }

    /**
     * Creates a new Pessoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (! User::getUsuarioLogado()->pessoa->admin){
            FormHelper::msgAlerta("Somente administradores podem acessar.");
            return   $this->redirect("/site/index");        

        }
        $model = new Pessoa();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idpessoa Idpessoa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idpessoa)
    {
        if (! User::getUsuarioLogado()->pessoa->admin && $idpessoa != User::getUsuarioLogado()->id){
            FormHelper::msgAlerta("Somente administradores podem acessar.");
            return   $this->redirect("/pessoa/index");        

        }
        $model = $this->findModel($idpessoa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pessoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idpessoa Idpessoa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idpessoa)
    {
        if (! User::getUsuarioLogado()->pessoa->admin && $idpessoa){
            FormHelper::msgAlerta("Somente administradores podem acessar.");
            return   $this->redirect("/pessoa/index");        

        }
        $this->findModel($idpessoa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idpessoa Idpessoa
     * @return Pessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idpessoa)
    {
        if (($model = Pessoa::findOne(['idpessoa' => $idpessoa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
