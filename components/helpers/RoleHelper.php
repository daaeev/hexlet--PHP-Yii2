<?php

namespace app\components\helpers;

use app\components\helpers\interface\RoleHelperInterface;
use app\models\User;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use yii\helpers\ArrayHelper;
use yii\rbac\ManagerInterface;

/**
 * Класс-хелпер для роботы с ролями
 */
class RoleHelper implements RoleHelperInterface
{
    /**
     * @param ManagerInterface|MockObject $authManager
     */
    public function __construct(protected ManagerInterface|MockObject $authManager)
    {
    }

    public function getRoles(): array
    {
        return ArrayHelper::map($this->authManager->roles, 'name', 'name');
    }

    public function assignRole(string $role_name, int $user_id): bool
    {
        $auth = $this->authManager;

        if (!$auth->revokeAll($user_id)) {
            throw new Exception('Удаление имеющихся ролей пользователя прошло неудачно');
        }
        
        $role = $auth->getRole($role_name);

        if (!$role) {
            throw new Exception('Роль с названием ' . $role_name . ' не найдена');
        }

        try {
            $auth->assign($role, $user_id);
        } catch (\Exception) {
            throw new Exception('Присвоение роли прошло неудачно');
        }

        return true;
    }

    public function setUserStatus(User $user, string $role_name): bool
    {
        $user->status = $this->getStatusByRole($role_name);

        if (!$user->save()) {
            throw new Exception('Присвоение статуса прошло неудачно');
        }

        return true;
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

    public function getAuthManager()
    {
        return $this->authManager;
    }
}