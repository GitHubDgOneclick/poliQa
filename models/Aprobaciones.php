<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aprobaciones".
 *
 * @property integer $codigo
 * @property integer $estado
 * @property string $comentario
 * @property integer $eslabon_aprobacion
 * @property integer $entrada
 *
 * @property EslabonAprobacion $eslabonAprobacion
 * @property Entrada $entrada0
 */
class Aprobaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aprobaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'comentario', 'eslabon_aprobacion', 'entrada'], 'required'],
            [['estado', 'eslabon_aprobacion', 'entrada'], 'integer'],
            [['comentario'], 'string', 'max' => 45],
            [['eslabon_aprobacion'], 'exist', 'skipOnError' => true, 'targetClass' => EslabonAprobacion::className(), 'targetAttribute' => ['eslabon_aprobacion' => 'codigo']],
            [['entrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entrada::className(), 'targetAttribute' => ['entrada' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'estado' => 'Estado',
            'comentario' => 'Comentario',
            'eslabon_aprobacion' => 'Eslabon Aprobacion',
            'entrada' => 'Entrada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEslabonAprobacion()
    {
        return $this->hasOne(EslabonAprobacion::className(), ['codigo' => 'eslabon_aprobacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntrada0()
    {
        return $this->hasOne(Entrada::className(), ['codigo' => 'entrada']);
    }
}
