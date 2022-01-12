<?php

namespace app\modules\admin\controllers;

use app\exceptions\IDNotFoundException;
use app\models\Resume;
use app\models\ResumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
{
    /**
     * Lists all Resume models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resume model.
     * @param int $id ID
     * @return mixed
     * @throws IDNotFoundException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Метод отвечает за изменение статуса резюме
     * с идентификатором $id.
     * @param int $id идентификатор резюме из таблицы resume
     * @param int $status устанавливаемый статус
     * @return Response the current response object
     */
    public function actionSetStatus($id, $status)
    {
        try {
            $resume = $this->findModel($id);
            $resume->status = $status;

            if ($resume->save(false)) {
                Yii::$app->session->setFlash('success', 'Статус успешно изменен');
            }
        } catch (IDNotFoundException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Resume the loaded model
     * @throws IDNotFoundException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        }

        throw new IDNotFoundException('Резюме с id ' . $id . ' не существет');
    }
}
