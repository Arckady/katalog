<?php

use yii\db\Migration;

/**
 * Class m220723_191211_categories_table
 */
class m220723_191211_categories_table extends Migration
{
    public function up()
    {

        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->smallinteger(),
            'title' => $this->string(),
            'image' => $this->string(),
            'category_alias' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
        $this->alterColumn('categories', 'id', $this->smallinteger(). ' NOT NULL AUTO_INCREMENT');
        $this->alterColumn('categories', 'parent_id', $this->smallinteger(). ' NOT NULL');
        $this->alterColumn('categories','image', $this->string()->defaultValue("categories/placeholder.jpg"));
        $this->insert('categories', [
            'parent_id' => '0',
            'title' => 'Новинка',
            'image' => 'categories/new.jpg',
            'category_alias' => 'new',
        ]);
        $this->insert('categories', [
            'parent_id' => '1',
            'title' => 'Test',
            'image' => 'categories/placeholder.jpg',
            'category_alias' => 'test',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
       $this->dropTable('categories');
    }
}
