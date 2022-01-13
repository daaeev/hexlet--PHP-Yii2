<?php

namespace app\components\helpers;

use app\components\helpers\interface\GetPaginationDataTrait;
use app\components\helpers\interface\VacancieGetInterface;
use app\exceptions\IDNotFoundException;
use app\models\Vacancie;

/**
 * Класс-хелпер для получения данных из таблицы vacancie
 * @property int $pageSize количество записей на одной странице.
 * Используется в создании пагинации
 */
class VacancieGetHelper implements VacancieGetInterface
{
    public int $pageSize = 20;

    use GetPaginationDataTrait;

    public function getAll(): array
    {
        $query = Vacancie::find()
            ->where(['status' => Vacancie::STATUS_CONFIRMED])
            ->orderBy('pub_date DESC');

        $data = $this->getPaginationData($query, 'vacancies');

        return $data;
    }

    public function findById(int $id): Vacancie|array
    {
        $model = Vacancie::find()
            ->where(['status' => Vacancie::STATUS_CONFIRMED, 'id' => $id])
            ->one();
        
        if ($model) {
            return $model;
        }

        throw new IDNotFoundException;
    }
}