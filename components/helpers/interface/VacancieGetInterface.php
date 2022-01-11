<?php

namespace app\components\helpers\interface;

use app\models\Vacancie;

interface VacancieGetInterface
{
    /**
     * Возвращает массив со всеми проверенными вакансиями
     * @return array массив из проверенных резюме с пагинацией ['vacancies' => [...], 'pagination' => [...]]
     */
    public function getAll(): array;

    /**
     * Возвращает запись из таблицы vacancie
     * с определенным идентификатором
     * @param int $id идентификатор записи
     * @return Vacancie|array запись из таблицы vacancie
     * @throws IDNotFoundException если запись не найдена
     */
    public function findById(int $id): Vacancie|array;
}