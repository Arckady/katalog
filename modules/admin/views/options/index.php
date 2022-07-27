<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Options */

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
?>
<div class="options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
