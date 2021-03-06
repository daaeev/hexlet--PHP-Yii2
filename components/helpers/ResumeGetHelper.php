<?php

namespace app\components\helpers;

use app\components\helpers\interface\GetPaginationDataTrait;
use app\components\helpers\interface\ResumeGetInterface;
use app\exceptions\IDNotFoundException;
use app\models\Resume;
use yii\data\Pagination;
use yii\db\ActiveQuery;

/**
 * Класс-хелпер для получения данных из таблицы resume
 */
class ResumeGetHelper implements ResumeGetInterface
{
    public int $pageSize = 20;

    use GetPaginationDataTrait;

    public function getAll(): array
    {
        $query = Resume::find()
            ->with([
                'comments' => function (ActiveQuery $query) {
                    $query->where(['comments.parent_comment_id' => null]);
                },
                'author' => function (ActiveQuery $query) {
                    $query->select(['user.id', 'user.name']);
                },
            ])
            ->where(['status' => Resume::STATUS_CONFIRMED])
            ->orderBy('pub_date DESC');

        $data = $this->getPaginationData($query, 'resume/all');

        return $data;
    }

    public function getNew(): array
    {
        $query = Resume::find()
            ->with([
                'comments' => function (ActiveQuery $query) {
                    $query->where(['comments.parent_comment_id' => null]);
                },
                'author' => function (ActiveQuery $query) {
                    $query->select(['user.id', 'user.name']);
                },
            ])
            ->where(['status' => Resume::STATUS_CONFIRMED])
            ->orderBy('pub_date DESC');

        $data = $this->getPaginationData($query, 'resume/all');

        return $data;
    }

    public function getPopular(): array
    {
        $query = Resume::find()
            ->with([
                'comments' => function (ActiveQuery $query) {
                    $query->where(['comments.parent_comment_id' => null]);
                },
                'author' => function (ActiveQuery $query) {
                    $query->select(['user.id', 'user.name']);
                },
            ])
            ->where(['status' => Resume::STATUS_CONFIRMED])
            ->orderBy('pub_date DESC, views DESC');

        $data = $this->getPaginationData($query, 'resume/all');

        return $data;
    }

    public function getNorecomend(): array
    {
        $query = Resume::find()
            ->with([
                'author' => function (ActiveQuery $query) {
                    $query->select(['user.id', 'user.name']);
                },
            ])
            ->joinWith([
                'comments' => function (ActiveQuery $query) {
                    $query->where(['comments.parent_comment_id' => null]);
                }
            ])
            ->where(['status' => Resume::STATUS_CONFIRMED])
            ->andWhere(['comments.id' => null])
            ->orderBy('pub_date DESC');

        $data = $this->getPaginationData($query, 'resume/all');

        return $data;
    }

    public function findById(int $id, bool $onDraft = false): Resume
    {
        $query = Resume::find()
            ->with([
                'author', 
                'comments.author', 
                'comments.comments.author',
                'comments.likes',
            ])
            ->where(['id' => $id]);
        
        if ($onDraft) {
            $query->andWhere(['status' => Resume::STATUS_ON_DRAFT]);
        } else {
            $query->andWhere(['status' => Resume::STATUS_CONFIRMED]);
        }

        $model = $query->one();
        
        if ($model) {
            return $model;
        }

        throw new IDNotFoundException('Запрошенное резюме не найдено');
    }

    public function findByAuthor(int $author_id): array
    {
        $models = Resume::find()
            ->where(['author_id' => $author_id])
            ->all();

        return $models;
    }
}
