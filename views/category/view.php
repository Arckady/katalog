<?php


/** @var yii\web\View $this */

$this->title = $category->title;
?>

<h1><?= $category->title ?></h1>

<?php if (!empty($category->category)) : ?>
    <h2>Категории</h2>
    <div class="row">
        <?php foreach ($category->category as $cat) : ?>
            <div class="col-sm-4">
                <a href="/category/<?= $cat->category_alias ?>" class="d-flex flex-column align-items-center">
                    <img src="/<?= $cat->image ?>" class="img-thumbnail" alt="<?= $cat->title ?>">
                    <span class="std-font"><?= $cat->title ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php
// echo '<pre>';
        // print_r($books);
        // echo '</pre>';die;
?>
<?php if (!empty($books)) : ?>
    <h2>Книги</h2>
    <div class="row">
        <?php foreach ($books as $book) : ?>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <a href="/book/<?= $book->id ?>" class="d-flex flex-column align-items-center">
                    <img src="/<?= $book->image_name ?>" class="img-thumbnail" alt="<?= $book->title ?>">
                    <span class="std-font"><?= $book->title ?></span>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

<?php if (empty($category->category) && empty($books)): ?>
    <h2>Категория пуста</h2>
<?php endif; ?>


    <div class="d-flex justify-content-center mt-4">
    <?= \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        'nextPageCssClass' => 'page-link',
        'prevPageCssClass' => 'page-link',
        'pageCssClass' => 'page-link',
    ]) ?>
</div>