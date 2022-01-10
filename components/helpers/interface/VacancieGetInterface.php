<?php

namespace app\components\helpers\interface;

interface VacancieGetInterface
{
    /**
     * Возвращает массив со всеми проверенными вакансиями
     * @return array массив из проверенных резюме с пагинацией ['vacancies' => [...], 'pagination' => [...]]
     */
    public function getAll(): array;
}