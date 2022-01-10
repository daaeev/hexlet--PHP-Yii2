<?php

namespace app\components\helpers\interface;

use app\models\Resume;

interface ResumeGetInterface
{
    /**
     * Возвращает массив со всеми проверенными резюме
     * @return array массив из проверенных резюме с пагинацией ['resumes' => [...], 'pagination' => [...]]
     */
    public function getAll(): array;

    /**
     * Возвращает массив с проверенными резюме,
     * которые созданы не позже, чем 3 дня назад
     * @return array массив из проверенных резюме с пагинацией ['resumes' => [...], 'pagination' => [...]]
     */
    public function getNew(): array;

    /**
     * Возвращает массив с самыми просматриваемыми проверенными резюме
     * @return array массив из проверенных резюме с пагинацией ['resumes' => [...], 'pagination' => [...]]
     */
    public function getPopular(): array;

    /**
     * Возвращает массив с проверенными резюме,
     * которые не имеют рекомендаций
     * @return array массив из проверенных резюме с пагинацией ['resumes' => [...], 'pagination' => [...]]
     */
    public function getNorecomend(): array;

    /**
     * Возвращает запись из таблицы resume
     * с определенным идентификатором
     * @param int $id идентификатор записи
     * @return Resume|array запись из таблицы resume
     */
    public function findById(int $id): Resume|array;
}