<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

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
            [['created_at'], 'integer'],
            [['assigned_user_id'], 'integer'],
            ['due_date', 'date', 'format' => 'php:Y-m-d', 'timestampAttribute' => 'due_date'],
        ]);
    }

    /**
     * Gets the assigned user for this task
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedUser()
    {
        return $this->hasOne(User::class, ['id' => 'assigned_user_id']);
    }

    /**
     * Gets the formatted due date for display
     * @return string|null
     */
    public function getFormattedDueDate()
    {
        return $this->due_date ? date('Y-m-d', $this->due_date) : null;
    }

    /**
     * Gets the formatted creation date for display
     * @return string|null
     */
    public function getFormattedCreatedAt()
    {
        return $this->created_at ? date('Y-m-d', $this->created_at) : null;
    }


    public function beforeSave($insert)
    {
        if ($insert) {
            $this->assigned_user_id = Yii::$app->user->identity->id;
        }
        return parent::beforeSave($insert);
    }

    public function isAssignedToCurrentUser(): bool
    {
        return $this->assigned_user_id === Yii::$app->user->identity->id;
    }
}
