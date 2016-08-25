<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $text
 * @property integer $priority
 * @property integer $done
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $project_id
 *
 * @property Projects $project
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'priority', 'created_at', 'updated_at'], 'required'],
            [['priority', 'done', 'created_at', 'updated_at', 'project_id'], 'integer'],
            [['text'], 'string', 'max' => 40],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'priority' => 'Priority',
            'done' => 'Done',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
