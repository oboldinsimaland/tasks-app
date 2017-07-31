<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\fixtures\TaskFixture;

class Task extends ActiveRecord
{
    const SCENARIO_INDEX = 'index';         // сценарий для вывода всех задач
    const SCENARIO_CREATE = 'create';       // сценарий для создания задачи
    const SCENARIO_UPDATE = 'update';       // сценарий для обновления задачи
    const SCENARIO_DELETE = 'delete';       // сценарий для удаления задачи
    const SCENARIO_COMPLETE = 'complete';   // сценарий для отметки задачи как выполненой

    public function rules(){
        return [

            [['begin_at', 'end_at', 'is_complete', 'description'], 'required', 'on' => self::SCENARIO_INDEX],
            [['begin_at', 'end_at'], 'datetime', 'on' => self::SCENARIO_INDEX],
            ['is_complete', 'boolean', 'on' => self::SCENARIO_INDEX],

            [['begin_at', 'end_at', 'description', 'user_id'], 'required', 'on' => self::SCENARIO_CREATE],
            [['begin_at', 'end_at'], 'datetime', 'on' => self::SCENARIO_CREATE],
            ['description', 'string', 'length' => [3, 100], 'on' => self::SCENARIO_CREATE],
            [['begin_at', 'end_at', 'description'], 'safe', 'on' => self::SCENARIO_CREATE],

            [['id', 'begin_at', 'end_at', 'description'], 'required', 'on' => self::SCENARIO_UPDATE],
            [['begin_at', 'end_at'], 'datetime', 'on' => self::SCENARIO_UPDATE],
            ['id', 'integer', 'on' => self::SCENARIO_UPDATE],
            ['description', 'string', 'length' => [0, 100], 'on' => self::SCENARIO_UPDATE],
            [['begin_at', 'end_at', 'description'], 'safe', 'on' => self::SCENARIO_UPDATE],

            ['id', 'required', 'on' => self::SCENARIO_DELETE],
            ['id', 'integer', 'on' => self::SCENARIO_DELETE],

            [['id', 'is_complete'], 'required', 'on' => self::SCENARIO_COMPLETE],
            ['id', 'integer', 'on' => self::SCENARIO_COMPLETE],
            ['is_complete', 'boolean', 'on' => self::SCENARIO_COMPLETE],

        ];
    }

    public function fixtures()
    {
        return [
            'tasks' => TaskFixture::className(),
        ];
    }

}

