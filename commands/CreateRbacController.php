<?php

namespace app\commands;

use app\models\User;
use app\rules\AdminPanelRule;
use app\rules\AssignmentRule;
use app\rules\ModerationRule;
use Yii;
use yii\console\Controller;

class CreateRbacController extends Controller
{
    /**
     * Метод отвечает за создание ролей пользователей
     * @return void
     * @throws Exception если проверка данных или сохранение 
     * не удается (например, имя роли или разрешения не уникальны)
     */
    public function actionCreateRoles()
    {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $user->description = 'Обычный пользователь сайта. Статус - 0';
        $auth->add($user);
        
        $admin = $auth->createRole('admin');
        $admin->description = 'Админ - Задаёт роли другим пользователям. Статус - 1';
        $auth->add($admin);

        $moderator = $auth->createRole('moderator');
        $moderator->description = 'Модератор - проверяет корректность заданных вопросов. Статус - 2';
        $auth->add($moderator);

        $banned = $auth->createRole('banned');
        $banned->description = 'Забаненый пользователь. Статус - 3';
        $auth->add($banned);
    }

    /**
     * Метод отвечает за создание разрешений
     * @return void
     * @throws Exception если проверка данных или сохранение 
     * не удается (например, имя роли или разрешения не уникальны)
     */
    public function actionCreatePermissions()
    {
        $auth = Yii::$app->authManager;

        $adminPanelRule = new AdminPanelRule();
        $auth->add($adminPanelRule);

        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Доступ к админ панели';
        $adminPanel->ruleName = $adminPanelRule->name;
        $auth->add($adminPanel);


        $assignmentRule = new AssignmentRule();
        $auth->add($assignmentRule);

        $assignment = $auth->createPermission('assignment');
        $assignment->description = 'Возможность присваивания ролей пользователям';
        $assignment->ruleName = $assignmentRule->name;
        $auth->add($assignment);


        $questionRule = new ModerationRule();
        $auth->add($questionRule);

        $moderation = $auth->createPermission('moderation');
        $moderation->description = 'Возможность подтверждать корректность резюме\вакансий';
        $moderation->ruleName = $questionRule->name;
        $auth->add($moderation);
    }

    /**
     * Метод отвечает за присваивание роли соответствующего ей разрешения
     * @return void
     * @throws \yii\base\Exception если отношения родитель-потомок уже существуют или обнаружена петля.
     */
    public function actionCreateChildrens()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->getRole('admin');
        $moderator = $auth->getRole('moderator');

        $adminPanel = $auth->getPermission('adminPanel');
        $assignment = $auth->getPermission('assignment');
        $moderation = $auth->getPermission('moderation');

        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $adminPanel);
        $auth->addChild($moderator, $adminPanel);
        $auth->addChild($admin, $assignment);
        $auth->addChild($moderator, $moderation);
    }

    /**
     * Метод отвечает за присваивание пользователю с id = $id
     * роли администратора
     * @param int $id идентификатор пользователя
     * @return void
     * @throws \Exception если роль уже назначена пользователю
     */
    public function actionAssignAdmin($id)
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        
        $user = User::findOne($id);
        $user->status = 1;
        $user->save();

        $auth->assign($admin, $id);
    }
}