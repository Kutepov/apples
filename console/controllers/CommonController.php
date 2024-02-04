<?php

namespace console\controllers;

use yii\console\Controller;
use yii\console\widgets\Table;

class CommonController extends Controller
{
    protected function showErrors($errors): string
    {
        $rows = [];
        foreach ($errors as $index => $error) {
            $value = '';
            foreach ($error as $item) {
                $value .= $item . "\n";
            }
            $rows[] = [$index, $value];
        }
        return Table::widget([
            'headers' => ['Field', 'Value'],
            'rows' => $rows
        ]);
    }
}