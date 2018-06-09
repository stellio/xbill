<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CouponPackExtended;

/**
 * CouponPackSearch represents the model behind the search form about `backend\models\CouponPack`.
 */
class CouponPackExtendedSearch extends CouponPackExtended
{
    public $group;
    public $name;
    public $lastname;
    public $firstname;
    public $middlename;
    public $phone;
    public $contractorCity;
    public $address;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contractor_id', 'created_at', 'updated_at', 'number_from', 'number_to', 'sold_total', 'trip_total', 'status', 'type_id', 'object_id', 'issued_at'], 'integer'],
            [['group', 'name', 'lastname', 'firstname', 'middlename', 'phone', 'city', 'address'], 'safe'],
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
        $query = CouponPackExtended::find();

        $query->joinWith(['contractor', 'contractorGroup', 'city']);
        // $query->joinWith('contractor_group', true, 'INNER JOIN');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['group'] = [
            'asc' => ['contractor_group.name' => SORT_ASC],
            'desc' => ['contractor_group.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['name'] = [
            'asc' => ['contractor.name' => SORT_ASC],
            'desc' => ['contractor.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['lastname'] = [
            'asc' => ['contractor.lastname' => SORT_ASC],
            'desc' => ['contractor.lastname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['firstname'] = [
            'asc' => ['contractor.firstname' => SORT_ASC],
            'desc' => ['contractor.firstname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['middlename'] = [
            'asc' => ['contractor.middlename' => SORT_ASC],
            'desc' => ['contractor.middlename' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['phone'] = [
            'asc' => ['contractor.phone' => SORT_ASC],
            'desc' => ['contractor.phone' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['contractorCity'] = [
            'asc' => ['city.name' => SORT_ASC],
            'desc' => ['city.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['address'] = [
            'asc' => ['contractor.address' => SORT_ASC],
            'desc' => ['contractor.address' => SORT_DESC],
        ];

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
            'object_id' => $this->object_id,
            'issued_at' => $this->issued_at,
        ])
        ->andFilterWhere(['like', 'contractor_group.name', $this->group])
        ->andFilterWhere(['like', 'contractor.name', $this->name])
        ->andFilterWhere(['like', 'contractor.lastname', $this->lastname])
        ->andFilterWhere(['like', 'contractor.firstname', $this->firstname])
        ->andFilterWhere(['like', 'contractor.middlename', $this->middlename])
        ->andFilterWhere(['like', 'contractor.phone', $this->phone])
        ->andFilterWhere(['like', 'city.name', $this->contractorCity])
        ->andFilterWhere(['like', 'contractor.address', $this->address])
        ;


        return $dataProvider;
    }
}
