<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $english
 * @property string|null $github
 * @property string|null $contact
 * @property string|null $description
 * @property string|null $skills
 * @property string|null $achievements
 * @property int|null $pub_date
 * @property int|null $author_id
 * @property int|null $views
 * @property int|null $status
 *
 * @property User $author
 * @property Comments[] $comments
 */
class Resume extends \yii\db\ActiveRecord
{
    const STATUS_NOT_CONFIRMED = 0;
    const STATUS_CONFIRMED = 1;
    const STATUS_ON_DRAFT = 2;
    const STATUS_BANNED = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'skills', 'achievements'], 'string'],
            [['pub_date', 'author_id', 'views', 'status'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_NOT_CONFIRMED],
            ['pub_date', 'default', 'value' => time()],
            ['views', 'default', 'value' => 0],
            ['author_id', 'default', 'value' => Yii::$app->view->params['user']->id],
            [['english', 'github', 'contact'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'english' => 'English',
            'github' => 'Github',
            'contact' => 'Contact',
            'description' => 'Description',
            'skills' => 'Skills',
            'achievements' => 'Achievements',
            'pub_date' => 'Pub Date',
            'author_id' => 'Author ID',
            'views' => 'Views',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['resume_id' => 'id']);
    }
}
