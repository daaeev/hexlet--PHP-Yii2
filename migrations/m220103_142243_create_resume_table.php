<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume}}`.
 */
class m220103_142243_create_resume_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume}}', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'english' => $this->string(),
            'github' => $this->string(),
            'contact' => $this->string(),
            'description' => $this->text(),
            'skills' => $this->text(),
            'achievements' => $this->text(),
        
            'pub_date' => $this->bigInteger(),
            'author_id' => $this->integer(),
            'views' => $this->integer(),
            'status' => $this->tinyInteger()->defaultValue(0),
        ]);

        $this->createIndex(
            'idx-resume-author_id',
            '{{%resume}}',
            'author_id'
        );

        $this->addForeignKey(
            'fk-resume-author_id',
            '{{%resume}}',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-resume-author_id', '{{%resume}}');
        $this->dropIndex('idx-resume-author_id', '{{%resume}}');
        $this->dropTable('{{%resume}}');
    }
}
