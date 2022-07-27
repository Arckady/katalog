<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $category_alias
 *
 * @property BookCategory[] $bookCategories
 */
class Categories extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_alias', 'image'], 'string', 'max' => 255],
            [['title', 'category_alias'], 'required'],
            [['parent_id'], 'integer'],
            [['category_alias'], 'unique'],
            [['image'], 'default', 'value' => 'placeholder.jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'title' => 'Заголовок',
            'category_alias' => 'Алиас',
            'image' => 'Изображение',
            'file' => 'Изображение'
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'parent_id']);
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

    public function setCategoryBooks()
    {
        return $this->hasMany(BookCategory::class, ['id_category' => 'id']);
    }

    public function setBooks()
    {
        return $this->hasMany(Books::class, ['id' => 'id_book'])
        ->via('categoryBooks');
    }

    public function beforeSave($insert)
    {
        
        if ($file = UploadedFile::getInstance($this, 'file')) {
            $dir = 'categories/';
            $file_name = uniqid() . '_' . $this->category_alias . '.' . $file->extension;
            $this->image = $dir . $file_name;
            $file->saveAs($this->image);
        }

        return parent::beforeSave($insert);
    }
}
