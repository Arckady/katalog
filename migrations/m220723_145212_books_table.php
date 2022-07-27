<?php

use yii\db\Migration;

/**
 * Class m220723_145212_books_table
 */
class m220723_145212_books_table extends Migration
{
    public function up()
    {

        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'isbn' => $this->string(),
            'page_count' => $this->string(),
            'thumbnail' => $this->string(),
            'image_name' => $this->string(),
            'status' => $this->string(),
            'autors' => $this->string()
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
        $this->alterColumn('books', 'id', $this->smallinteger(). ' NOT NULL AUTO_INCREMENT');
        $this->alterColumn('books','image_name', $this->string()->defaultValue('books/placeholder.jpg'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
       $this->dropTable('books');
   }
}
