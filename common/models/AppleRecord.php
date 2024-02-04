<?php

namespace common\models;

use common\entities\Apple;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string $color
 * @property int $created_at
 * @property int|null $fell_at
 * @property int|null $status
 * @property float $size
 */
class AppleRecord extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'apples';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules(): array
    {
        return [
            [['color', 'size'], 'required'],
            [['color'], 'string'],
            [['color'], 'in', 'range' => Apple::COLORS],
            [['status'], 'in', 'range' => Apple::STATUSES],
            [['created_at', 'fell_at', 'status', 'updated_at'], 'integer'],
            [['size'], 'double', 'max' => 1, 'min' => 0],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'color' => 'Цвет',
            'status' => 'Статус',
            'size' => 'Размер',
        ];
    }
}
