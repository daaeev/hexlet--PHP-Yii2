<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 * @property int|null $status
 * @property int $likes_count
 * @property string|null $contribution
 *
 * @property Comments[] $comments
 * @property Notifications[] $notifications
 * @property Resume[] $resumes
 * @property Vacancies[] $vacancies
 * @property Likes[] $likes
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_USER = 0;
    const STATUS_ADMIN = 1;
    const STATUS_MODERATOR = 2;
    const STATUS_BANNED = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'integer'],
            [['status'], 'default', 'value' => self::STATUS_USER],
            [['contribution'], 'string'],
            [['name', 'email', 'password'], 'string', 'max' => 255],
            ['name', 'default', 'value' => 'Anonymous'],
            ['likes_count', 'default', 'value' => '0'],
            ['token', 'default', 'value' => Yii::$app->getSecurity()->generateRandomString(32)],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'status' => 'Status',
            'contribution' => 'Contribution',
            'likes_count' => 'Likes',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO...
    }

    public function getAuthKey()
    {
        // TODO...
    }

    public function validateAuthKey($authKey)
    {
        // TODO...
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Notifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['to_user_id' => 'id']);
    }

    /**
     * Gets query for [[Resumes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Vacancies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancie::className(), ['author_id' => 'id']);
    }
}
