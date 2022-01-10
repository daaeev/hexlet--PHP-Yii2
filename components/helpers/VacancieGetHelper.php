<?php

namespace app\components\helpers;

use app\components\helpers\interface\VacancieGetInterface;
use app\exceptions\IDNotFoundException;
use app\models\Vacancie;
use yii\data\Pagination;
use yii\db\ActiveQuery;

/**
 * Класс-хелпер для получения данных из таблицы vacancie
 * @property int $pageSize количество записей на одной странице.
 * Используется в создании пагинации
 */
class VacancieGetHelper implements VacancieGetInterface
{
    public int $pageSize = 20;

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

    /**
     * Метод преобразует обычный запрос queryBuilder`a
     * с использованием пагинации
     * @param ActiveQuery $query экземпляр запроса
     * @param string $route путь к экшену с определенной категорией.
     * Не указывая путь для пагинации, при переходе на след. страницу,
     * адрес будет похож на 'site/index', контроллер/экшен
     * @return array данные из бд с использованием пагинации
     */
    protected function getPaginationData(ActiveQuery $query, string $route): array
    {
        $countQuery = $query->count();
        $pagination = new Pagination(['totalCount' => $countQuery, 'pageSize' => $this->pageSize, 'route' => $route]);

        $vacancies = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return compact('pagination', 'vacancies');
    }
}