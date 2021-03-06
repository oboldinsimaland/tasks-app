<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Form for creating new task and update task
 *
 * @property string $begin_at Start time of the task
 * @property string $end_at End time of the task
 * @property string $description Description of the task
 */
class TaskForm extends Model
{
    /**
     * @var string the start time of the task
     */
    public $begin_at;
    /**
     * @var string the end time of the task
     */
    public $end_at;
    /**
     * @var string the description of the task
     */
    public $description;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // all the filds are required
            [
                ['begin_at', 'end_at', 'description'],
                'required',
            ],

            // dates must match the format
            [
                ['begin_at', 'end_at'] ,
                'datetime',
                'format'=>'yyyy-MM-dd HH:mm:ss+zz',
                'message' => 'Введите корректную дату и время',
            ],

            // description must be a string from 3 to 100 length
            [
                ['description'],
                'string',
                'length' => [3, 100],
                'message' => 'Описание должно содержать от 3 до 100 символов',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'begin_at' => 'Начало',
            'end_at' => 'Конец',
            'description' => 'Описание'
        ];
    }
}
