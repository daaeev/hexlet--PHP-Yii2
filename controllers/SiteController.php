<?php

namespace app\controllers;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\filters\NeededVariables;
use app\models\forms\AccountSettingsForm;
use app\models\forms\CreateResumForm;
use app\models\Resume;
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
     * @throws ValidationFailedException если валидация данных модели пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных модели в бд пройдёт неуспешно
     * @throws InvalidConfigException if a dependency cannot be resolved or if a dependency cannot be fulfilled.
     * @throws NotInstantiableException If resolved to an abstract class or an interface (since 2.0.9)
     */
    public function actionCreateResume()
    {
        $model = new CreateResumForm;

        if ($model->load(Yii::$app->request->post(), 'CreateResumForm')) {
            $resume = new Resume;
            $status = Resume::STATUS_NOT_CONFIRMED;

            if (Yii::$app->request->post('draft')) {
                $status = Resume::STATUS_ON_DRAFT;
            }

            $resume->status = $status;

            try {
                Yii::$container->invoke([$model, 'createResum'], ['resume' => $resume]);
                $flash_message = 'Ожидайте подтверждения корректность резюме. После подтверждения вы увидите своё резюме вв списке';

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
