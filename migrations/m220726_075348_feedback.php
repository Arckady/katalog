<?php

use yii\db\Migration;

/**
 * Class m220726_075348_feedback
 */
class m220726_075348_feedback extends Migration
{
    public function up()
    {

        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'body' => $this->text(),
            'time' => $this->timestamp(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
        $this->alterColumn('feedback','time', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
       $this->dropTable('feedback');
   }
}
