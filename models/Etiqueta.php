<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiqueta".
 *
 * @property integer $codigo
 * @property string $valor
 * @property integer $tipo
 *
 * @property EtiquetaEntrada[] $etiquetaEntradas
 */
class Etiqueta extends \yii\db\ActiveRecord
{
    const TIPO_CATEGORIA = 1; 
    const TIPO_PALABRA_CLAVE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etiqueta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor'], 'required'],
            [['tipo'], 'integer'],
            [['valor'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'valor' => 'Valor',
            'tipo' => 'Tipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEtiquetaEntradas()
    {
        return $this->hasMany(EtiquetaEntrada::className(), ['etiqueta' => 'codigo']);
    }
}
