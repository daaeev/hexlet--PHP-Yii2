<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property int|null $to_user_id
 * @property string|null $title
 * @property string|null $content
 * @property int|null $is_viewed
 *
 * @property User $toUser
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['to_user_id', 'is_viewed'], 'integer'],
            [['title', 'content'], 'string'],
            [['to_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['to_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'to_user_id' => 'To User ID',
            'title' => 'Title',
            'content' => 'Content',
            'is_viewed' => 'Is Viewed',
        ];
    }

    /**
     * Gets query for [[ToUser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
    }
}
