<?php
/** @var View $this */
/** @var ActiveDataProvider $dataProvider */

use yii\web\View;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use common\entities\Apple;
use backend\assets\AppleAsset;
use yii\helpers\Html;

$this->title = Yii::$app->name;
AppleAsset::register($this);

echo Html::label('Создать');
echo Html::input(
    'number',
    'eat-part',
    '',
    [
        'class' => 'form-control input-create-apple'
    ],
);
echo Html::label('яблок');
echo Html::button(
    'Создать',
    [
        'class' => 'btn btn-success btn-eat-apple',
        'onclick' => 'apple.create($(".input-create-apple").val())'
    ]
);

Pjax::begin(['id' => 'apples']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => false,
    'columns' => [
        'id',
        [
            'attribute' => 'color',
            'value' => function (Apple $model) {
                $labelClass = [
                    Apple::COLOR_GREEN => 'success',
                    Apple::COLOR_YELLOW => 'warning',
                    Apple::COLOR_RED => 'danger',
                ];
                return Html::tag(
                    'span',
                    Apple::COLORS_VALUES[$model->color],
                    ['class' => 'label label-' . $labelClass[$model->color]]
                );
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'status',
            'value' => function (Apple $model) {
                $labelClass = [
                    Apple::STATUS_ON_TREE => 'success',
                    Apple::STATUS_FELL => 'warning',
                    Apple::STATUS_ROTTEN => 'default',
                ];
                return Html::tag(
                    'span',
                    Apple::STATES_VALUES[$model->getState()],
                    ['class' => 'label label-' . $labelClass[$model->getState()]]
                );
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'size',
            'value' => function (Apple $model) {
                $percent = $model->size * 100;
                return '<div class="progress">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: ' . $percent . '%">
                                ' . $percent . '%
                            </div>
                        </div>';
            },
            'format' => 'raw',
        ],
        [
            'label' => 'Действия',
            'options' => [
                'style' => 'width: 150px;',
            ],
            'value' => function (Apple $model) {
                return $this->render('/apples/_actions', compact('model'));
            },
            'format' => 'raw',
        ]
    ],
]);
Pjax::end();