<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Categories;
use app\models\BookCategory;
use app\models\Books;
use app\modules\admin\models\Options;

class CategoryController extends Controller
{
	public function actionView($alias)
	{
		$category = Categories::find()->where('category_alias=:alias')->addParams([':alias' => $alias])->one();
		if (empty($category)) {
			throw new NotFoundHttpException('Такая книга не найдена');
		}

		$chain = BookCategory::find()->asArray()->where(['id_category' => $category->id])->all();
		$array = [];
		foreach ($chain as $item) {
			array_push($array, $item['id_book']);
		}

		$query = Books::find()->where(['in', 'id', $array]);
		$options = Options::findOne(1);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $options->books_count, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();

		return $this->render('view', compact('category', 'books', 'pages'));
	}
}