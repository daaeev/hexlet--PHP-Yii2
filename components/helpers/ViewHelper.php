<?php

namespace app\components\helpers;

use app\components\helpers\interface\DBValidatorInterface;
use app\models\Resume;
use app\models\Vacancie;
use PHPUnit\Framework\MockObject\MockObject;
use Yii;

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
     * уровень знаний, должность, информация о зарплате
     * и название компании.
     * @param Vacancie|MockObject $vac запись из таблицы vacancie
     * @return string сгенерированное название вакансии
     */
    public static function createVacancieTitle($vac): string
    {
        $title = "$vac->level $vac->position";
        $title .= self::createSalaryTitle($vac) ? ' ' . self::createSalaryTitle($vac) . ' ' : ' ';
        $title .= "- $vac->company";

        return $title;
    }

    /**
     * Метод генерирует строку
     * из данных вакансии о зарплате
     * @param Vacancie|MockObject $vac запись из таблицы vacancie
     * @return string сгенерированное строке из данных о зарплате
     */
    public static function createSalaryTitle($vac): string
    {
        $title = '';

        if (isset($vac->money_from) && isset($vac->money_to)) {
            $title .= "от $vac->money_from до $vac->money_to";
        } else if (isset($vac->money_from)) {
            $title .= "от $vac->money_from";
        } else if (isset($vac->money_to)) {
            $title .= "до $vac->money_to";
        }

        if ($title && $vac->money) {
            $title .= " $vac->currency ($vac->money)";
        } else if ($title) {
            $title .= " $vac->currency";
        }

        return $title;
    }

    /**
     * Метод генерирует тип передачи данных 
     * post или delete (используется в кнопке лайка)
     * 
     * Если пользователь незарегистрирован - post
     * 
     * Если зарегистрирован, но не поставил лайк - post
     * 
     * Если зарегистрирован и поставил лайк - delete
     * @param int $comment_id id комментария
     * @return string метод передачи данных
     */
    public static function createDataMethod(int $comment_id): string
    {
        if (!Yii::$app->user->isGuest) {
            $helper = Yii::$container->get(DBValidatorInterface::class);

            if ($helper->likeExist(Yii::$app->view->params['user']->id, $comment_id)) {
                return 'delete';
            } else {
                return 'post';
            }
        } else {
            return 'post';
        }
    }

    /**
     * Генерация информации о статусе резюме/вакансии
     * @param int $status статус резюме/вакансии
     * @param string $href ссылка для просмотра резюме/вакансии
     * @return string информация о статусе резюме/вакансии
     */
    public static function introduceStatus(int $status, string $href): string
    {
        switch ($status) {
            case Resume::STATUS_CONFIRMED || Vacancie::STATUS_CONFIRMED:
                return '<p class="card-header text-success">Проверено<span class="ms-3"><a href="' . $href . '"><span class="bi bi-eye text-muted"></span></a></span></p>';
                break;
            case Resume::STATUS_NOT_CONFIRMED || Vacancie::STATUS_NOT_CONFIRMED:
                return '<p class="card-header text-warning">Не проверено</p>';
                break;
            case Resume::STATUS_ON_DRAFT:
                return '<p class="card-header">В черновик<span class="ms-3"><a href="#"><span class="bi bi-pencil-square text-muted"></span></a></span></p>';
                break;
            case Resume::STATUS_BANNED || Vacancie::STATUS_BANNED:
                return '<p class="card-header text-danger">Забанено</p>';
                break;
        }
    }
}