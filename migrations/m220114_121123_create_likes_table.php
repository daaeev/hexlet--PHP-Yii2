<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%likes}}`.
 */
class m220114_121123_create_likes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%likes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'comment_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-likes-user_id',
            'likes',
            'user_id'
        );

        $this->addForeignKey(
            'fk-likes-user_id',
            'likes',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-likes-comment_id',
            'likes',
            'comment_id'
        );

        $this->addForeignKey(
            'fk-likes-comment_id',
            'likes',
            'comment_id',
            'comments',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-likes-comment_id', 'likes');
        $this->dropIndex('idx-likes-comment_id', 'likes');
        $this->dropForeignKey('fk-likes-user_id', 'likes');
        $this->dropIndex('idx-likes-user_id', 'likes');
        $this->dropTable('{{%likes}}');
    }
}
