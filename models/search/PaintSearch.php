<?php

namespace app\models\search;

use app\models\Paint;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * PaintSearch represents the model behind the search form about `app\models\Paint`
 */
class PaintSearch extends Paint
{

    public $colorGroup;
    public $isMetallic = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['type', 'colorGroup'], 'integer'],
            [['isMetallic'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'colorGroup' => Yii::t('app/paints', 'Color group'),
                'isMetallic'   => Yii::t('app/paints', 'Metallic')
            ]);
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
        $query = Paint::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->isMetallic == 2) {
            $query->andFilterWhere(['is_metal' => true]);
        } elseif ($this->isMetallic == 1) {
            $query->andFilterWhere(['is_metal' => false]);
        }

        // grid filtering conditions
        $query->andFilterWhere(['type' => $this->type ])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
