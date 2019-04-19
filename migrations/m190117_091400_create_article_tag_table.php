<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m190117_091400_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);
        /*
        // creates index for column user_id
        $this->createIndex(
                'idx-article_id',
                'comment',
                'article_id'
        );
        
        // add foreign key for table user
        $this->addForeignKey(
                'fk-article_id',
                'comment',
                'article-id',
                'article',
                'id',
                'CASCADE'
        );
        
        // creates index for column article_id
        $this->createIndex(
                'idx-tag_id',
                'article_tag',
                'tag_id'
        );
        
        
        // creates index for column user_id
        $this->createIndex(
                'idx-tag_id',
                'article_tag',
                'tag_id'
        );
        
        // add foreign key for table user
        $this->addForeignKey(
                'fk-tag-user_id',
                'article_tag',
                'tag-id',
                'tag',
                'id',
                'CASCADE'
        );
        
        // creates index for column article_id
        $this->createIndex(
                'idx-tag_id',
                'article_tag',
                'tag_id'
        );
         
         */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_tag');
    }
}
