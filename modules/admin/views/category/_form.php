<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use app\modules\admin\models\Categories;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
    $data = ['0' => ''];
    foreach ($categories as $category) {
        $data += [$category->id => $category->title];
    }
    ?>

    <?= $form->field($model, 'parent_id')->dropDownList($data); ?>

    <?= $form->field($model, 'category_alias')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'file')->widget(FileInput::class, [
            'options' => ['accept' => 'image/*'],
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
