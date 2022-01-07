<?php

namespace app\controllers;

use app\filters\NeededVariables;
use app\models\forms\AccountSettingsForm;
use Exception;
use yii\web\Controller;
use Yii;

class SiteController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            NeededVariables::class,
        ];
    }

    public function actionResume($category = null)
    {
        return $this->render('index');
    }

    public function actionResumeView($id)
    {
        return $this->render('resume-view');
    }

    public function actionVacancieView($id)
    {
        return $this->render('vacancie-view');
    }

    public function actionVacancies()
    {
        return $this->render('vacancies');
    }

    public function actionRating()
    {
        return $this->render('rating');
    }

    /**
     * Страница, которая выделена под этот экшен разделена 
     * на 4 разные файла. Файлы имеют префикс account-
     * 
     * Каждая страница имеет свой отдельный экшен.
     * Имя вызываемого экшена генерируется, переводя первый
     * символ строки $tab в верхний регистр,
     * добавляя префикс actionAccount.
     * 
     * $tab = settings -- actionAccountSettings
     * 
     * @param string $tab название файла-вида без префикса account-
     */
    public function actionAccount(string $tab)
    {
        $actionName = 'actionAccount' . ucfirst($tab);

        return $this->$actionName();
    }

    /**
     * Экшен для отображния формы с настройками пользователя
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountSettings()
    {
        $model = new AccountSettingsForm;

        if ($model->load(Yii::$app->request->post(), 'AccountSettingsForm')) {
            try {
                $model->saveUserSettings($this->view->params['user']);
                Yii::$app->session->setFlash('success', 'Данные успешно изменены');
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('account-settings', compact('model'));
    }

    /**
     * Экшен для отображния уведомлений
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountNotify()
    {
        return $this->render('account-notify');
    }

    /**
     * Экшен для отображния резюме пользователя
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountResume()
    {
        return $this->render('account-resume');
    }

    /**
     * Экшен для отображния вакансий пользователя
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountVacancies()
    {
        return $this->render('account-vacancies');
    }

    public function actionCreateResume()
    {
        return $this->render('resume_create_form');
    }

    public function actionCreateVacancie()
    {
        return $this->render('vacancie_create_form');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
