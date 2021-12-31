<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public $layout = 'main';

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

    public function actionAccount($tab)
    {
        return $this->render('account-' . $tab);
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
