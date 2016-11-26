<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiqueta_entrada".
 *
 * @property integer $codigo
 * @property integer $entrada
 * @property integer $etiqueta
 *
 * @property Entrada $entrada0
 * @property Etiqueta $etiqueta0
 */
class EtiquetaEntrada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'etiqueta_entrada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entrada', 'etiqueta'], 'required'],
            [['entrada', 'etiqueta'], 'integer'],
            [['entrada'], 'exist', 'skipOnError' => true, 'targetClass' => Entrada::className(), 'targetAttribute' => ['entrada' => 'codigo']],
            [['etiqueta'], 'exist', 'skipOnError' => true, 'targetClass' => Etiqueta::className(), 'targetAttribute' => ['etiqueta' => 'codigo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'codigo' => 'Codigo',
            'entrada' => 'Entrada',
            'etiqueta' => 'Etiqueta',
        ];
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
    public function getEtiqueta0()
    {
        return $this->hasOne(Etiqueta::className(), ['codigo' => 'etiqueta']);
    }
}
