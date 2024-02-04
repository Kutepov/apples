<?php

namespace backend\controllers;

use backend\services\AppleService;
use common\entities\Apple;
use common\exceptions\NotFoundException;
use common\models\AppleForm;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Exception;
use yii\web\Controller;

class AppleController extends Controller
{
    private AppleService $appleService;

    public function behaviors(): array
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'create',
                            'eat',
                            'fall-to-ground',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function __construct($id, $module, AppleService $appleService, $config = [])
    {
        $this->appleService = $appleService;
        parent::__construct($id, $module, $config);
    }

    public function actionCreate($count): bool
    {
        try {
            return $this->appleService->create((int)$count);
        } catch (\Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
    }

    public function actionEat($id, $size): ?Apple
    {
        try {
            $appleForm = new AppleForm();
            $appleForm->size = (int)$size;
            if (!$appleForm->validate()) {
                throw new Exception($appleForm->getFirstError('size'));
            }

            return $this->appleService->eat((int)$id, (int)$size);
        } catch (NotFoundException $exception) {
            throw new NotFoundHttpException($exception->getMessage());
        } catch (Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
    }

    public function actionFallToGround($id): Apple
    {
        try {
            return $this->appleService->fallToGround((int)$id);
        } catch (Exception $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        }
    }
}