<?php

namespace app\models\forms;

use app\exceptions\DBDataSaveException;
use app\exceptions\ValidationFailedException;
use app\models\Resume;
use Parsedown;
use PHPUnit\Framework\MockObject\MockObject;
use yii\base\Model;

class CreateResumForm extends Model
{
    public $name;
    public $english_level;
    public $github;
    public $contact;
    public $description;
    public $skills;
    public $achievements;

    public function rules()
    {
        return [
            ['github', 'url'],
            [['contact', 'github', 'english_level'], 'string', 'max' => 255],
            [['name', 'description', 'skills', 'achievements'], 'string'],
            [['name', 'english_level', 'github', 'description', 'skills'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Заголовок',
            'english_level' => 'Уровень английского',
            'github' => 'Github',
            'contact' => 'Контакты',
            'description' => 'Описание',
            'skills' => 'Навыки',
            'achievements' => 'Достижения',
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
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }

        $resume->title = $this->name;
        $resume->english = $this->english_level;
        $resume->github = $this->github;
        $resume->contact = $this->contact;

        $resume->description = $parser->line($this->description);
        $resume->skills = $parser->line($this->skills);
        $resume->achievements = $parser->line($this->achievements);

        if (!$resume->save()) {
            throw new DBDataSaveException('Сохранение данных в бд прошло неуспешно');
        }

        return true;
    }
}