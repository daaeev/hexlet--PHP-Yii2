<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resume;

/**
 * ResumeSearch represents the model behind the search form of `app\models\Resume`.
 */
class ResumeSearch extends Resume
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pub_date', 'author_id', 'views', 'status'], 'integer'],
            [['title', 'english', 'github', 'contact', 'description', 'skills', 'achievements'], 'safe'],
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
        $query = Resume::find();

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
            'pub_date' => $this->pub_date,
            'author_id' => $this->author_id,
            'views' => $this->views,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'english', $this->english])
            ->andFilterWhere(['like', 'github', $this->github])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'skills', $this->skills])
            ->andFilterWhere(['like', 'achievements', $this->achievements]);

        return $dataProvider;
    }
}
