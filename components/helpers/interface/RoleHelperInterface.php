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
     * @return bool
     * @throws DBDataDeleteException если удаление ролей пользователя продёт неуспешно
     * @throws UndefinedRoleException если роль не будет найдена в бд
     * @throws DBDataSaveException если присвоение роли пройдёт неуспешно
     */
    public function assignRole(string $role_name, int $user_id): bool;

    /**
     * Изменение статуса пользователя в бд, исходя из роли
     * @param User $user
     * @param string $role_name
     * @return bool
     * @throws DBDataSaveException если валидация или сохранение статуса пройдёт неуспешно
     */
    public function setUserStatus($user, string $role_name): bool;

    /**
     * Метод для получения объекта authManager.
     * Создан для облегчения работы с 
     * мок-объектом при тестировании
     * @return ManagerInterface
     */
    public function getAuthManager();
}