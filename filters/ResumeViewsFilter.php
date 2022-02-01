<?php

namespace app\filters;

use app\components\helpers\interface\DBValidatorInterface;
use app\models\Resume;
use app\models\View;
use yii\base\ActionFilter;
use Yii;

class ResumeViewsFilter extends ActionFilter
{
    /**
     * Метод отвечает за прибавку количества просмотров резюме.
     * 
     * В первую очередь, проверяется авторизация пользователя.
     * После идёт проверка, просматривал ли пользователь данное резюме ранее.
     * 
     * Далее, с использование механизма транзакций,
     * обновляется счётчик views просмотренного резюме
     * и создаётся соответствующая запись в таблице views
     * @return bool должно ли действие продолжать выполняться
     * @throws Exception если есть какое-либо исключение во время транзакции
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return parent::beforeAction($action);
        }

        $validator = Yii::$container->get(DBValidatorInterface::class);
        $resume_id = Yii::$app->request->get('id');
        $user_id = Yii::$app->view->params['user']->id;

        if ($validator->resumeIsViewed($user_id, $resume_id)) {
            return parent::beforeAction($action);
        }

        View::getDb()->transaction(function($db) use ($resume_id, $user_id) {
            $resume = Resume::findOne($resume_id);

            $resume->updateCounters(['views' => 1]);

            $view = new View;
            $view->user_id = $user_id;
            $view->resume_id = $resume_id;
            $view->save();
        });
        
        return parent::beforeAction($action);
    }
}