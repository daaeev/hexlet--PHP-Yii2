<?php

namespace app\components\helpers;

use app\components\helpers\interface\RoleHelperInterface;
use app\models\User;
use Exception;
use yii\helpers\ArrayHelper;
use yii\rbac\ManagerInterface;

/**
 * Класс-хелпер для роботы с ролями
 */
class RoleHelper implements RoleHelperInterface
{
    /**
     * @param ManagerInterface $authManager
     */
    public function __construct(protected ManagerInterface $authManager)
    {
    }

    public function getRoles(): array
    {
        return ArrayHelper::map($this->authManager->roles, 'name', 'name');
    }

    public function assignRole(string $role_name, int $user_id)
    {
        $auth = $this->authManager;

        $auth->revokeAll($user_id);
        $role = $auth->getRole($role_name);

        try {
            $auth->assign($role, $user_id);
        } catch (\Exception) {
            throw new Exception('Присвоение роли прошло неудачно');
        }
    }

    public function setUserStatus(User $user, string $role_name)
    {
        $user->status = $this->getStatusByRole($role_name);
        if (!$user->save()) {
            throw new Exception('Присвоение статуса прошло неудачно');
        }
    }

    /**
     * Возвращает номер статуса определенной роли
     * @param string $role_name
     * @return int status
     * @throws \Exception если роль не существует
     */
    protected function getStatusByRole(string $role_name): int
    {
        switch ($role_name) {
            case 'user':
                return 0;
            case 'admin':
                return 1;
            case 'moderator':
                return 2;
            case 'banned':
                return 3;
            default:
                throw new Exception('Роль ' . $role_name . ' не существует');
        }
    }
}