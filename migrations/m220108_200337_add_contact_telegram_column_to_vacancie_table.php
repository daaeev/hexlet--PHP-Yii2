<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%vacancie}}`.
 */
class m220108_200337_add_contact_telegram_column_to_vacancie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vacancie}}', 'contact_telegram', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%vacancie}}', 'contact_telegram');
    }
}
