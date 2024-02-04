<?php

namespace backend\services;

use common\entities\Apple;
use common\exceptions\NotFoundException;
use Exception;
use Yii;

class AppleService
{
    public function create(int $count): bool
    {
        for ($i = 1; $i <= $count; $i++) {
            $apple = Apple::create();
            $this->saveApple($apple);
        }

        return true;
    }

    public function eat(int $id, int $part): ?Apple
    {
        $apple = $this->findApple($id);
        $apple->eat($part);

        if ($apple->isEaten()) {
            $apple->delete();
            return null;
        }

        return $this->saveApple($apple);
    }

    public function fallToGround(int $id): Apple
    {
        $apple = $this->findApple($id);
        $apple->fallToGround();
        $this->saveApple($apple);
        return $apple;
    }

    private function saveApple(Apple $apple): Apple
    {
        if (!$apple->save()) {
            Yii::error([
                'values' => $apple->attributes,
                'errors' => $apple->errors,
            ]);
            throw new Exception('Ошибка сохранения яблока.');
        }

        return $apple;
    }

    private function findApple(int $id): Apple
    {
        if ($apple = Apple::findOne($id)) {
            return $apple;
        }

        throw new NotFoundException('Яблоко не найдено.');
    }
}