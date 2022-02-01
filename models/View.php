<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "views".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $resume_id
 *
 * @property Resume $resume
 * @property User $user
 */
class View extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'views';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'resume_id'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'resume_id' => 'Resume ID',
        ];
    }

    /**
     * Gets query for [[Resume]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
