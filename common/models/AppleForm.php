<?php

namespace common\models;

use yii\base\Model;

/**
 * Apple form
 */
class AppleForm extends Model
{
    public int $size;

    public function rules(): array
    {
        return [
            [['size'], 'required'],
            ['size', 'integer', 'min' => 1, 'max' => 100],
        ];
    }
}
