<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property int|null $books_count
 * @property string|null $email
 * @property string|null $link
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['books_count'], 'integer'],
            [['email', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'books_count' => 'Books Count',
            'email' => 'Email',
            'link' => 'Link',
        ];
    }
}
