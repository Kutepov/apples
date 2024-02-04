<?php
/** @var View $this */

/** @var Apple $model */

use yii\web\View;
use common\entities\Apple;
use yii\helpers\Html;

if ($model->canFallToGround()) {
    echo Html::button(
        'Упасть',
        ['class' => 'btn btn-primary btn-fall-apple', 'onclick' => 'apple.fall(' . $model->id . ')']
    );
}

if ($model->canEat()) {
    echo Html::label('Откусить');
    echo Html::input(
        'number',
        'eat-part',
        '',
        [
            'max' => $model->size * 100,
            'min' => 1,
            'class' => 'form-control input-eat-apple input-eat-apple-' . $model->id,
        ],
    );
    echo Html::label('часть');
    echo Html::button(
        'Откусить',
        [
            'class' => 'btn btn-primary btn-eat-apple',
            'onclick' => 'apple.eat(' . $model->id . ', $(".input-eat-apple-' . $model->id . '").val())'
        ]
    );
}