<?php

namespace app\components\helpers\interface;

use app\models\Vacancie;

/**
 * @property int $pageSize количество записей на одной странице
 * при использовании пагинации
 */
interface VacancieGetInterface
{
    /**
     * Возвращает массив со всеми проверенными вакансиями
     * @return array массив из проверенных вакансий с пагинацией ['elements' => [...], 'pagination' => [...]]
     */
    public function getAll(): array;

    /**
     * Возвращает запись из таблицы vacancie
     * с определенным идентификатором
     * @param int $id идентификатор записи
     * @return Vacancie запись из таблицы vacancie
     * @throws IDNotFoundException если запись не найдена
     */
    public function findById(int $id): Vacancie;

    /**
     * Возвращает массив, состоящий из вакансий,
     * автором которых является пользователь с id = $author_id
     * @param int $author_id id пользователя из таблицы user
     * @return array массив объектов типа Vacancie
     */
    public function findByAuthor(int $author_id): array;

    /**
     * Возвращает ассоциативный массив 
     * с данными для выпадающих списков
     * формы поиска вакансий по фильтрам.
     * 
     * Например - ['level' => [...], 'technologies' => [...]]
     * @return array ассоциативный массив с данными
     */
    public function getFiltersData(): array;

    /**
     * Возвращает массив со всеми проверенными вакансиями,
     * которые подходят по фильтрам $filters
     * @param array $filters массив фильтров, состоящий из пары 
     * [столбец => значение], например: ['level' => 'Джуниор']
     * @return array массив из проверенных вакансий с пагинацией ['elements' => [...], 'pagination' => [...]]
     */
    public function getAllByFilters(array $filters): array;

    /**
     * Возвращает массив со всеми проверенными вакансиями,
     * которые похожи на вакансию $vacancie
     * @param Vacancie $vacancie экземпляр модели Vacancie
     * @return array массив из $limit проверенных вакансий
     */
    public function findSimilarVacancies($vacancie, int $limit = 5): array;
}