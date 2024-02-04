<?php

namespace frontend\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     */
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
