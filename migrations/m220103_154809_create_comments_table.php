<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m220103_154809_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'resume_id' => $this->integer(),
            'pub_date' => $this->bigInteger(),
            'parent_comment_id' => $this->integer(),
            'content' => $this->text(),
        ]);

        $this->createIndex(
            'idx-comments-author_id',
            '{{%comments}}',
            'author_id'
        );

        $this->addForeignKey(
            'fk-comments-author_id',
            '{{%comments}}',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-comments-resume_id',
            '{{%comments}}',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-comments-resume_id',
            '{{%comments}}',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-comments-parent_comment_id',
            '{{%comments}}',
            'parent_comment_id'
        );

        $this->addForeignKey(
            'fk-comments-parent_comment_id',
            '{{%comments}}',
            'parent_comment_id',
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
        $this->dropForeignKey('fk-comments-resume_id', '{{%comments}}');
        $this->dropIndex('idx-comments-resume_id', '{{%comments}}');

        $this->dropForeignKey('fk-comments-author_id', '{{%comments}}');
        $this->dropIndex('idx-comments-author_id', '{{%comments}}');

        $this->dropForeignKey('fk-comments-parent_comment_id', '{{%comments}}');
        $this->dropIndex('idx-comments-parent_comment_id', '{{%comments}}');

        $this->dropTable('{{%comments}}');
    }
}
