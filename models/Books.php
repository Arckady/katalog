<?php

namespace app\models;

use yii\db\ActiveRecord;

class Books extends ActiveRecord
{

	// public function getCategories()
 //    {
 //        return $this->hasMany(Categories::className(), ['id' => 'id_category'])->viaTable('book_category', ['id_book', 'id']);
 //    }


    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::class, ['id_book' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['id' => 'id_category'])
        ->via('bookCategories');
    }

}