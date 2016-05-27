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
            [['id', 'contractor_id', 'used_count', 'created_at', 'updated_at'], 'integer'],
            [['number_from', 'number_to'], 'safe'],
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
            'used_count' => $this->used_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'number_from', $this->number_from])
            ->andFilterWhere(['like', 'number_to', $this->number_to]);

        return $dataProvider;
    }
}
