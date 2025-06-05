<?php

namespace common\models;

class Task extends \common\models\RestModel
{
    public static function tableName()
    {
        return '{{%task}}';
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['title', 'description', 'status'], 'string'],
            [['due_date', 'created_at'], 'integer'],
            [['assigned_user_id'], 'integer'],
        ]);
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    public function getSubtitle(): string
    {
        return $this->description ?? '';
    }

    /**
     * Gets the assigned user for this task
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedUser()
    {
        return $this->hasOne(User::class, ['id' => 'assigned_user_id']);
    }
}
