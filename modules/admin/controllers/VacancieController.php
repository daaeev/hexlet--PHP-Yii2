<?php

namespace app\modules\admin\controllers;

use app\exceptions\IDNotFoundException;
use app\models\Vacancie;
use app\models\VacancieSearch;
use yii\web\Controller;
use Yii;

/**
 * VacancieController implements the CRUD actions for Vacancie model.
 */
class VacancieController extends Controller
{
    /**
     * Lists all Vacancie models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VacancieSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vacancie model.
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
     * Метод отвечает за изменение статуса вакансии
     * с идентификатором $id.
     * @param int $id идентификатор вакансии из таблицы vacancie
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
     * Finds the Vacancie model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Vacancie the loaded model
     * @throws IDNotFoundException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vacancie::findOne($id)) !== null) {
            return $model;
        }

        throw new IDNotFoundException('Вакансии с id ' . $id . ' не существет');
    }
}
