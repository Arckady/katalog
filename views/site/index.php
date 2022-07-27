<?php

/** @var yii\web\View $this */

$this->title = 'Catalog';
?>

<div class="row">
    <?php foreach ($categories as $category) : ?>
        <div class="col-sm-4">
            <a href="/category/<?= $category->category_alias ?>" class="d-flex flex-column align-items-center">
                <img src="/<?= $category->image ?>" class="img-thumbnail" alt="<?= $category->title ?>">
                <span class="std-font"><?= $category->title ?></span>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<div class="d-flex justify-content-center mt-4">
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        'nextPageCssClass' => 'page-link',
        'prevPageCssClass' => 'page-link',
        'pageCssClass' => 'page-link',
    ]) ?>
</div>