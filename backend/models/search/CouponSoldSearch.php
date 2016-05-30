<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CouponSold;

/**
 * CouponSoldSearch represents the model behind the search form about `backend\models\CouponSold`.
 */
class CouponSoldSearch extends CouponSold
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'coupon_pack_id', 'sold_count', 'trip_count', 'sold_at'], 'integer'],
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
        $query = CouponSold::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'coupon_pack_id' => $this->coupon_pack_id,
            'sold_count' => $this->sold_count,
            'trip_count' => $this->trip_count,
            'sold_at' => $this->sold_at,
        ]);

        return $dataProvider;
    }
}
