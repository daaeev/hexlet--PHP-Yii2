<?php

namespace app\components\helpers;

use app\components\helpers\interface\UserGetInterface;
use app\exceptions\IDNotFoundException;
use app\models\Comment;
use app\models\Likes;
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
}