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
}