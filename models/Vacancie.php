<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vacancie".
 *
 * @property int $id
 * @property string|null $level
 * @property string|null $money
 * @property string|null $type_of_place
 * @property string|null $type_of_work
 * @property int|null $money_from
 * @property int|null $money_to
 * @property string|null $currency
 * @property string|null $position
 * @property string|null $city
 * @property string|null $address
 * @property string|null $company
 * @property string|null $company_site
 * @property string|null $contact_name
 * @property string|null $contact_number
 * @property string|null $contact_email
 * @property string|null $experience
 * @property string|null $about_company
 * @property string|null $about_project
 * @property string|null $duties
 * @property string|null $requirements
 * @property string|null $conditions
 * @property string|null $technologies
 * @property int|null $pub_date
 * @property int|null $status
 */
class Vacancie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacancie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['money_from', 'money_to', 'pub_date', 'status'], 'integer'],
            [['experience', 'about_company', 'about_project', 'duties', 'requirements', 'conditions', 'technologies'], 'string'],
            [['level', 'money', 'type_of_place', 'type_of_work', 'currency', 'position', 'city', 'address', 'company', 'company_site', 'contact_name', 'contact_number', 'contact_email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'money' => 'Money',
            'type_of_place' => 'Type Of Place',
            'type_of_work' => 'Type Of Work',
            'money_from' => 'Money From',
            'money_to' => 'Money To',
            'currency' => 'Currency',
            'position' => 'Position',
            'city' => 'City',
            'address' => 'Address',
            'company' => 'Company',
            'company_site' => 'Company Site',
            'contact_name' => 'Contact Name',
            'contact_number' => 'Contact Number',
            'contact_email' => 'Contact Email',
            'experience' => 'Experience',
            'about_company' => 'About Company',
            'about_project' => 'About Project',
            'duties' => 'Duties',
            'requirements' => 'Requirements',
            'conditions' => 'Conditions',
            'technologies' => 'Technologies',
            'pub_date' => 'Pub Date',
            'status' => 'Status',
        ];
    }
}
