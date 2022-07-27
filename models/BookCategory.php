<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_category".
 *
 * @property int $id
 * @property int|null $id_book
 * @property int|null $id_category
 *
 * @property Books $book
 * @property Categories $category
 */
class BookCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_category';
    }

}
