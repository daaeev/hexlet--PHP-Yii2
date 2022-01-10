<?php

namespace app\components\helpers;

use app\models\Vacancie;

/**
 * Статичный класс, который используется исключительно в файлах вида
 * для упрощения вывода данных
 */
class ViewHelper
{
    /**
     * Выбирает слово в нужном падеже,
     * основываясь на количестве - 1 яблоко, 5 яблок...
     * @param int $num количетсво
     * @param array $words 3 слова в 3 соответствующих падежах
     * ['машина', 'машины', 'машин']
     * @return string слово в соответствующем количеству падеже
     */
    public static function numToWord(int $num, array $words)
    {
        $num = $num % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        switch ($num) {
            case 1: 
                return($words[0]);
            
            case 2: case 3: case 4: 
                return($words[1]);
            
            default: 
                return($words[2]);
        }
    }

    /**
     * Метод генерирует название вакансии,
     * используя такие данные, как: 
     * уровень знаний, должность, информация про зарплату
     * и название компании.
     * @param Vacancie|array $vac запись из таблицы vacancie
     * @return string сгенерированное название вакансии
     */
    public static function createVacancieTitle(Vacancie|array $vac): string
    {
        $title = "$vac->level $vac->position";

        if (isset($vac->money_from) && isset($vac->money_to)) {
            $title .= " от $vac->money_from до $vac->money_to $vac->currency";
        } else if (isset($vac->money_from)) {
            $title .= " от $vac->money_from $vac->currency";
        } else if (isset($vac->money_to)) {
            $title .= " до $vac->money_to $vac->currency";
        } else {
            $title .= " зарплата договорная $vac->currency";
        }
        
        $title .= " - $vac->company";

        return $title;
    }
}