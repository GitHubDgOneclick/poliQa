<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Entrada;

/**
 * EntradaSearch represents the model behind the search form about `app\models\Entrada`.
 */
class EntradaSearch extends Entrada
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'estado', 'tipo', 'usuario', 'entrada'], 'integer'],
            [['pregunta', 'respuesta', 'fecha_inicial', 'fecha_final'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Entrada::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'codigo' => $this->codigo,
            'fecha_inicial' => $this->fecha_inicial,
            'fecha_final' => $this->fecha_final,
            'estado' => $this->estado,
            'tipo' => $this->tipo,
            'usuario' => $this->usuario,
            'entrada' => $this->entrada,
        ]);

        $query->andFilterWhere(['like', 'pregunta', $this->pregunta])
            ->andFilterWhere(['like', 'respuesta', $this->respuesta]);

        return $dataProvider;
    }
}
