<?php

namespace app\components\helpers;

use app\components\helpers\interface\DBValidatorInterface;
use app\models\Comment;
use app\models\Resume;

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
}