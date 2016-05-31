<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CouponPack;

/**
 * CouponPackSearch represents the model behind the search form about `backend\models\CouponPack`.
 */
class CouponPackSearch extends CouponPack
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contractor_id', 'created_at', 'updated_at', 'number_from', 'number_to', 'sold_total', 'trip_total', 'status', 'type_id', 'issued_at'], 'integer'],
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
        $query = CouponPack::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'contractor_id' => $this->contractor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'number_from' => $this->number_from,
            'number_to' => $this->number_to,
            'sold_total' => $this->sold_total,
            'trip_total' => $this->trip_total,
            'status' => $this->status,
            'type_id' => $this->type_id,
            'issued_at' => $this->issued_at,
        ]);

        return $dataProvider;
    }
}
