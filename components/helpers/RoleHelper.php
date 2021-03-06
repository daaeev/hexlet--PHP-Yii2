<?php

namespace app\components\helpers;

use app\components\helpers\interface\RoleHelperInterface;
use app\exceptions\DBDataDeleteException;
use app\exceptions\DBDataSaveException;
use app\exceptions\UndefinedRoleException;
use app\models\User;
use PHPUnit\Framework\MockObject\MockObject;
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
    public function __construct(protected $authManager)
    {
    }

    public function getRoles(): array
    {
        return ArrayHelper::map($this->authManager->roles, 'name', 'name');
    }

    public function assignRole(string $role_name, int $user_id): bool
    {
        $auth = $this->getAuthManager();

        if (!$auth->revokeAll($user_id)) {
            throw new DBDataDeleteException('Удаление имеющихся ролей пользователя прошло неудачно');
        }
        
        $role = $auth->getRole($role_name);

        if (!$role) {
            throw new UndefinedRoleException('Роль с названием ' . $role_name . ' не найдена');
        }

        try {
            $auth->assign($role, $user_id);
        } catch (\Exception) {
            throw new DBDataSaveException('Присвоение роли прошло неудачно');
        }

        return true;
    }

    public function setUserStatus($user, string $role_name): bool
    {
        $user->status = $this->getStatusByRole($role_name);

        if (!$user->save()) {
            throw new DBDataSaveException('Присвоение статуса прошло неудачно');
        }

        return true;
    }

    /**
     * Возвращает номер статуса определенной роли
     * @param string $role_name
     * @return int status
     * @throws UndefinedRoleException если роль не существует
     */
    protected function getStatusByRole(string $role_name): int
    {
        switch ($role_name) {
            case 'user':
                return User::STATUS_USER;
            case 'admin':
                return User::STATUS_ADMIN;
            case 'moderator':
                return User::STATUS_MODERATOR;
            case 'banned':
                return User::STATUS_BANNED;
            default:
                throw new UndefinedRoleException('Роль ' . $role_name . ' не существует');
        }
    }

    public function getAuthManager()
    {
        return $this->authManager;
    }
}