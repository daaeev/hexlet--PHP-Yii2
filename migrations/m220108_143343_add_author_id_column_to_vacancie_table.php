<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vacancie}}`.
 */
class m220108_143343_add_author_id_column_to_vacancie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vacancie}}', 'author_id', $this->integer());

        $this->createIndex(
            'idx-vacancie-author_id',
            '{{%vacancie}}',
            'author_id'
        );

        $this->addForeignKey(
            'fk-vacancie-author_id',
            '{{%vacancie}}',
            'author_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-vacancie-author_id', '{{%vacancie}}');
        $this->dropIndex('idx-vacancie-author_id', '{{%vacancie}}');
        $this->dropColumn('{{%vacancie}}', 'author_id');
    }
}
