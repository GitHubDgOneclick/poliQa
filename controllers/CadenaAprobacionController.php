<?php

namespace app\controllers;

use Yii;
use app\models\CadenaAprobacion;
use app\models\CadenaAprobacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\assets\AppAccessRule;
use yii\filters\AccessControl;

/**
 * CadenaAprobacionController implements the CRUD actions for CadenaAprobacion model.
 */
class CadenaAprobacionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AppAccessRule::className(),
                ],
                'only' => [ 'index' , 'view' , 'create' , 'update' , 'change-active' , 'change-no-active' , 'delete' ],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','change-active','change-no-active','delete'],
                        'allow' => true,
                        'roles' => ["?"],
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all CadenaAprobacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CadenaAprobacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new CadenaAprobacion();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single CadenaAprobacion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CadenaAprobacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CadenaAprobacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['eslabon-aprobacion/index', 'cadena' => $model->codigo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CadenaAprobacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->codigo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * cabia el estado a activo .
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionChangeActive( $id  )
    {
        $model = $this->findModel($id);
        $model->estado = CadenaAprobacion::ESTADO_ACTIVO;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * cambia e estado a no activo .
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChangeNoActive( $id )
    {
        $model = $this->findModel($id);
        $model->estado = CadenaAprobacion::ESTADO_INACTIVO;
        $model->save();
        return $this->redirect(['index']);
    }


    /**
     * Deletes an existing CadenaAprobacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CadenaAprobacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CadenaAprobacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CadenaAprobacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
