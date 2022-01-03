<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notifications}}`.
 */
class m220103_162841_create_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notifications}}', [
            'id' => $this->primaryKey(),
            'to_user_id' => $this->integer(),
            'title' => $this->text(),
            'content' => $this->text(),
            'is_viewed' => $this->boolean(),
        ]);

        $this->createIndex(
            'idx-notifications-to_user_id',
            '{{%notifications}}',
            'to_user_id'
        );

        $this->addForeignKey(
            'fk-notifications-to_user_id',
            '{{%notifications}}',
            'to_user_id',
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
        $this->dropForeignKey('fk-notifications-to_user_id', '{{%notifications}}');
        $this->dropIndex('idx-notifications-to_user_id', '{{%notifications}}');

        $this->dropTable('{{%notifications}}');
    }
}
