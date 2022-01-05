<?php

namespace app\components\helpers\interface;

use app\models\User;

interface RoleHelperInterface
{
    /**
     * Метод возвращает список всех имеющихся ролей
     * @return array
     */
    public function getRoles(): array;

    /**
     * Присваивание роли пользователю с заданым id
     * @param string $role_name
     * @param int $user_id
     * @return null
     * @throws \Exception если присвоение пройдет неуспешно
     */
    public function assignRole(string $role_name, int $user_id);

    /**
     * Изменение статуса пользователя в бд, исходя из роли
     * @param User $user
     * @param string $role_name
     * @return null
     * @throws \Exception если валидация статуса пройдет неуспешно
     */
    public function setUserStatus(User $user, string $role_name);
}