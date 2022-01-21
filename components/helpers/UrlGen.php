<?php

namespace app\components\helpers;

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
        return '/resume/' . $category;
    }

    /**
     * Генерация адреса страницы просмотра вакансий
     * @return string адресс страницы
     */
    public static function allVacancies(): string
    {
        return '/vacancies';
    }

    /**
     * Генерация адреса страницы просмотра рейтинга
     * @return string адресс страницы
     */
    public static function rating(): string
    {
        return '/rating';
    }

    /**
     * Генерация адреса страницы админ панели
     * @param string $page название раздела админ панели (user, resume...)
     * @return string адресс страницы
     */
    public static function adminPanel(string $page = "user"): string
    {
        return '/admin/' . $page;
    }

    /**
     * Генерация адреса страницы просмотра
     * данных аккаунта (уведомлений, резюме...)
     * @param string $tab название таба для отображения (resume, notify...)
     * @return string адресс страницы
     */
    public static function account(string $tab = "notify"): string
    {
        return '/account/' . $tab;
    }

    /**
     * Генерация адреса страницы с формой создания резюме/вакансии
     * @param string $created создаваемый объект (resume/vacancie)
     * @return string адресс страницы
     */
    public static function createPage(string $created): string
    {
        return '/create/' . $created;
    }

    /**
     * Генерация адреса страницы профиля
     * @param int $user_id id пользователя
     * @return string адресс страницы
     */
    public static function profile(int $user_id): string
    {
        return '/profile/' . $user_id;
    }

    /**
     * Генерация адреса страницы авторизации
     * @return string адресс страницы
     */
    public static function login(): string
    {
        return '/login';
    }

    /**
     * Генерация адреса страницы регистрации
     * @return string адресс страницы
     */
    public static function registration(): string
    {
        return '/registration';
    }

    /**
     * Генерация адреса страницы выхода
     * @return string адресс страницы
     */
    public static function logout(): string
    {
        return '/logout';
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
        return '/resume/like/' . $id;
    }

    /**
     * Генерация адреса страницы просмотра вакансий
     * по фильтрам
     * @return string адресс страницы
     */
    public static function allVacanciesWithFilters(): string
    {
        return '/vacancies/filters';
    }

    /**
     * Генерация адреса страницы удаления уведомления пользователя
     * @param int $notify_id идентификатор уведомления
     * @return string адресс страницы
     */
    public static function deleteNotify(int $notify_id): string
    {
        return '/account/delete-notify/' . $notify_id;
    }

    /**
     * Генерация адреса страницы с формой для отправки письма на почту
     * @return string адресс страницы
     */
    public static function forgotPassPage(): string
    {
        return '/forgot-pass';
    }

    /**
     * Генерация полного адреса страницы с формой для изменения пароля
     * @param string $token токен пользователя
     * @return string адресс страницы
     */
    public static function fullChangePassPage(string $token): string
    {
        return ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . "/change-pass?token=$token";
    }
}