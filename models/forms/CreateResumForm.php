<?php

namespace app\models\forms;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\Resume;
use Parsedown;
use Yii;
use yii\base\Model;

class CreateResumForm extends Model
{
    public $title;
    public $english;
    public $github;
    public $contact;
    public $description;
    public $skills;
    public $achievements;

    public function rules()
    {
        return [
            ['github', 'url'],
            [['contact', 'github', 'english'], 'string', 'max' => 255],
            [['title', 'description', 'skills', 'achievements'], 'string'],
            [['title', 'english', 'github', 'description', 'skills'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => Yii::t('main','Заголовок'),
            'english' => Yii::t('main','Уровень английского'),
            'github' => 'Github',
            'contact' => Yii::t('main','Контакты'),
            'description' => Yii::t('main','Описание'),
            'skills' => Yii::t('main','Навыки'),
            'achievements' => Yii::t('main','Достижения'),
        ];
    }

    /**
     * Метод для создания резюме и занесения его в бд
     * @param Resume $resume экземпляр модели предметной области
     * @param Parsedown $parser экземпляр парсера маркдаун разметки
     * @return bool если операция сохранения пройдёт успешно
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных пройдёт неуспешно
     */
    public function createResum($resume, $parser): bool
    {
        if (!$this->validate()) {
            throw new ValidationFailedException(Yii::t('main', 'Валидация данных прошла неуспешно'));
        }

        $resume->title = $this->title;
        $resume->english = $this->english;
        $resume->github = $this->github;
        $resume->contact = $this->contact;

        $resume->description = $parser->line($this->description);
        $resume->skills = $parser->line($this->skills);
        $resume->achievements = $parser->line($this->achievements);

        if (!$resume->save()) {
            throw new DBDataSaveException(Yii::t('main','Сохранение данных в бд прошло неуспешно'));
        }

        return true;
    }
}