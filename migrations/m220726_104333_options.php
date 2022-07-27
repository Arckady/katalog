<?php

use yii\db\Migration;

/**
 * Class m220726_104333_options
 */
class m220726_104333_options extends Migration
{
    public function up()
    {

        $this->createTable('options', [
            'id' => $this->primaryKey(),
            'books_count' => $this->integer(),
            'email' => $this->string(),
            'link' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
        $this->insert('options', [
            'books_count' => '6',
            'email' => 'testovoe.arckady@yandex.ru',
            'link' => 'https://gitlab.com/prog-positron/test-app-vacancy/-/raw/master/books.json',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
       $this->dropTable('options');
   }
}
