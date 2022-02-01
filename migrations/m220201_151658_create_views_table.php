<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%views}}`.
 */
class m220201_151658_create_views_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%views}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'resume_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-views-user_id',
            'views',
            'user_id'
        );

        $this->addForeignKey(
            'fk-views-user_id',
            'views',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-views-resume_id',
            'views',
            'resume_id'
        );

        $this->addForeignKey(
            'fk-views-resume_id',
            'views',
            'resume_id',
            'resume',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-views-resume_id', 'views');
        $this->dropIndex('idx-views-resume_id', 'views');
        $this->dropForeignKey('fk-views-user_id', 'views');
        $this->dropIndex('idx-views-user_id', 'views');
        $this->dropTable('{{%views}}');
    }
}
