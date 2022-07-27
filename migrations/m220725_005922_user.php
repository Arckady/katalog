<?php

use yii\db\Migration;

/**
 * Class m220725_005922_user
 */
class m220725_005922_user extends Migration
{
    public function up()
    {

        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(),
            'password' => $this->string(),
            'auth_key' => $this->string(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
        $this->alterColumn('user', 'id', $this->smallinteger(). ' NOT NULL AUTO_INCREMENT');
        $this->insert('user', [
            'username' => 'admin',
            'password' => '$2y$13$73Q9.bhk36zCKU.JsDFUTuoh1/EFc7ye6pgQqBODiIDqT55JUBqlq'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
       $this->dropTable('user');
    }
}
