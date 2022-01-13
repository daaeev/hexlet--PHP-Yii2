<?php

namespace app\modules\admin\controllers;

use app\components\helpers\interface\RoleHelperInterface;
use app\exceptions\DBDataDeleteException;
use app\exceptions\DBDataSaveException;
use app\exceptions\UndefinedRoleException;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use yii\rbac\ManagerInterface;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Страница выбора ролей для пользователя
     * @param int $id ID пользователя, роль которого следует изменить
     * @return mixed
     * @throws InvalidArgumentException если файл вида или шаблона не найден
     */
    public function actionRole($id)
    {
        $authManager = Yii::$container->get(ManagerInterface::class);
        $helper = Yii::$container->get(RoleHelperInterface::class, [$authManager]);

        // Если post-данные формы приняты, выполнить функционал присваивания роли,
        // инаце - отобразить страницу role
        if ($role = Yii::$app->request->post('role')) {
            $user = User::findOne($id);

            // Состояние статуса до выполнения функционала присваивания роли.
            // При возникновении ошибки - статус пользователя вернётся к этому состоянию
            $userPrevStatus = $user->status;

            // Если пользователь был найден, то присвоить роль и изменить его статус,
            // иначе - создать flash-сессию с название ошибки и перейти на страницу index
            if ($user) {

                // Если присваивание роли и изменение статуса проходит без ошибок - 
                // перейти на страницу view текущего пользователя,
                // иначе - откатить все действия, создать flash-сессию с описанием ошибки и
                // перейти на страницу view текущего пользователя
                try {
                    $helper->assignRole($role, $id);
                    $helper->setUserStatus($user, $role);
                } catch (
                    DBDataDeleteException|
                    UndefinedRoleException|
                    DBDataSaveException $e
                ) {
                    $authManager->revokeAll($id);
                    $user->status = $userPrevStatus;
                    $user->save();
                    Yii::$app->session->setFlash('warning', $e->getMessage());
                }

                return $this->redirect(['/admin/user/view', 'id' => $id]);
            } else {
                Yii::$app->session->setFlash('error', 'Пользователь с id ' . $id . ' не найден');
                return $this->render('index');
            }
        }
        
        $roles = $helper->getRoles();

        return $this->render('role', compact('id', 'roles'));
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
