<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Task model
 *
 * @property integer $id
 * @property string $begin_at
 * @property string $end_at
 * @property boolean $is_complete
 * @property string $description
 * @property integer $user_id
 */
class Task extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin_at', 'end_at', 'description', 'user_id'], 'required'],
            [['begin_at', 'end_at'] ,'datetime', 'format'=>'yyyy-MM-dd HH:mm:ss+zz'],
            [['begin_at', 'end_at'] ,'safe'],
            [['is_complete'], 'boolean'],
            [['user_id'], 'integer'],
            [['description'], 'string',  'length' => [3, 100]],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'begin_at' => 'Начало',
            'end_at' => 'Конец',
            'is_complete' => 'Завершено',
            'description' => 'Описание',
            'user_id' => 'ID пользователя',
        ];
    }

    /**
     * User
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Returns task by id
     *
     * @param integer $id
     * @throws NotFoundHttpException
     * @return Task
     */
    public static function findModel($id){

        if ($id !== null) {
            $task = Task::findOne($id);

            if (isset($task)) {
                return $task;
            }
        }

        throw new NotFoundHttpException("Model not found: $id");
    }
}
