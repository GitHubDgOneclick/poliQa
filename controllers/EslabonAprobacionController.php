<?php

namespace app\controllers;

use Yii;
use app\models\EslabonAprobacion;
use app\models\EslabonAprobacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EslabonAprobacionController implements the CRUD actions for EslabonAprobacion model.
 */
class EslabonAprobacionController extends Controller
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
        ];
    }

    /**
     * Lists all EslabonAprobacion models.
     * @return mixed
     */
    public function actionIndex( $cadena )
    {
        $searchModel = new EslabonAprobacionSearch();
        $searchModel->cadena_aprobacion = $cadena;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new EslabonAprobacion();
        $model->cadena_aprobacion = $cadena;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single EslabonAprobacion model.
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
     * Creates a new EslabonAprobacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EslabonAprobacion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'cadena' => $model->cadena_aprobacion]);
        } else {
            return $this->redirect(['index', 'cadena' => $model->cadena_aprobacion]);
        }
    }

    /**
     * Updates an existing EslabonAprobacion model.
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
     * Deletes an existing EslabonAprobacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $cadena = $model->cadena_aprobacion;
        $model->delete();
        return $this->redirect(['index', 'cadena' => $cadena]);
    }

    /**
     * Finds the EslabonAprobacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EslabonAprobacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EslabonAprobacion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
