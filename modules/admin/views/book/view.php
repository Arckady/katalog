<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= Yii::$app->session->getFlash('success'); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'isbn',
            'page_count',
            [
                'attribute' => 'categories',
                'label' => 'Категории',
                'value' => function($data){
                    if (isset($data->categories)) {
                        $cat = '';
                        foreach ($data->categories as $category) {
                            $cat .= $category->title . ', ';
                        }
                        return $cat;
                    }
                }
            ],
            [
                'attribute' => 'image_name',
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => Html::img(Url::toRoute('/' . $model->image_name), ['style' => 'width: 150px']),
            ],
            'status',
            [
                'attribute' => 'autors',
                'value' => function($data){
                    if (isset($data->autors)) {
                        return implode(', ', unserialize($data->autors));
                    } else {
                        return '';
                    }
                }
            ],
        ],
    ]) ?>

</div>
