<?php

use yii\db\Migration;

/**
 * Class m220724_202245_book_category
 */
class m220724_202245_book_category extends Migration
{
    public function up()
    {

        $this->createTable('book_category', [
            'id' => $this->primaryKey(),
            'id_book' => $this->smallinteger(),
            'id_category' => $this->smallinteger(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
        $this->addForeignKey(
            'chain_to_book',
            'book_category',
            'id_book',
            'books',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'chain_to_category',
            'book_category',
            'id_category',
            'categories',
            'id',
            'CASCADE'
        );

    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
     $this->dropTable('book_category');
 }
}
