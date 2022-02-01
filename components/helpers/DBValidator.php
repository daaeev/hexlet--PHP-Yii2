<?php

namespace app\components\helpers;

use app\components\helpers\interface\DBValidatorInterface;
use app\models\Comment;
use app\models\Likes;
use app\models\Notification;
use app\models\Resume;
use app\models\User;
use app\models\View;

/**
 * Валидатор, который облегчает юнит-тестирование.
 * Работает с базой данных, в основном,
 * посредством exist запросов
 */
class DBValidator implements DBValidatorInterface
{
    public function resumeExist(int $id): bool
    {
        if (Resume::find()->where(['id' => $id, 'status' => Resume::STATUS_CONFIRMED])->exists()) {
            return true;
        }

        return false;
    }

    public function commentExist(int $id): bool
    {
        if (Comment::find()->where(['id' => $id])->exists()) {
            return true;
        }

        return false;
    }

    public function likeExist(int $user_id, int $comment_id): bool
    {
        if (Likes::find()->where(['user_id' => $user_id, 'comment_id' => $comment_id])->exists()) {
            return true;
        }

        return false;
    }

    public function userHaveNotification(int $user_id): bool
    {
        if (Notification::find()->where(['to_user_id' => $user_id, 'is_viewed' => Notification::STATUS_NOT_VIEWED])->exists()) {
            return true;
        }

        return false;
    }

    public function userByTokenExist(string $token): bool
    {
        if (User::find()->where(['token' => $token])->exists()) {
            return true;
        }

        return false;
    }

    public function resumeIsViewed(int $user_id, int $resume_id): bool
    {
        if (View::find()->where(['user_id' => $user_id, 'resume_id' => $resume_id])->exists()) {
            return true;
        }

        return false;
    }
}