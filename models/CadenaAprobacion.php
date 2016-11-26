<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cadena_aprobacion".
 *
 * @property integer $codigo
 * @property string $nombre
 * @property integer $estado
 *
 * @property EslabonAprobacion[] $eslabonAprobacions
 */
class CadenaAprobacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cadena_aprobacion';
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
    public function getEslabonAprobacions()
    {
        return $this->hasMany(EslabonAprobacion::className(), ['cadena_aprobacion' => 'codigo']);
    }
}
