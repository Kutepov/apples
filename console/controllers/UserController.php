<?php

namespace console\controllers;

use common\entities\Apple;
use common\models\User;
use yii\console\ExitCode;
use yii\console\widgets\Table;

/**
 * Manage users.
 */
class UserController extends CommonController
{
    /**
     * Create user.
     */
    public function actionCreate(string $username, string $password): int
    {
        try {
            $user = new User();
            $user->username = $username;
            $user->setPassword($password);
            $user->generateAuthKey();
            $user->status = user::STATUS_ACTIVE;
            if ($user->save()) {
                $this->stdout(Table::widget([
                    'headers' => ['Email', 'Password'],
                    'rows' => [
                        [$username, $password],
                    ],
                ]));
                return ExitCode::OK;
            }

            $this->stdout($this->showErrors($user->errors));
            return ExitCode::DATAERR;
        } catch (\Exception $exception) {
            $this->stderr($exception->getMessage());
            return ExitCode::DATAERR;
        }
    }
}