<?php

namespace console\controllers;

use common\entities\Apple;
use yii\console\ExitCode;

/**
 * Manage apples.
 */
class AppleController extends CommonController
{
    /**
     * Set apple rotten.
     */
    public function actionSetRotten(int $id): int
    {
        if (!$apple = Apple::findOne($id)) {
            $this->stderr('Яблоко не найдено.' . PHP_EOL);
            return ExitCode::DATAERR;
        }

        if (!($apple->getState() === Apple::STATUS_FELL)) {
            $this->stderr('Яблоко либо уже гнилое, либо на дереве.' . PHP_EOL);
            return ExitCode::DATAERR;
        }

        $apple->fell_at -= Apple::ROTTEN_TIME;
        $apple->save(false);

        return ExitCode::OK;
    }
}