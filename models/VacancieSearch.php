<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacancie;

/**
 * VacancieSearch represents the model behind the search form of `app\models\Vacancie`.
 */
class VacancieSearch extends Vacancie
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'money_from', 'money_to', 'pub_date', 'status'], 'integer'],
            [['level', 'money', 'type_of_place', 'type_of_work', 'currency', 'position', 'city', 'address', 'company', 'company_site', 'contact_name', 'contact_number', 'contact_email', 'experience', 'about_company', 'about_project', 'duties', 'requirements', 'conditions', 'technologies'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Vacancie::find();

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
            'id' => $this->id,
            'money_from' => $this->money_from,
            'money_to' => $this->money_to,
            'pub_date' => $this->pub_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'money', $this->money])
            ->andFilterWhere(['like', 'type_of_place', $this->type_of_place])
            ->andFilterWhere(['like', 'type_of_work', $this->type_of_work])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'company_site', $this->company_site])
            ->andFilterWhere(['like', 'contact_name', $this->contact_name])
            ->andFilterWhere(['like', 'contact_number', $this->contact_number])
            ->andFilterWhere(['like', 'contact_email', $this->contact_email])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'about_company', $this->about_company])
            ->andFilterWhere(['like', 'about_project', $this->about_project])
            ->andFilterWhere(['like', 'duties', $this->duties])
            ->andFilterWhere(['like', 'requirements', $this->requirements])
            ->andFilterWhere(['like', 'conditions', $this->conditions])
            ->andFilterWhere(['like', 'technologies', $this->technologies]);

        return $dataProvider;
    }
}
