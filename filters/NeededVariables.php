<?php

namespace app\filters;

use app\components\helpers\interface\DBValidatorInterface;
use app\models\Comment;
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

        if (!Yii::$app->user->isGuest) {
            $helper = Yii::$container->get(DBValidatorInterface::class);
            Yii::$app->view->params['have_notification'] = $helper->userHaveNotification(Yii::$app->view->params['user']->id);
        }

        /**
         * 20 последних ответов
         * @var array $sidebar_elements
         */
        $sidebar_elements = Comment::find()
            ->with('resume', 'author')
            ->where(['parent_comment_id' => null])
            ->limit(20)
            ->orderBy('id DESC')
            ->all();

        Yii::$app->view->params['sidebar_elements'] = $sidebar_elements;

        return parent::beforeAction($action);
    }
}