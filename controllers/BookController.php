<?php

namespace app\controllers;

use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Books;

class BookController extends Controller
{
	public function actionView($id)
	{
		$book = Books::findOne($id);
		if (empty($book)) {
			throw new NotFoundHttpException('Такая книга не найдена');
		}

		return $this->render('view', compact('book'));
	}

	public function actionSearch()
	{
		$q = trim(\Yii::$app->request->get('q'));

		if(!$q){
            return $this->render('search');
        }

        $query = Books::find()->where(['like', 'title', $q])->orWhere(['like', 'autors', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $books = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', compact('books', 'pages', 'q'));
	}
}