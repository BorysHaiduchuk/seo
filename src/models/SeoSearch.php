<?php

namespace boryshaiduchuk\seo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\seo\models\Seo;

/**
 * SeoSearch represents the model behind the search form of `backend\modules\seo\models\Seo`.
 */
class SeoSearch extends Seo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'seo_rules_id', 'model_id', 're_generate'], 'integer'],
            [['table_name', 'og_image', 'redirect_301', 'meta_index'], 'safe'],
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
        $query = Seo::find();

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
            'seo_rules_id' => $this->seo_rules_id,
            'model_id' => $this->model_id,
            're_generate' => $this->re_generate,
        ]);

        $query->andFilterWhere(['like', 'table_name', $this->table_name])
            ->andFilterWhere(['like', 'og_image', $this->og_image])
            ->andFilterWhere(['like', 'redirect_301', $this->redirect_301])
            ->andFilterWhere(['like', 'meta_index', $this->meta_index]);

        return $dataProvider;
    }
}
