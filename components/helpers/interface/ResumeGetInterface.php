<?php

namespace app\components\helpers\interface;

use app\models\Resume;

interface ResumeGetInterface
{
    /**
     * Возвращает массив со всеми проверенными резюме
     * @return array массив из проверенных резюме с пагинацией ['elements' => [...], 'pagination' => [...]]
     */
    public function getAll(): array;

    /**
     * Возвращает массив с проверенными резюме,
     * которые созданы не позже, чем 3 дня назад
     * @return array массив из проверенных резюме с пагинацией ['elements' => [...], 'pagination' => [...]]
     */
    public function getNew(): array;

    /**
     * Возвращает массив с самыми просматриваемыми проверенными резюме
     * @return array массив из проверенных резюме с пагинацией ['elements' => [...], 'pagination' => [...]]
     */
    public function getPopular(): array;

    /**
     * Возвращает массив с проверенными резюме,
     * которые не имеют рекомендаций
     * @return array массив из проверенных резюме с пагинацией ['elements' => [...], 'pagination' => [...]]
     */
    public function getNorecomend(): array;

    /**
     * Возвращает запись из таблицы resume
     * с определенным идентификатором
     * @param int $id идентификатор записи
     * @return Resume|array запись из таблицы resume
     * @throws IDNotFoundException если запись не найдена
     */
    public function findById(int $id): Resume|array;

    /**
     * Возвращает массив, состоящий из резюме,
     * автором которых является пользователь с id = $author_id
     * @param int $author_id id пользователя из таблицы user
     * @return array массив объектов типа Resume
     */
    public function findByAuthor(int $author_id): array;
}