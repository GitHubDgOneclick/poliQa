<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eslabon_aprobacion".
 *
 * @property integer $codigo
 * @property string $nombre
 * @property integer $cadena_aprobacion
 * @property string $usuario
 *
 * @property Aprobaciones[] $aprobaciones
 * @property CadenaAprobacion $cadenaAprobacion
 * @property Usuario $usuario0
 */
class EslabonAprobacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eslabon_aprobacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'cadena_aprobacion', 'usuario'], 'required'],
            [['cadena_aprobacion', 'usuario'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['cadena_aprobacion'], 'exist', 'skipOnError' => true, 'targetClass' => CadenaAprobacion::className(), 'targetAttribute' => ['cadena_aprobacion' => 'codigo']],
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
            'nombre' => 'Nombre',
            'cadena_aprobacion' => 'Cadena Aprobacion',
            'usuario' => 'Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprobaciones()
    {
        return $this->hasMany(Aprobaciones::className(), ['eslabon_aprobacion' => 'codigo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCadenaAprobacion()
    {
        return $this->hasOne(CadenaAprobacion::className(), ['codigo' => 'cadena_aprobacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['codigo' => 'usuario']);
    }
}
