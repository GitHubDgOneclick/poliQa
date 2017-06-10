<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Entrada;

/**
 * EntradaSearch represents the model behind the search form about `app\models\Entrada`.
 */
class EntradaSearch extends Entrada
{
    public $categorias;
    public $palabrasClave;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['codigo', 'estado', 'tipo', 'usuario', 'entrada'], 'integer'],
            [['titulo_listado', 'descripcion_listado', 'pregunta', 'respuesta', 'fecha_inicial', 'fecha_final' , 'categorias', 'palabrasClave'], 'safe'],
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

        $query = Entrada::find()->joinWith('etiquetaEntradas');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 30,
            ],
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
            #'fecha_inicial' => $this->fecha_inicial,
            #'fecha_final' => $this->fecha_final,
            'estado' => $this->estado,
            'tipo' => $this->tipo,
            'usuario' => $this->usuario,
            'entrada' => $this->entrada,
        ]);

        if ( isset( $this->fecha_inicial ) && trim( $this->fecha_inicial ) != '' ) {
            $query->andFilterWhere(['<=', 'fecha_inicial', $this->fecha_inicial]);
        }
        if ( isset( $this->fecha_final ) && trim( $this->fecha_final ) != '' ) {
            $query->andFilterWhere(['>=', 'fecha_final', $this->fecha_final]);
        }

        $query->andFilterWhere(['like', 'titulo_listado', $this->titulo_listado])
           ->andFilterWhere(['like', 'descripcion_listado', $this->descripcion_listado])
           ->andFilterWhere(['like', 'pregunta', $this->pregunta])
           ->andFilterWhere(['like', 'respuesta', $this->respuesta]);

        if ( isset( $this->categorias ) && trim( $this->categorias ) != '' ) {
            $categorias = array_unique( array_map('trim', explode( ',' , strtoupper( $this->categorias ) ) ) );
            $arrayCategorias = ArrayHelper::map( Etiqueta::find()
                ->where([ 'tipo' => Etiqueta::TIPO_CATEGORIA ])
                ->andWhere([ 'IN', 'valor', $categorias ])
                ->all() 
            , 'codigo', 'codigo') ;
            $query->andWhere( ['IN', 'etiqueta_entrada.etiqueta', $arrayCategorias ]);
        }
        if ( isset( $this->palabrasClave ) && trim( $this->palabrasClave ) != '' ) {
            $palabrasClave = array_unique( array_map('trim', explode( ',' , strtoupper( $this->palabrasClave ) ) ) );
            $arrayPalabrasClave = ArrayHelper::map( Etiqueta::find()
                ->where([ 'tipo' => Etiqueta::TIPO_PALABRA_CLAVE ])
                ->andWhere([ 'IN', 'valor', $palabrasClave ])
                ->all() 
            , 'codigo', 'codigo') ;
            $query->andWhere( ['IN', 'etiqueta_entrada.etiqueta', $arrayPalabrasClave ]);
        }
        return $dataProvider;
    }
}
