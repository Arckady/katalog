<?php


/** @var yii\web\View $this */

$this->title = $book->title;
?>
<?php if ($book->status == 'PUBLISH'): ?>
	<h1><?= $book->title ?></h1>

		<div class="book__content-wraper d-flex">
			<!-- <img src="/books/placeholder.jpg" class="img-thumbnail" alt=""> -->
			<img src="/<?= $book->image_name ?>" class="img-thumbnail" alt="">
			<div class="book__description">
				<div class="h4">Описание</div>
				<p><?= $book->description ?></p>
				<p>Страниц: <?= $book->page_count ?></p>
				<p>Артикул: <?= $book->isbn ?></p>
				<span>Категории: 
					<?php foreach ($book->categories as $category): ?>
						<a href="/category/<?= $category->category_alias ?>" class="badge badge-primary"><?= $category->title ?> </a>
					<?php endforeach; ?>
				</span>
			</div>
		</div>
<?php else: ?>
	<h1>Книга не найдена</h1>
<?php endif; ?>
