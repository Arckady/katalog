<?php

namespace app\modules\admin\models;

use Yii;
use yii\web\UploadedFile;
// use baibaratsky\yii\behaviors\model\SerializedAttributes;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $isbn
 * @property string|null $page_count
 * @property string|null $thumbnail
 * @property string|null $image_name
 * @property string|null $status
 * @property string|null $autors
 *
 * @property BookCategory[] $bookCategories
 */
class Books extends \yii\db\ActiveRecord
{

    public $file;
    public $havecats;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    // public function behaviors()
    // {
    //     return [
    //         'serializedAttribute' => [
    //             'class' => SerializedAttributes::className(),
    //             'attributes' => ['autors']
    //         ]
    //     ];
    // }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title', 'isbn', 'page_count', 'thumbnail', 'image_name', 'status'], 'string', 'max' => 255],
            [['title'], 'required'],
            [['image_name'], 'default', 'value' => 'placeholder.jpg'],
            [['autors', 'categories'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'isbn' => 'Isbn',
            'page_count' => 'Страниц',
            'thumbnail' => 'Thumbnail',
            'image_name' => 'Image Name',
            'status' => 'Статус',
            'autors' => 'Авторы',
        ];
    }

    public function afterFind()
    {
        $this->havecats = \yii\helpers\ArrayHelper::map($this->categories, 'id', 'title');
    }

    public function getBookCategories()
    {
        return $this->hasMany(BookCategory::class, ['id_book' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['id' => 'id_category'])
        ->via('bookCategories');
    }

    public function setBookCategories()
    {
        return $this->hasMany(BookCategory::class, ['id_book' => 'id']);
    }

    public function setCategories()
    {
        return $this->hasMany(Categories::class, ['id' => 'id_category'])
        ->via('bookCategories');
    }

    public function beforeSave($insert)
    {
        
        $this->autors = serialize($this->autors);
        
        if ($file = UploadedFile::getInstance($this, 'file')) {
            $dir = 'books/';
            $file_name = uniqid() . '_' . $file->name . '.' . $file->extension;
            $this->image_name = $dir . $file_name;
            $file->saveAs($this->image_name);
        }



        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        $post = Yii::$app->request->post();
        $cats = $post['Books']['categories'];

        if (is_array($cats)) {
            $oldcat = [];
            foreach ($this->categories as $category) {
                array_push($oldcat, $category->id);
            }
            $catsToDelete = array_diff($oldcat, $cats );
            $catsToInsert = array_diff($cats, $oldcat);
            foreach ($catsToDelete as $item) {
                $delcat = BookCategory::find()->where(['id_book' => $this->id])->andWhere(['id_category' => $item])->one();
                $delcat->delete();
            }
            foreach ($catsToInsert as $item) {
                $newcat = new BookCategory;
                $newcat->id_book = $this->id;
                $newcat->id_category = $item;
                $newcat->save();
            }

        } else {
            BookCategory::deleteAll(['id_book' => $this->id]);
        }
    }

}
