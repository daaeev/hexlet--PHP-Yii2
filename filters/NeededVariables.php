<?php

namespace app\filters;

use yii\base\ActionFilter;
use Yii;

/**
 * Фильтр, для получения данных из бд, которые нужны во всех экшенах
 */
class NeededVariables extends ActionFilter
{
    public function beforeAction($action)
    {
        Yii::$app->view->params['user'] = Yii::$app->user->getIdentity();

        return parent::beforeAction($action);
    }
}