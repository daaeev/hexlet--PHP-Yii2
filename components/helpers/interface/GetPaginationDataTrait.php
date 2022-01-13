<?php

namespace app\components\helpers\interface;

use yii\data\Pagination;
use yii\db\ActiveQuery;

trait GetPaginationDataTrait
{
    /**
     * Метод преобразует обычный запрос queryBuilder`a
     * с использованием пагинации
     * @param ActiveQuery $query экземпляр запроса
     * @param string $route путь к экшену с определенной категорией.
     * Не указывая путь для пагинации, при переходе на след. страницу,
     * адрес будет похож на 'site/resume', контроллер/экшен
     * @return array данные из бд с использованием пагинации
     */
    protected function getPaginationData(ActiveQuery $query, string $route): array
    {
        $countQuery = $query->count();
        $pagination = new Pagination(['totalCount' => $countQuery, 'pageSize' => $this->pageSize, 'route' => $route]);

        $elements = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return compact('pagination', 'elements');
    }
}