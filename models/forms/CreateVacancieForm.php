<?php

namespace app\models\forms;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\Vacancie;
use Parsedown;
use yii\base\Model;

class CreateVacancieForm extends Model
{
    public $level;
    public $money;
    public $type_of_place;
    public $type_of_work;
    public $money_from;
    public $money_to;
    public $currency;
    public $position;
    public $city;
    public $address;
    public $company;
    public $company_site;
    public $contact_name;
    public $contact_number;
    public $contact_telegram;
    public $contact_email;
    public $experience;
    public $about_company;
    public $about_project;
    public $duties;
    public $requirements;
    public $conditions;
    public $technologies;

    public function rules()
    {
        return [
            [['level', 'type_of_work', 'currency', 'position', 'city', 'company', 'duties'], 'required'],
            [['money_from', 'money_to'], 'integer'],
            [['experience', 'about_company', 'about_project', 'duties', 'requirements', 'conditions', 'technologies'], 'string'],
            [['level', 'money', 'type_of_place', 'type_of_work', 'currency', 'position', 'city', 'address', 'company', 'contact_name', 'contact_number', 'company_site', 'contact_telegram', 'contact_email'], 'string', 'max' => 255],
            [['company_site', 'contact_telegram'], 'url'],
            ['contact_email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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
            'contact_telegram' => 'Contact Telegram',
            'experience' => 'Experience',
            'about_company' => 'About Company',
            'about_project' => 'About Project',
            'duties' => 'Duties',
            'requirements' => 'Requirements',
            'conditions' => 'Conditions',
            'technologies' => 'Technologies',
        ];
    }

    /**
     * Метод для создания вакансии и занесения данных в бд
     * @param Vacancie $vacancie экземпляр модели предметной области
     * @param Parsedown $parser экземпляр парсера маркдаун разметки
     * @return bool если операция сохранения пройдёт успешно
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных пройдёт неуспешно
     */
    public function createVacancie(Vacancie $vacancie, Parsedown $parser): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }

        $vacancie->level = $this->level;
        $vacancie->money = $this->money;
        $vacancie->type_of_place = $this->type_of_place;
        $vacancie->type_of_work = $this->type_of_work;
        $vacancie->money_from = $this->money_from;
        $vacancie->money_to = $this->money_to;
        $vacancie->currency = $this->currency;
        $vacancie->position = $this->position;
        $vacancie->city = $this->city;
        $vacancie->address = $this->address;
        $vacancie->company = $this->company;
        $vacancie->company_site = $this->company_site;
        $vacancie->contact_name = $this->contact_name;
        $vacancie->contact_number = $this->contact_number;
        $vacancie->contact_telegram = $this->contact_telegram;
        $vacancie->contact_email = $this->contact_email;

        $vacancie->experience = $parser->line($this->experience);
        $vacancie->about_company = $parser->line($this->about_company);
        $vacancie->about_project = $parser->line($this->about_project);
        $vacancie->duties = $parser->line($this->duties);
        $vacancie->requirements = $parser->line($this->requirements);
        $vacancie->conditions = $parser->line($this->conditions);
        $vacancie->technologies = $parser->line($this->technologies);

        if (!$vacancie->save()) {
            throw new DBDataSaveException('Сохранение данных в бд прошло неуспешно');
        }

        return true;
    }
}