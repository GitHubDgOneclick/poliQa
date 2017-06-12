<?php

namespace app\controllers;

use Yii;
use app\assets\AppHandlingErrors;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\Entrada;
use app\models\EntradaSearch;
use app\models\Etiqueta;
use app\models\EtiquetaEntrada;
use app\models\CadenaAprobacion;
use app\models\Aprobaciones;
use vova07\imperavi\actions\GetAction;
use app\assets\AppDate;
use app\assets\AppAccessRule;
use yii\filters\AccessControl;

/**
 * EntradaController implements the CRUD actions for Entrada model.
 */
class EntradaController extends Controller
{
    #pathImagenes
    #pathArchivos
    // DefaultController.php
    public function actions()
    {
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                #'url' => 'http://localhost:81/PoliQa/poliQa/web/img/', // Directory URL address, where files are stored.
                'url' => Yii::getAlias('@pathUrlAplication').'/img/', // Directory URL address, where files are stored.
                'path' => '@pathImagenes', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_IMAGES,
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                #'url' => 'http://localhost:81/PoliQa/poliQa/web/files/', // Directory URL address, where files are stored.
                'url' => Yii::getAlias('@pathUrlAplication').'/files/', // Directory URL address, where files are stored.
                'path' => '@pathArchivos', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_FILES,
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                #'url' => 'http://localhost:81/PoliQa/poliQa/web/img/', // Directory URL address, where files are stored.
                'url' => Yii::getAlias('@pathUrlAplication').'/img/', // Directory URL address, where files are stored.
                'path' => '@pathImagenes', // Or absolute path to directory where files are stored.
            ],
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                #'url' => 'http://localhost:81/PoliQa/poliQa/web/files/', // Directory URL address, where files are stored.
                'url' => Yii::getAlias('@pathUrlAplication').'/files/', // Directory URL address, where files are stored.
                'path' => '@pathArchivos', // Or absolute path to directory where files are stored.
                'uploadOnlyImage' => false, // For not image-only uploading.
            ],
        ];
    }

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
                'only' => ['index','view','create','comment','update','delete','approvelink','disapprovelink'],
                'rules' => [
                    [
                        'actions' => ['index','create','comment','update','delete','approvelink','disapprovelink'],
                        'allow' => true,
                        'roles' => ["?"],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ["@"],
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Entrada models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntradaSearch();
        #$searchModel->fecha_inicial = AppDate::date();
        #$searchModel->fecha_final = AppDate::date();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entrada model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id , $titulo = null , $comentario = null )
    {
        $mComentario = new Entrada();
        if (!Yii::$app->user->isGuest){
            $mComentario->estado = Entrada::ESTADO_ACTIVO;
            $mComentario->tipo = Entrada::TIPO_COMENTARIO;
            $mComentario->usuario = Yii::$app->user->identity->codigo;
            $mComentario->pregunta = 'lorem';
            $mComentario->descripcion_listado = 'lorem';
            $mComentario->fecha_inicial =  AppDate::date();
            $mComentario->fecha_final = AppDate::date();
            $mComentario->categorias = 'comentario';
            $mComentario->palabrasClave = 'comentario';
            $mComentario->cadenaAprobacion = 1;
            if ($titulo != null) {
                $mComentario->titulo_listado = $titulo;
            }
            if ($comentario != null) {
                $mComentario->respuesta = $comentario;
            }
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'mComentario' => $mComentario,
        ]);
    }

    /**
     * Creates a new Entrada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entrada();
        $model->estado = Entrada::ESTADO_INACTIVO;
        $model->tipo = Entrada::TIPO_PREGUNTA;
        $model->usuario = Yii::$app->user->identity->codigo;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if ( $this->generarEtiquetas( $model , Etiqueta::TIPO_CATEGORIA ) && $this->generarEtiquetas( $model , Etiqueta::TIPO_PALABRA_CLAVE ) ) {
                    if ( $this->generarAprobaciones( $model ) ) {
                        $transaction->commit();
                        return $this->redirect( [ 'view', 'id' => $model->codigo ] );
                    } else {
                        $transaction->rollBack();
                        AppHandlingErrors::setFlash( 'danger' , 'Problemas generando las aprobaciones' );
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                    #$this->retornarAprobaciones( $model );
                    #$this->eliminarAprobaciones( $model );
                } else {
                    $transaction->rollBack();
                    AppHandlingErrors::setFlash( 'danger' , 'Problemas generando las etiquetas' );
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }            
        } catch (Exception $e) {
            $transaction->rollBack();
            AppHandlingErrors::setFlash( 'danger' ,  $e->message );
        }
    }

    public function actionComment()
    {
        $model = new Entrada();
        $model->tipo = Entrada::TIPO_COMENTARIO;
        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            AppHandlingErrors::setFlash( 'success' ,  'Gracias por comentar' );
            return $this->redirect( [ 'view', 'id' => $model->entrada ] );
        } else {

            AppHandlingErrors::setFlash( 'danger' ,  'Problemas para comentar, Intentalo mas tarde.' );
            AppHandlingErrors::setFlash( 'warning' ,  json_encode( $model->getErrors() )  );
            return $this->redirect( [ 'view', 'id' => $model->entrada, 'titulo' => $model->titulo_listado , 'comentario'=> $model->descripcion_listado ] );
        }
    }

    /**
     * Updates an existing Entrada model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categorias = [];
        $palabrasClave = [];
        if ( isset( $model->etiquetaEntradas ) && count( $model->etiquetaEntradas ) ) {
            foreach ( $model->etiquetaEntradas as $key => $etiquetaEntrada ) {
                if ( $etiquetaEntrada->etiqueta0->tipo == Etiqueta::TIPO_CATEGORIA ) {
                    array_push( $categorias , $etiquetaEntrada->etiqueta0->valor );
                } else if ( $etiquetaEntrada->etiqueta0->tipo == Etiqueta::TIPO_PALABRA_CLAVE ) {
                    array_push( $palabrasClave , $etiquetaEntrada->etiqueta0->valor );
                }
            }
        }
        $cadenaAprobacion = 0;
        if ( isset( $model->aprobaciones ) && count( $model->aprobaciones ) ) {
            $cadenaAprobacion = $model->aprobaciones[0]->eslabonAprobacion->cadena_aprobacion;
        }
        
        $model->categorias = implode( ",", $categorias );
        $model->palabrasClave = implode( ",", $palabrasClave );
        $model->cadenaAprobacion = $cadenaAprobacion;
        
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $oldModel = $model;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if ( $this->generarEtiquetas( $model , Etiqueta::TIPO_CATEGORIA ) && $this->generarEtiquetas( $model , Etiqueta::TIPO_PALABRA_CLAVE ) ) {
                    if ( isset( $model->aprobaciones ) && count( $model->aprobaciones ) > 0 ) {
                        if ( $model->cadenaAprobacion != $model->aprobaciones[0]->eslabonAprobacion->cadena_aprobacion ) {
                            if ( $this->eliminarAprobaciones( $model ) ) {
                                if ( !$this->generarAprobaciones( $model ) ) {
                                    $transaction->rollBack();
                                    AppHandlingErrors::setFlash( 'danger' , 'Problemas generando las aprobaciones(2)' );
                                    return $this->render('update', [
                                        'model' => $model,
                                    ]);
                                } 
                            } else {
                                $transaction->rollBack();
                                AppHandlingErrors::setFlash( 'danger' , 'Problemas eliminando las aprobaciones' );
                                return $this->render('update', [
                                    'model' => $model,
                                ]);
                            }
                        } else if( $model->titulo_listado != $oldModel->titulo_listado ||
                            $model->descripcion_listado != $oldModel->descripcion_listado ||
                            $model->pregunta != $oldModel->pregunta ||
                            $model->respuesta != $oldModel->respuesta ||
                            $model->fecha_inicial != $oldModel->fecha_inicial ||
                            $model->fecha_final != $oldModel->fecha_final ) {
                            if ( !$this->retornarAprobaciones( $model ) ) {
                                $transaction->rollBack();
                                AppHandlingErrors::setFlash( 'danger' , 'Problemas generando las aprobaciones(3)' );
                                return $this->render('update', [
                                    'model' => $model,
                                ]);
                            }
                        }
                    } else {
                        if ( !$this->generarAprobaciones( $model ) ) {
                            $transaction->rollBack();
                            AppHandlingErrors::setFlash( 'danger' , 'Problemas generando las aprobaciones(1)' );
                            return $this->render('update', [
                                'model' => $model,
                            ]);
                        } 
                    }
                    $transaction->commit();
                    return $this->redirect( [ 'view', 'id' => $model->codigo ] );
                } else {
                    $transaction->rollBack();
                    AppHandlingErrors::setFlash( 'danger' , 'Problemas generando las etiquetas' );
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            AppHandlingErrors::setFlash( 'danger' ,  $e->message );
        }
    }

    /**
     * Deletes an existing Entrada model.
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
     * aprobar eslabon
     * 
     * @param integer $id
     * @return mixed
     */
    public function actionApproveLink($id)
    {
        $mAprobacion = Aprobaciones::findOne( $id );
        $mAprobacion->estado = Aprobaciones::ESTADO_APROVADO;
        $mAprobacion->save();
        $bPublicarPregunta = true;
        $mEntrada = null;
        if ( isset( $mAprobacion->entrada0 ) ) {
            $mEntrada = $mAprobacion->entrada0;
            if ( isset( $mEntrada->aprobaciones ) && count( $mEntrada->aprobaciones ) > 0 ) {
                foreach ( $mEntrada->aprobaciones as $key => $aprobacion ) {
                    if (  $aprobacion->estado == Aprobaciones::ESTADO_APROVADO ) {
                    } else if ( $aprobacion->codigo == $mAprobacion->codigo ) {
                    } else if ( $aprobacion->estado == Aprobaciones::ESTADO_NO_APROVADO ) {
                        $bPublicarPregunta = false;
                    }
                }
            }
        }
        if ( $bPublicarPregunta ) {
            $mEntrada->estado = Entrada::ESTADO_ACTIVO;
            $mEntrada->categorias = 'xxx';
            $mEntrada->palabrasClave = 'xxx';
            $mEntrada->cadenaAprobacion = 'xxx';
            if ( !$mEntrada->save() ) {
                AppHandlingErrors::setFlash( 'danger' , json_encode( $mEntrada->getErrors() ) );
            }
        }
        return $this->redirect(['view', 'id' => $mAprobacion->entrada ]);
    }

    /**
     * Deletes an existing Entrada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDisapproveLink($id)
    {
        $mAprobacion = Aprobaciones::findOne( $id );
        $mAprobacion->estado = Aprobaciones::ESTADO_NO_APROVADO;
        $mAprobacion->save();
        $mEntrada = null;
        if ( isset( $mAprobacion->entrada0 ) ) {
            $mEntrada = $mAprobacion->entrada0;
            $mEntrada->estado = Entrada::ESTADO_INACTIVO;
            $mEntrada->categorias = 'xxx';
            $mEntrada->palabrasClave = 'xxx';
            $mEntrada->cadenaAprobacion = 'xxx';
            if ( !$mEntrada->save() ) {
                AppHandlingErrors::setFlash( 'danger' , json_encode( $mEntrada->getErrors() ) );
            }
        }
        return $this->redirect(['view', 'id' => $mAprobacion->entrada ]);
    }

    /**
     * Finds the Entrada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entrada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entrada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * gnenerar etiquetas.
     * se tomanlos parametros palabras clave y las categorias .
     * @param Entrada $entrada
     * @param integer $tipo
     * @return true|false
     */
    protected function generarEtiquetas( $entrada , $tipo)
    {
        $bResulrado = true;
        $etiquetas = [];
        if ( Etiqueta::TIPO_CATEGORIA == $tipo ) {
            $etiquetas = array_unique( array_map('trim', explode( ',' , strtoupper( $entrada->categorias ) ) ) );
        } else {
            $etiquetas = array_unique( array_map('trim', explode( ',' , strtoupper( $entrada->palabrasClave ) ) ) );
        }
        $arrayEtiquetas = ArrayHelper::map( Etiqueta::find()
            ->where([ 'tipo' => $tipo ])
            ->andWhere([ 'IN', 'valor', $etiquetas ])
            ->all() 
        , 'codigo', 'valor') ;
        $arrayEtiquetasEntradaEx = [];
        if ( isset( $entrada->etiquetaEntradas ) && count( $entrada->etiquetaEntradas ) > 0 ) {
            $arrayEtiquetasEntradaEx = ArrayHelper::map( $entrada->etiquetaEntradas , 'etiqueta', 'etiqueta0.valor') ;
            foreach ( $entrada->etiquetaEntradas as $key => $etiquetaEntrada ) {
                if ( $etiquetaEntrada->etiqueta0->tipo == $tipo && !array_key_exists( $etiquetaEntrada->etiqueta , $arrayEtiquetas ) ) {
                    $etiquetaEntrada->delete();
                }
            }
        }
        if ( count( $etiquetas ) > 0 ) {
            foreach ( $etiquetas as $key => $etiqueta ) {
                $codigoEtiqueta = 0;
                if ( $bResulrado ) {
                    if ( in_array( $etiqueta , $arrayEtiquetas ) ) {
                        $codigoEtiqueta = array_search( $etiqueta , $arrayEtiquetas );
                    } else {
                        $mEtitiqueta = new Etiqueta();
                        $mEtitiqueta->valor = $etiqueta;
                        $mEtitiqueta->tipo = $tipo;
                        if ( $mEtitiqueta->save() ) {
                            $codigoEtiqueta = $mEtitiqueta->codigo;
                        } else {
                            $bResulrado = false;
                        }
                    }
                    if ( !array_key_exists( $codigoEtiqueta , $arrayEtiquetasEntradaEx ) ) {
                        $mEtiquetaEntrada = new EtiquetaEntrada;
                        $mEtiquetaEntrada->entrada = $entrada->codigo;
                        $mEtiquetaEntrada->etiqueta = $codigoEtiqueta;
                        if ( !$mEtiquetaEntrada->save() ) {
                            $bResulrado = false;
                        }
                    }
                }
            }
        }
        return $bResulrado;
    }

    /**
     * generarAprobaciones.
     * se crean los registros de las aprobaciones correspondientes.
     * @param Entrada $entrada
     * @return true|false
     */
    protected function generarAprobaciones( $entrada ){
        $bResultado = true;
        $mCadenaAprobacion = CadenaAprobacion::findOne( $entrada->cadenaAprobacion );
        if ( isset( $mCadenaAprobacion->eslabonAprobacions ) && count( $mCadenaAprobacion->eslabonAprobacions ) ) {
            foreach ( $mCadenaAprobacion->eslabonAprobacions  as $key => $eslabon ) {
                if ( $bResultado ) {
                    $mAprobacion = new Aprobaciones();
                    $mAprobacion->estado = Aprobaciones::ESTADO_NO_APROVADO;
                    $mAprobacion->eslabon_aprobacion = $eslabon->codigo;
                    $mAprobacion->entrada = $entrada->codigo;
                    if ( !$mAprobacion->save() ) {
                        $bResultado = false;
                    }
                }
            }
        }
        return $bResultado;
    }

    /**
     * retornar.
     * cambia los estados de las aprobaciones actuales y elimina los comentarios.
     * @param Entrada $entrada
     * @return true|false
     */
    protected function retornarAprobaciones( $entrada ){
        $bResultado = true;
        if ( isset( $entrada->aprobaciones ) && count( $entrada->aprobaciones ) ) {
            foreach ( $entrada->aprobaciones  as $key => $aprobacion ) {
                if ( $bResultado ) {
                    $aprobacion->estado = Aprobaciones::ESTADO_NO_APROVADO;
                    $aprobacion->comentario = '';
                    if ( !$aprobacion->save() ) {
                        $bResultado = false;
                    }
                }
            }
        }
        return $bResultado;
    }

    /**
     * eliminarAprobaciones.
     * elimina las aprobaciones que corresponden.
     * @param Entrada $entrada
     * @return true|false
     */
    protected function eliminarAprobaciones( $entrada ){
        $bResultado = true;
        if ( isset( $entrada->aprobaciones ) && count( $entrada->aprobaciones ) ) {
            foreach ( $entrada->aprobaciones  as $key => $aprobacion ) {
                if ( $bResultado ) {
                    if ( !$aprobacion->delete() ) {
                        $bResultado = false;
                    }
                }
            }
        }
        return $bResultado;
    }

}
