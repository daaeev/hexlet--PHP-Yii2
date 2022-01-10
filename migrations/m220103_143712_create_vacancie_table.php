<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vacancie}}`.
 */
class m220103_143712_create_vacancie_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vacancie}}', [
            'id' => $this->primaryKey(),
            'level' => $this->string(),
            'money' => $this->string(),
            'type_of_place' => $this->string(),
            'type_of_work' => $this->string(),
            'money_from' => $this->integer(),
            'money_to' => $this->integer(),
            'currency' => $this->string(),
            'position' => $this->string(),
            'city' => $this->string(),
            'address' => $this->string(),
            'company' => $this->string(),
            'company_site' => $this->string(),
            'contact_name' => $this->string(),
            'contact_number' => $this->string(),
            'contact_email' => $this->string(),
            'experience' => $this->text(),
            'about_company' => $this->text(),
            'about_project' => $this->text(),
            'duties' => $this->text(),
            'requirements' => $this->text(),
            'conditions' => $this->text(),
            'technologies' => $this->string(),
        
            'pub_date' => $this->bigInteger(),
            'status' => $this->tinyInteger()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vacancie}}');
    }
}
