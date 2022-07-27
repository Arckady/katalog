<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "
            <div class='col-md-6'>
            <p>{label}</p> \n {input} \n
            <div>{error}</div>
            </div>
            ",
        ],
        'options' => ['id' => 'updateBook']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?php
    echo $form->field($model, 'file')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
    ]);
    ?>

    <?php
    $data = [];
    if (!empty($model->autors)) {
        $autors = unserialize($model->autors);

        foreach ($autors as $autor) {
            $data += [$autor => $autor];
        }
        $model->autors = $autors;
    }
    echo $form->field($model, 'autors')->widget(Select2::class, [
        'data' => $data,
        'options' => ['placeholder' => 'Авторы','multiple' => true],
        'theme' => 'krajee-bs3',
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10,
        ],
    ])->label('Авторы');
    ?>

    <?php
    // $cats = [];
    // if (!empty($model->categories)) {
    //     foreach ($model->categories as $category) {
    //         $cats += [$category->id => $category->title];
    //     }
    // }

    $allcats =[];
    foreach ($allcategories as $allcat) {
        $allcats += [$allcat->id => $allcat->title];
    }
    // print_r($model->havecats);
    // echo '<pre>';
    // print_r($allc);
    // echo '</pre>';die;
    // $model->categories =  ['Mobile'];
    echo $form->field($model, 'categories')->widget(Select2::class, [
        'data' => $allcats,
        'options' => ['placeholder' => 'Категории','multiple' => true],
        'theme' => 'krajee-bs3',
        'pluginOptions' => [
            'tokenSeparators' => [',', ' '],
        ],
    ])->label('Категории');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохрнить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
