<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Form for creating new task
 */
class CreateTaskForm extends Model
{
    public $begin_at;
    public $end_at;
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