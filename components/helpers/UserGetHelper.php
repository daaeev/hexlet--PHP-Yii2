<?php

namespace app\components\helpers;

use app\components\helpers\interface\UserGetInterface;
use app\exceptions\IDNotFoundException;
use app\models\Comment;
use app\models\Likes;
use app\models\Notification;
use app\models\Resume;
use app\models\User;
use yii\db\ActiveQuery;

class UserGetHelper implements UserGetInterface
{
    public function getByIdWithRelations(int $id): User
    {
        $user = User::find()
            ->where(['id' => $id])
            ->with([
                'comments' => function (ActiveQuery $query) {
                    $query
                        ->joinWith('resume')
                        ->where([
                            'comments.parent_comment_id' => null,
                            'resume.status' => Resume::STATUS_CONFIRMED
                        ]);
                },
                'resumes' => function (ActiveQuery $query) {
                    $query
                        ->joinWith('comments')
                        ->where([
                            'status' => Resume::STATUS_CONFIRMED,
                            'comments.parent_comment_id' => null
                        ]);
                },
                'resumes.author' => function (ActiveQuery $query) {
                    $query->select(['user.id', 'user.name']);
                },
            ])
            ->one();
        
        if ($user) {
            return $user;
        }
        
        throw new IDNotFoundException('Пользователь с id ' . $id . ' не найден');
    }

    public function getLikesCount(int $id): int
    {
        $likesModel = Likes::find()
            ->select('COUNT(*)')
            ->joinWith('comment')
            ->where(['comments.author_id' => $id])
            ->column();

        $likesCount = $likesModel[0] ?? 0;
        return $likesCount;
    }

    public function getUsersByRating(): array
    {
        $users =  User::find()
            ->orderBy('likes_count DESC')
            ->limit(20)
            ->all();
        
        return $users;
    }

    public function getUserNotifications(int $user_id): array
    {
        $notifications = Notification::find()
            ->where(['to_user_id' => $user_id])
            ->orderBy('id DESC')
            ->all();
        
        return $notifications;
    }

    public function getUserTokenByEmail(string $user_email): string
    {
        $user_token = User::find()
            ->select('token')
            ->where(['email' => $user_email])
            ->column();

        if (!$user_token) {
            throw new IDNotFoundException('Пользователь с почтой ' . $this->email . ' не найден');
        }

        return $user_token[0];
    }

    public function getUserByToken(string $token): User
    {
        $user = User::find()
            ->where(['token' => $token])
            ->one();
        
        if ($user) {
            return $user;
        }

        throw new IDNotFoundException('Пользователь с токеном ' . $token . ' не существует');
    }

    public function getUserByEmail(string $email): User
    {
        $user = User::find()
            ->where(['email' => $email])
            ->one();
        
        if ($user) {
            return $user;
        }

        throw new IDNotFoundException('Пользователь с почтой ' . $email . ' не существует');
    }
}