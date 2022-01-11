<?php

namespace app\components\helpers\interface;

/**
 * Интерфейс для создания класса-валидатора,
 * который будет работать с базой данных
 */
interface DBValidatorInterface
{
    /**
     * Метод проверяет наличие записи 
     * с идентификатором id в таблице resume
     * @param int $id идентификатор записи
     * @return bool
     */
    public function resumeExist(int $id): bool;

    /**
     * Метод проверяет наличие записи 
     * с идентификатором id в таблице comments
     * @param int $id идентификатор записи
     * @return bool
     */
    public function commentExist(int $id): bool;
}