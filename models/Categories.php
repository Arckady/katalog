<?php

namespace app\models;

use yii\db\ActiveRecord;

class Categories extends ActiveRecord
{

    public function getCategory()
    {
        return $this->hasMany(Categories::class, ['parent_id' => 'id']);
    }

    public function getCategoryBooks()
    {
        return $this->hasMany(BookCategory::class, ['id_category' => 'id']);
    }

    public function getBooks()
    {
        return $this->hasMany(Books::class, ['id' => 'id_book'])
        ->via('categoryBooks');
    }

}