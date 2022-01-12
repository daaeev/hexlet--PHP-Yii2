<?php

namespace app\models\forms;

use app\components\helpers\interface\DBValidatorInterface;
use app\exceptions\DBDataSaveException;
use app\exceptions\IDNotFoundException;
use app\exceptions\ValidationFailedException;
use app\models\Comment;
use app\models\Resume;
use Parsedown;
use PHPUnit\Framework\MockObject\MockObject;
use yii\base\Model;

/**
 * @property string $content содержимое комментария
 */
class CreateCommentForm extends Model
{
    const SCENARIO_COMMENT_TO_ANSWER = 6;
    public $content;

    public function rules()
    {
        return [
            ['content', 'string'],
            ['content', 'required'],
            ['content', 'string', 'max' => 200, 'on' => self::SCENARIO_COMMENT_TO_ANSWER],
        ];
    }

    public function attributeLabels()
    {
        return [
            'content' => 'Содержимое комментария',
        ];
    }

    /**
     * Операция создания комментария.
     * Перед непосредственным сохранением в БД, метод проводит
     * несколько проверок при помощи валидатора $validator: 
     * 
     * Проверка существования резюме с идентификатором $resume_id.
     * 
     * Проверка существования комментария с идентификатором $parent_comment_id,
     * если создаётся комментарий к рекомендации.
     * @param Comment $comment экземпляр модели Comment
     * @param DBValidatorInterface $validator валидатор для сравнения данных из БД (облегчает тестирование)
     * @param Parsedown $parser экземпляр парсера маркдаун разметки
     * @param int $resume_id идентификатор резюме
     * @param int|null $parent_comment_id идентификатор родительского комментария
     * @return bool если операция сохранения прошла успешно
     * @throws ValidationFailedException если валидация данных пройдёт неуспешно
     * @throws DBDataSaveException если сохранение данных пройдёт неуспешно
     * @throws IDNotFoundException если запись с определенным идентификатором не существует
     * (при проверке существования)
     */
    public function createComment(Comment|MockObject $comment, Parsedown $parser, DBValidatorInterface|MockObject $validator, int $resume_id, int $parent_comment_id = null): bool
    {
        $is_comment = $parent_comment_id ? true : false;

        if (!$this->validate()) {
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }
            
        if ($is_comment && (iconv_strlen($this->content) > 200)) {
            throw new ValidationFailedException('Валидация данных прошла неуспешно');
        }

        if (!$validator->resumeExist($resume_id)) {
            throw new IDNotFoundException('Резюме с id ' . $resume_id . ' не существует');
        }

        if ($is_comment && !$validator->commentExist($parent_comment_id)) {
            throw new IDNotFoundException('Комментария с id ' . $parent_comment_id . ' не существует');
        }

        $comment->resume_id = $resume_id;
        $comment->parent_comment_id = $parent_comment_id;
        $comment->content = $is_comment ? htmlspecialchars($this->content) : $parser->line($this->content);

        if (!$comment->save()) {
            throw new DBDataSaveException('Сохранение комментария в базу данных прошло неуспешно');
        }

        return true;
    }
}