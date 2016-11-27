<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrada".
 *
 * @property integer $codigo
 * @property string $pregunta
 * @property string $respuesta
 * @property string $fecha_inicial
 * @property string $fecha_final
 * @property integer $estado
 * @property integer $tipo
 * @property string $usuario
 * @property integer $entrada
 *
 * @property Aprobaciones[] $aprobaciones
 * @property Entrada $entrada0
 * @property Entrada[] $entradas
 * @property Usuario $usuario0
 * @property EtiquetaEntrada[] $etiquetaEntradas
 */
class Entrada extends \yii\db\ActiveRecord
{
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    const TIPO_PREGUNTA = 1; 
    const TIPO_COMENTARIO = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pregunta', 'respuesta', 'fecha_inicial', 'fecha_final', 'estado', 'tipo', 'usuario', 'entrada'], 'required'],
            [['respuesta'], 'string'],
            [['fecha_inicial', 'fecha_final'], 'safe'],
            [['estado', 'tipo', 'usuario', 'entrada'], 'integer'],
            [['pregunta'], 'string', 'max' => 45],
            [['entrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entrada::className(), 'targetAttribute' => ['entrada' => 'codigo']],
            [['usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'pregunta' => 'Pregunta',
            'respuesta' => 'Respuesta',
            'fecha_inicial' => 'Fecha Inicial',
            'fecha_final' => 'Fecha Final',
            'estado' => 'Estado',
            'tipo' => 'Tipo',
            'usuario' => 'Usuario',
            'entrada' => 'Entrada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprobaciones()
    {
        return $this->hasMany(Aprobaciones::className(), ['entrada' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrada0()
    {
        return $this->hasOne(Entrada::className(), ['codigo' => 'entrada']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntradas()
    {
        return $this->hasMany(Entrada::className(), ['entrada' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiquetaEntradas()
    {
        return $this->hasMany(EtiquetaEntrada::className(), ['entrada' => 'codigo']);
    }
}
