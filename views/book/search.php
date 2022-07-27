<?php


/** @var yii\web\View $this */

$this->title = 'Поиск ' . $q;
?>
<h1 class="text-center mb-4"><?= 'Поиск ' . $q ?></h1>

<?php foreach ($books as $book) : ?>
    <div class="card mb-3" style="max-width: 940px;">
      <div class="row no-gutters">
        <div class="col-md-2">
            <a href="/book/<?= $book->id ?>">
              <img src="/<?= $book->image_name ?>" alt="<?= $book->title ?>">
          </a>
      </div>
      <div class="col-md-10">
          <div class="card-body">
            <a href="/book/<?= $book->id ?>">
                <h5 class="card-title"><?= $book->title ?></h5>
            </a>
            <p class="card-text"><? echo substr($book->description, 0, 300) . '...' ?></p>
            <p class="card-text"><small class="text-muted"><?php echo implode(', ', unserialize($book->autors)); ?></small></p>
        </div>
    </div>
</div>
</div>
<?php endforeach; ?>

<?= \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
    'nextPageCssClass' => 'page-link',
    'prevPageCssClass' => 'page-link',
    'pageCssClass' => 'page-link',
]) ?>
