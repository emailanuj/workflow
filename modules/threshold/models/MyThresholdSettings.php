<?php

namespace app\modules\threshold\models;

use Yii;
// use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\threshold\models\ThresholdSettings;
use yii\helpers\ArrayHelper;

/**
 * MyThresholdSettings represents the model behind the search form about `app\models\ThresholdSettings`.
 */
class MyThresholdSettings extends ThresholdSettings
{

    public static function getThresholdDropDown()
    {
        $staticKpiList = ThresholdSettings::ThresholdList();
        $dbKpiList = self::getThresholdList();

        $result = array_diff($staticKpiList, $dbKpiList);
        $final_result = array_combine($result, $result);
        return $final_result;
    }

    public static function getThresholdList(){
        $objLabels = self::find()->all();
        return ArrayHelper::map($objLabels,'threshold_name','threshold_name');
    }
    /**
     * @inheritdoc
     */
   
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ThresholdSettings::find();

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
            'is_deleted' => $this->is_deleted,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'threshold_name', $this->threshold_name])
            ->andFilterWhere(['like', 'threshold_condition', $this->threshold_condition])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
