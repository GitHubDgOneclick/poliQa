<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol".
 *
 * @property integer $codigo
 * @property string $nombre
 * @property integer $estado
 *
 * @property Usuario[] $usuarios
 */
class Rol extends \yii\db\ActiveRecord
{

    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    const ROL_ADMINISTRADOR = 1;
    const ROL_EDITOR = 0;
    const ROL_USUARIO = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['estado'], 'integer'], 
            [['nombre'], 'string', 'max' => 45],
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
            'estado' => 'Estado', 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['rol' => 'codigo']);
    }

    public static function all()
    {
        return Rol::find()->where(['estado'=> Rol::ESTADO_ACTIVO ])->all();
    }
}
