<?php

namespace app\components\helpers\interface;

use app\models\User;

interface UserGetInterface
{
    /**
     * Метод возвращает экземпляр модели User
     * со всеми нужными на странице 
     * site/profile связями (резюме, ответы...)
     * @param int $id идентификатор пользователя
     * @return User объект с данными пользователя
     * @throws IDNotFoundException если пользователь с id = $id не найден
     */
    public function getByIdWithRelations(int $id): User;

    /**
     * Метод получает общее количество
     * лайков на рекомендациях пользователя
     * с id = $id
     * @param int $id идентификатор пользователя
     * @return int количество лайков
     */
    public function getLikesCount(int $id): int;

    /**
     * Метод получает первых 20 пользователей,
     * которые отсортированы по убыванию количества лайков
     * на рекомендациях
     * @return array массив объектов User
     */
    public function getUsersByRating(): array;

    /**
     * Метод возвращает непрочитанные уведомления пользователя
     * с id = $user_id
     * @param int $user_id идентификатор пользователя
     * @return array массив непрочитанных уведомлений
     */
    public function getUserNotifications(int $user_id): array;

    /**
     * Метод возвращает токен пользователя с email = $user_email
     * @param string $user_email электронный адрес пользователя
     * @return string токен пользователя
     * @throws IDNotFoundException если пользователь с указанной почтой не существует
     */
    public function getUserTokenByEmail(string $user_email): string;

    /**
     * Метод возвращает экземпляр модели User пользователя с token = $token
     * @param string $token электронный адрес пользователя
     * @return User объект модели пользователя
     * @throws IDNotFoundException если пользователь с указанным токеном не существует
     */
    public function getUserByToken(string $token): User;
}