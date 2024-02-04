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
?>
<h1>Apples</h1>
