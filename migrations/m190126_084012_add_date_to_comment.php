<?php

use yii\db\Migration;

/**
 * Class m190126_084012_add_date_to_comment
 */
class m190126_084012_add_date_to_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'data', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('comment', 'data');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        
    }

    public function down()
    {
        
    }
    */
}
