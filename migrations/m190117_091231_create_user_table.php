<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190117_091231_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string()->defaultValue(NULL),
            'password' => $this->string(),
            'photo' => $this->string()->defaultValue(NULL),
            'isAdmin' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
