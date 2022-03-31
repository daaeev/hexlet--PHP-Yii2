<?php

namespace app\components\helpers;

use Yii;

/**
 * Статический класс для генерации
 * ссылок, для перехода на страницы сайта
 * 
 * При изменении url-адресации сайта, следует изменить
 * возвращаемые адреса в соответствующих методах класса
 */
class UrlGen
{
    /**
     * Генерация адреса главной страницы сайта
     * @return string адресс страницы
     */
    public static function home(): string
    {
        return '/';
    }

    /**
     * Генерация адреса страницы просмотра резюме
     * @param string $category категория искомых резюме (all, new...)
     * @return string адресс страницы
     */
    public static function allResumes(string $category = "all"): string
    {
        return self::languageCode() . '/resume/' . $category;
    }

    /**
     * Генерация адреса страницы просмотра вакансий
     * @return string адресс страницы
     */
    public static function allVacancies(): string
    {
        return self::languageCode() . '/vacancies';
    }

    /**
     * Генерация адреса страницы просмотра рейтинга
     * @return string адресс страницы
     */
    public static function rating(): string
    {
        return self::languageCode() . '/rating';
    }

    /**
     * Генерация адреса страницы админ панели
     * @param string $page название раздела админ панели (user, resume...)
     * @return string адресс страницы
     */
    public static function adminPanel(string $page = "user"): string
    {
        return self::languageCode() . '/admin/' . $page;
    }

    /**
     * Генерация адреса страницы просмотра
     * данных аккаунта (уведомлений, резюме...)
     * @param string $tab название таба для отображения (resume, notify...)
     * @return string адресс страницы
     */
    public static function account(string $tab = "notify"): string
    {
        return self::languageCode() . '/account/' . $tab;
    }

    /**
     * Генерация адреса страницы с формой создания резюме/вакансии
     * @param string $created создаваемый объект (resume/vacancie)
     * @return string адресс страницы
     */
    public static function createPage(string $created): string
    {
        return self::languageCode() . '/create/' . $created;
    }

    /**
     * Генерация адреса страницы профиля
     * @param int $user_id id пользователя
     * @return string адресс страницы
     */
    public static function profile(int $user_id): string
    {
        return self::languageCode() . '/profile/' . $user_id;
    }

    /**
     * Генерация адреса страницы авторизации
     * @return string адресс страницы
     */
    public static function login(): string
    {
        return self::languageCode() . '/login';
    }

    /**
     * Генерация адреса страницы регистрации
     * @return string адресс страницы
     */
    public static function registration(): string
    {
        return self::languageCode() . '/registration';
    }

    /**
     * Генерация адреса страницы выхода
     * @return string адресс страницы
     */
    public static function logout(): string
    {
        return self::languageCode() . '/logout';
    }

    /**
     * Генерация адреса страницы просмотра резюме
     * @param int $id идентификатор резюме
     * @return string адресс страницы
     */
    public static function resume(int $id): string
    {
        return '/resume/' . $id;
    }

    /**
     * Генерация адреса страницы просмотра вакансии
     * @param int $id идентификатор вакансии
     * @return string адресс страницы
     */
    public static function vacancie(int $id): string
    {
        return '/vacancie/' . $id;
    }

    /**
     * Генерация адреса страницы обработки лайка
     * @param int $id идентификатор комментария
     * @return string адресс страницы
     */
    public static function commentLike(int $id): string
    {
        return self::languageCode() . '/resume/like/' . $id;
    }

    /**
     * Генерация адреса страницы просмотра вакансий
     * по фильтрам
     * @return string адресс страницы
     */
    public static function allVacanciesWithFilters(): string
    {
        return self::languageCode() . '/vacancies/filters';
    }

    /**
     * Генерация адреса страницы удаления уведомления пользователя
     * @param int $notify_id идентификатор уведомления
     * @return string адресс страницы
     */
    public static function deleteNotify(int $notify_id): string
    {
        return self::languageCode() . '/account/delete-notify/' . $notify_id;
    }

    /**
     * Генерация адреса страницы с формой для отправки письма на почту
     * @return string адресс страницы
     */
    public static function forgotPassPage(): string
    {
        return self::languageCode() . '/forgot-pass';
    }

    /**
     * Генерация полного адреса страницы с формой для изменения пароля
     * @param string $token токен пользователя
     * @return string адресс страницы
     */
    public static function fullChangePassPage(string $token): string
    {
        return ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . self::languageCode() . "/change-pass?token=$token";
    }

    /**
     * Генерация адреса страницы редактирования резюме
     * @param int $id идентификатор резюме
     * @return string адресс страницы
     */
    public static function resumeEditPage(int $id): string
    {
        return self::languageCode() . "/resume/edit/$id";
    }

    /**
     * Генерация полного адреса страницы для подтверждения аккаунта
     * @param string $token токен пользователя
     * @return string адресс страницы
     */
    public static function fullConfirmEmailPage(string $token): string
    {
        return ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . self::languageCode() . "/email/confirm?token=$token";
    }

    /**
     * Генерация адреса страницы для отправки письма
     * с инструкцией подтверждения аккаунта
     * @return string адресс страницы
     */
    public static function sendConfirmEmailPage(): string
    {
        return self::languageCode() . '/email/send-confirm';
    }

    /**
     * Генерация адреса страницы создания комментария
     * @param int $resume_id идентификатор записи модели \App\Models\Resume
     * @param int|null $comment_id идентификатор записи модели \App\Models\Comment
     * @return string адресс страницы
     */
    public static function createComment(int $resume_id, int|null $comment_id = null): string
    {
        return self::languageCode() . "/create-comment/$resume_id" . ($comment_id ? "/$comment_id" : '');
    }

    /**
     * Генерация адреса страницы 'О проекре'
     *
     * @return string адресс страницы
     */
    public static function aboutPage(): string
    {
        return self::languageCode() . '/about';
    }

    /**
     * Метод возвращает код текущего языка (со слешем в начале) для url-адреса
     * @return string
     */
    protected static function languageCode()
    {
        return '/' . Yii::$app->language;
    }
}