<?php

namespace app\controllers;

use app\components\helpers\DBValidator;
use app\components\helpers\interface\DBValidatorInterface;
use app\components\helpers\interface\ResumeGetInterface;
use app\components\helpers\interface\UserGetInterface;
use app\components\helpers\interface\VacancieGetInterface;
use app\components\helpers\UrlGen;
use app\exceptions\DBDataSaveException;
use app\exceptions\IDNotFoundException;
use app\exceptions\ValidationFailedException;
use app\filters\NeededVariables;
use app\filters\ResumeViewsFilter;
use app\models\Comment;
use app\models\forms\AccountSettingsForm;
use app\models\forms\CreateCommentForm;
use app\models\forms\CreateResumForm;
use app\models\forms\CreateVacancieForm;
use app\models\Likes;
use app\models\Notification;
use app\models\Resume;
use app\models\User;
use app\models\Vacancie;
use Exception;
use Parsedown;
use yii\web\Controller;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            NeededVariables::class,
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'do-like'  => ['post', 'delete'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['do-like', 'create-comment', 'account', 'create-resume', 'create-vacancie', 'resume-edit', 'delete-notify', 'send-mail-to-confirm'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['do-like', 'create-comment', 'account', 'create-resume', 'create-vacancie', 'resume-edit', 'delete-notify', 'send-mail-to-confirm'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'resume_views' => [
                'class' => ResumeViewsFilter::class,
                'only' => ['resume-view'],
            ]
        ];
    }

    /**
     * Рендеринг страницы 'О проекте'
     *
     * @return string результат рендеринга
     */
    public function actionAbout()
    {
        return $this->render('about');
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

    /**
     * Метод отвечает за страницу для просмотра определенного резюме.
     * 
     * Происходит создание моделей для форм комментариев разных типов
     * (рекомендации, комментарии к рекомендациям) и передача их в файл вида
     * @param int $id идентификатор записи в таблице resume
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws IDNotFoundException если запись не найдена
     */
    public function actionResumeView($id)
    {
        $helper = Yii::$container->get(ResumeGetInterface::class);

        // Модель для формы создания рекомендаций
        $answer_form = new CreateCommentForm;

        // Модель для формы создания комментария к комментарию
        $comment_form = new CreateCommentForm;
        $comment_form->scenario = CreateCommentForm::SCENARIO_COMMENT_TO_ANSWER;

        $resume = $helper->findById($id);

        return $this->render('resume-view', compact('resume', 'answer_form', 'comment_form'));
    }

    /**
     * Метод отвечает за создание/удаление
     * лайка на рекомендации
     * 
     * Если тип запроса - post, то проверяется наличие лайка пользователя
     * на комментарии с id = $id. Если не имеется - создать запись лайка в таблице likes,
     * увеличить счётчик likes_count в таблице user
     * и создать flash-сессию с результатом операции.
     * 
     * Если тип запроса - delete, то проверяется наличие лайка пользователя
     * на комментарии с id = $id. Если имеется - удалить запись из таблицы likes,
     * уменьшить счётчик likes_count в таблице user
     * и создать flash-сессию с результатом операции.
     * @param int $id идентификатор комментария
     * @return Response 
     */
    public function actionDoLike($id)
    {
        $helper = Yii::$container->get(DBValidatorInterface::class);

        if (Yii::$app->request->isPost) {
            if (!$helper->likeExist(Yii::$app->view->params['user']->id, $id)) {
                $model = new Likes;
                $model->user_id = Yii::$app->view->params['user']->id;
                $model->comment_id = $id;

                if ($model->save()) {
                    $user = User::find()
                        ->joinWith('comments')
                        ->where(['comments.id' => $id])
                        ->one();

                    $user->updateCounters(['likes_count' => 1]);

                    Yii::$app->session->setFlash('success', Yii::t('main', 'Вы поставили отметку "Мне нравится"'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('main', 'Возникла ошибка в сохранении данных'));
                }
            }
        } else if (Yii::$app->request->isDelete) {
            if ($helper->likeExist(Yii::$app->view->params['user']->id, $id)) {
                $model = Likes::findOne([
                    'user_id' => Yii::$app->view->params['user']->id,
                    'comment_id' => $id,
                ]);

                if ($model->delete()) {
                    $user = User::find()
                        ->joinWith('comments')
                        ->where(['comments.id' => $id])
                        ->one();
                        
                    $user->updateCounters(['likes_count' => -1]);
                    Yii::$app->session->setFlash('success', Yii::t('main', 'Вы убрали отметку "Мне нравится"'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('main', 'Возникла ошибка в сохранении данных'));
                }
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Метод отвечает за операцию создания комментариев.
     * 
     * После выполнения задачи производится редирект на предыдущую страницу,
     * которую посещал пользователь (предположительно, страница с резюме).
     * 
     * Через GET-запрос на вход присылаются данные о резюме и
     * родительский комментарий, если создаётся комментарий к рекомендации.
     * Данные передаются в метод создания комментария
     * @param int $resume_id id записи в таблице resume
     * @param int $parent_comment_id id записи в таблице comments,
     * (id родительского комментария)
     * @return Response 
     */
    public function actionCreateComment(int $resume_id, int $parent_comment_id = null)
    {
        $model = new CreateCommentForm;

        if ($model->load(Yii::$app->request->post(), 'CreateCommentForm')) {
            try {
                $comment = new Comment;
                $parser = Yii::$container->get(Parsedown::class);
                $validator = Yii::$container->get(DBValidatorInterface::class);
                $model->createComment($comment, $parser, $validator, $resume_id, $parent_comment_id);
            } catch (DBDataSaveException|ValidationFailedException|IDNotFoundException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->session->setFlash('warning', Yii::t('main', 'Что-то пошло не так...'));

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Метод отвечает за страницу для просмотра определенненной вакансии
     * 
     * Осуществляется поиск вакансии из таблицы vacancie с id = $id.
     * Также достаются ей похожие вакансии
     * @param int $id идентификатор записи в таблице vacancie
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws IDNotFoundException если запись не найдена
     */
    public function actionVacancieView($id)
    {
        $helper = Yii::$container->get(VacancieGetInterface::class);

        $vacancie = $helper->findById($id);
        $similar_vacancies = $helper->findSimilarVacancies($vacancie);

        return $this->render('vacancie-view', compact('vacancie', 'similar_vacancies'));
    }

    /**
     * Метод отвечает за рендер страницы со всеми вакансиями
     * 
     * Осуществляется получение всех вакансий и 
     * данных для формы поиска по фильтрам, затем
     * происходит их передача в файл вида.
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionVacancies()
    {
        $helper = Yii::$container->get(VacancieGetInterface::class);
        $data = $helper->getAll();
        $filters = $helper->getFiltersData();

        return $this->render('vacancies', compact('data', 'filters'));
    }

    /**
     * Метод отвечает за рендер страницы со всеми вакансиями,
     * которые подходят по выбранным фильтрам
     * 
     * Осуществляется получение всех вакансий по фильтрам и 
     * данных для формы поиска по фильтрам, затем
     * происходит их передача в файл вида.
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionVacanciesFilters()
    {
        $helper = Yii::$container->get(VacancieGetInterface::class);
        $data = $helper->getAllByFilters(Yii::$app->request->post('filters'));
        $filters = $helper->getFiltersData();

        return $this->render('vacancies', compact('data', 'filters'));
    }

    /**
     * Метод отвечает за страницу рейтинга пользователей
     * 
     * Из базы получаются первые 20 пользователя, отсортированны
     * по количеству лайков на их рекомендациях и передаются
     * в файл вида
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionRating()
    {
        $helper = Yii::$container->get(UserGetInterface::class);
        $users = $helper->getUsersByRating();

        return $this->render('rating', compact('users'));
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
     * Экшен для отображения формы с настройками пользователя
     * 
     * Если имеются соответствующие POST-данные, 
     * то производится заполнение модели данными
     * и вызов соответствующего метода изменения 
     * данных пользователя в БД.
     * 
     * При положительном/отрицательном исходе изменении данных,
     * создаётся flash-сессия с соответствующим сообщением
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountSettings()
    {
        $model = new AccountSettingsForm;

        if ($model->load(Yii::$app->request->post(), 'AccountSettingsForm')) {
            try {
                $model->saveUserSettings($this->view->params['user']);
                Yii::$app->session->setFlash('success', Yii::t('main', 'Данные успешно изменены'));
            } catch (DBDataSaveException|ValidationFailedException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('account-settings', compact('model'));
    }

    /**
     * Экшен для отображения непрочитанных уведомлений пользователя
     * 
     * Если у пользователя имеются непрочитанные уведомления,
     * то при помощи хелпера из базы получаются уведомления, 
     * статус которых дальше обновляется на "Просмотрено"
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws NotSupportedException — если статус уведомлений не изменён
     */
    public function actionAccountNotify()
    {
        $helper = Yii::$container->get(UserGetInterface::class);
        $notifications = $helper->getUserNotifications($this->view->params['user']->id);

        // Если имеются непрочитанные уведомления - изменить их статус на "Прочитано"
        if ($this->view->params['have_notification']) {
            Notification::updateAllCounters(
                ['is_viewed' => Notification::STATUS_VIEWED], 
                [
                    'to_user_id' => $this->view->params['user']->id,
                    'is_viewed' => Notification::STATUS_NOT_VIEWED,
                ]
            );
        }

        return $this->render('account-notify', compact('notifications'));
    }

    /**
     * Метод отвечает за операцию удаления уведомления
     * 
     * Для начала проверяется, является ли пользователь получателем уведомления.
     * Если является - уведомление удаляется и выводится сообщение об успешной операции.
     * Если НЕ является - выводится сообщение об ошибке.
     * @param int $notify_id id записи в таблице resume
     * @return Response 
     */
    public function actionDeleteNotify($notify_id)
    {
        $notify = Notification::findOne([
            'id' => $notify_id, 
            'to_user_id' => $this->view->params['user']->id
        ]);

        if ($notify && $notify->delete()) {
            Yii::$app->session->setFlash('success', 'Уведомление успешно удалено');
        } else {
            Yii::$app->session->setFlash('success', 'При удалении что-то пошло не так, попробуйте заново');
        }

        return $this->redirect(UrlGen::account('notify'));
    }

    /**
     * Экшен для отображения резюме пользователя
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountResume()
    {
        $helper = Yii::$container->get(ResumeGetInterface::class);
        $resumes = $helper->findByAuthor($this->view->params['user']->id);
        
        return $this->render('account-resume', compact('resumes'));
    }

    /**
     * Экшен для отображения вакансий пользователя
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionAccountVacancies()
    {
        $helper = Yii::$container->get(VacancieGetInterface::class);
        $vacancies = $helper->findByAuthor($this->view->params['user']->id);

        return $this->render('account-vacancies', compact('vacancies'));
    }

    /**
     * Экшен рендерит страницу с формой создания резюме.
     * 
     * Если юзер отправил форму, 
     * то производится заполнение модели данными
     * и вызов соответствующего метода создания 
     * резюме в БД.
     * 
     * Статус резюме (Не подтверждено / В черновик)
     * определяется до вызова метода создания резюме
     * и присваивается непосредственно экземпляру $resume
     * для упрощения создания flash-сессии с соответствующим сообщением
     * 
     * При положительном/отрицательном исходе создания резюме,
     * создаётся flash-сессия с соответствующим сообщением
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
            $parser = Yii::$container->get(Parsedown::class);

            // if (Yii::$app->request->post('publish'))
            $status = Resume::STATUS_NOT_CONFIRMED;

            if (Yii::$app->request->post('draft')) {
                $status = Resume::STATUS_ON_DRAFT;
            }

            $resume->status = $status;

            try {
                $model->createResum($resume, $parser);

                // if ($status == Resume::STATUS_NOT_CONFIRMED)
                $flash_message = 'Ожидайте подтверждения корректности резюме. После вы увидите своё резюме в списке';

                if ($status == Resume::STATUS_ON_DRAFT) {
                    $flash_message = 'Ваше резюме сохранено в черновик';
                }

                Yii::$app->session->setFlash('success', $flash_message);
                
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(UrlGen::home());
        }

        return $this->render('resume_create_form', compact('model'));
    }

    /**
     * Экшен рендерит страницу с формой для редактирования резюме.
     * 
     * Сперва, при помощи хелпера, из БД достаётся резюме 
     * с id = $id и статусом "в черновике".
     * Проводится проверка, является ли пользователь автором резюме.
     * 
     * Если юзер отправил форму, 
     * то производится заполнение модели данными
     * и вызов соответствующего метода создания 
     * резюме в БД. Иначе модель заполняется
     * данными полученного резюме и вызывается метод рендера файла вида.
     * 
     * Статус резюме (Не подтверждено / В черновик)
     * определяется до вызова метода создания резюме
     * и присваивается непосредственно экземпляру $resume
     * для упрощения создания flash-сессии с соответствующим сообщением
     * 
     * При положительном/отрицательном исходе создания резюме,
     * создаётся flash-сессия с соответствующим сообщением
     * @return string результат рендеринга
     * @return Response если операция создания резюме пройдёт успешно, 
     * выполнится редирект на главную страницу
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws InvalidConfigException if a dependency cannot be resolved or if a dependency cannot be fulfilled.
     * @throws NotInstantiableException If resolved to an abstract class or an interface (since 2.0.9)
     * @throws ValidationFailedException если пользователь не является автором резюме с id = $id
     */
    public function actionResumeEdit($id)
    {
        $helper = Yii::$container->get(ResumeGetInterface::class);
        $resume = $helper->findById($id, true);

        if ($resume->author_id != $this->view->params['user']->id) {
            throw new ValidationFailedException('Вы не являетесь автором этого резюме');
        }

        $model = new CreateResumForm;

        if ($model->load(Yii::$app->request->post(), 'CreateResumForm')) {
            $parser = Yii::$container->get(Parsedown::class);

            // if (Yii::$app->request->post('publish'))
            $status = Resume::STATUS_NOT_CONFIRMED;

            if (Yii::$app->request->post('draft')) {
                $status = Resume::STATUS_ON_DRAFT;
            }

            $resume->status = $status;

            try {
                $model->createResum($resume, $parser);

                // if ($status == Resume::STATUS_NOT_CONFIRMED)
                $flash_message = 'Ожидайте подтверждения корректности резюме. После вы увидите своё резюме в списке';

                if ($status == Resume::STATUS_ON_DRAFT) {
                    $flash_message = 'Ваше резюме сохранено в черновик';
                }

                Yii::$app->session->setFlash('success', $flash_message);
                
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(UrlGen::home());
        }

        $model->attributes = $resume->attributes;

        return $this->render('resume_create_form', compact('model'));
    }

    /**
     * Экшен рендерит страницу с формой создания вакансии.
     * 
     * Если имеются соответствующие POST-данные, 
     * то производится заполнение модели данными
     * и вызов соответствующего метода создания 
     * вакансии в БД.
     * 
     * При положительном/отрицательном исходе создания вакансии,
     * создаётся flash-сессия с соответствующим сообщением
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
            $parser = Yii::$container->get(Parsedown::class);

            try {
                $model->createVacancie($vacancie, $parser);
                Yii::$app->session->setFlash('success', 'Ожидайте подтверждения корректности вакансии. После вы увидите свою вакансию в списке');
            } catch (ValidationFailedException|DBDataSaveException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->redirect(UrlGen::allVacancies());
        }

        return $this->render('vacancie_create_form', compact('model'));
    }

    /**
     * Метод отвечает за отображение страницы 
     * профиля пользователя с id = $id
     * 
     * В методе производится получение объекта пользователя
     * со всеми нужными связями и отдельное получение количества
     * лайков пользователя через класс-хелпер UserGetHelper.
     * 
     * Полученные данные передаются в файл вида
     * @param int $id идентификатор пользователя
     * @return string результат рендеринга
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     * @throws IDNotFoundException если пользователь не найден
     */
    public function actionProfile($id)
    {
        $helper = Yii::$container->get(UserGetInterface::class);
        $user = $helper->getByIdWithRelations($id);
        $likesCount = $helper->getLikesCount($id);

        return $this->render('profile', compact('user', 'likesCount'));
    }

    public function actionError()
    {
        return $this->render('error');
    }

    /**
     * Метод отвечает за отправку инструкции
     * подтверждения аккаунта на почту пользователя
     * 
     * Сперва генерируется содержимое письма, используя UrlGen::fullConfirmEmailPage().
     * 
     * Далее производится отправка письма и создание флеш-сессим
     * с результатом отправки.
     * @return Response the current response object
     */
    public function actionSendMailToConfirm()
    {
        $mailer = Yii::$app->mailer;
        $link = UrlGen::fullConfirmEmailPage($this->view->params['user']->token);
        $message = Yii::t('main',"Для подтверждения аккаунта, перейдите по следующей одноразовой ссылке") . " - $link";

        try {
            $mailer->compose()
                ->setFrom('') // УКАЖИТЕ АДРЕС ОТПРАВИТЕЛЯ
                ->setTo($this->view->params['user']->email)
                ->setSubject(Yii::t('main','Подтверждение аккаунта Hexlet'))
                ->setTextBody($message)
                ->send();
            
            Yii::$app->session->setFlash('success', Yii::t('main','На вашу почту отправлена инструкция для подтверждения...'));
        } catch (Exception) {
            Yii::$app->session->setFlash('error', Yii::t('main','При отправке письма, что-то пошло не так'));
        }

        return $this->redirect(UrlGen::account('settings'));
    }
}
