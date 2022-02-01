<?php

namespace app\components\helpers\interface;

/**
 * Интерфейс для создания класса-валидатора,
 * который будет работать с базой данных
 */
interface DBValidatorInterface
{
    /**
     * Метод проверяет наличие записи 
     * с идентификатором id в таблице resume
     * @param int $id идентификатор записи
     * @return bool
     */
    public function resumeExist(int $id): bool;

    /**
     * Метод проверяет наличие записи 
     * с идентификатором id в таблице comments
     * @param int $id идентификатор записи
     * @return bool
     */
    public function commentExist(int $id): bool;

    /**
     * Метод проверяет наличие лайка 
     * пользователя с идентификатором $user_id
     * на комментарии с id = $comment_id
     * @param int $user_id идентификатор пользователя
     * @param int $comment_id идентификатор комментария
     * @return bool
     */
    public function likeExist(int $user_id, int $comment_id): bool;

    /**
     * Метод проверяет наличие непрочитанных уведомлений
     * пользователя с идентификатором $user_id
     * @param int $user_id идентификатор пользователя
     * @return bool
     */
    public function userHaveNotification(int $user_id): bool;

    /**
     * Метод проверяет существование пользователя с token = $token
     * @param string $token токен пользователя
     * @return bool
     */
    public function userByTokenExist(string $token): bool;

    /**
     * Метод проверяет просматривал ли пользователь резюме с id = $resume_id
     * @param int $user_id идентификатор пользователя
     * @param int $resume_id идентификатор резюме
     * @return bool
     */
    public function resumeIsViewed(int $user_id, int $resume_id): bool;
}