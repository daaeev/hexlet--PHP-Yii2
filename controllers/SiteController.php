<?php

namespace app\controllers;

use app\components\helpers\interface\ResumeGetInterface;
use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\filters\NeededVariables;
use app\models\forms\AccountSettingsForm;
use app\models\forms\CreateResumForm;
use app\models\forms\CreateVacancieForm;
use app\models\Resume;
use app\models\Vacancie;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;

class SiteController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            NeededVariables::class,
        ];
    }

    /**
     * Главная страница приложения на которой
     * отображаются резюме программистов
     * @param string $category название категории резюме,
     * которые нужно получить (all, new, popular, norecomend).

     * Под каждую категории существует соответствующий метод в класс-хелпере,
     * реализующий интерфейс ResumeGetInterface. 
     * 
     * Имя вызываемого методе генерируется 
     * приводя первый символ категории в верхний регистр
     * и добавляя префикс 'get' -- all = getAll()
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionResume($category = 'all')
    {
        $helper = Yii::$container->get(ResumeGetInterface::class);

        $function_name = 'get' . ucfirst($category);
        $data = $helper->$function_name();

        return $this->render('index', compact('data'));
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
            } catch (DBDataSaveException|ValidationFailedException $e) {
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

    /**
     * Экшен рендерит страницу с формой создания резюме.
     * @return string результат рендеринга
     * @return Response если операция создания резюме пройдёт успешно, 
     * выполнится редирект на главную страницу
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws InvalidConfigException if a dependency cannot be resolved or if a dependency cannot be fulfilled.
     * @throws NotInstantiableException If resolved to an abstract class or an interface (since 2.0.9)
     */
    public function actionCreateResume()
    {
        $model = new CreateResumForm;

        if ($model->load(Yii::$app->request->post(), 'CreateResumForm')) {
            $resume = new Resume;

            // if (Yii::$app->request->post('publish'))
            $status = Resume::STATUS_NOT_CONFIRMED;

            if (Yii::$app->request->post('draft')) {
                $status = Resume::STATUS_ON_DRAFT;
            }

            $resume->status = $status;

            try {
                Yii::$container->invoke([$model, 'createResum'], ['resume' => $resume]);

                // if ($status == Resume::STATUS_NOT_CONFIRMED)
                $flash_message = 'Ожидайте подтверждения корректности резюме. После вы увидите своё резюме в списке';

                if ($status == Resume::STATUS_ON_DRAFT) {
                    $flash_message = 'Ваше резюме сохранено в черновик';
                }

                Yii::$app->session->setFlash('success', $flash_message);
                
            } catch (ValidationFailedException|DBDataSaveException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(Url::home());
        }

        return $this->render('resume_create_form', compact('model'));
    }

    /**
     * Экшен рендерит страницу с формой создания вакансии.
     * @return string результат рендеринга
     * @return Response если операция создания вакансии пройдёт успешно, 
     * выполнится редирект на страницу просмотра вакансий
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws InvalidConfigException if a dependency cannot be resolved or if a dependency cannot be fulfilled.
     * @throws NotInstantiableException If resolved to an abstract class or an interface (since 2.0.9)
     */
    public function actionCreateVacancie()
    {
        $model = new CreateVacancieForm;

        if ($model->load(Yii::$app->request->post(), 'CreateVacancieForm')) {
            $vacancie = new Vacancie;

            try {
                Yii::$container->invoke([$model, 'createVacancie'], ['vacancie' => $vacancie]);
                Yii::$app->session->setFlash('success', 'Ожидайте подтверждения корректности вакансии. После вы увидите свою вакансию в списке');
            } catch (ValidationFailedException|DBDataSaveException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(Url::to('/vacancies'));
        }

        return $this->render('vacancie_create_form', compact('model'));
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
