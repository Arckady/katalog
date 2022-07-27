<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Books;
use app\modules\admin\models\Categories;

class MainController extends AppAdminController
{
    
    public function actionIndex()
    {
        $books = Books::find()->count();
        $categories = Categories::find()->count();

        return $this->render('index', compact('books', 'categories'));
    }
}
