<?php

namespace common\models;

use yii\db\ActiveRecord;
use common\fixtures\TaskFixture;

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


    public function rules(){
        return [

            [['begin_at', 'end_at', 'description', 'user_id'], 'required'],
            ['id', 'integer'],
            [['begin_at', 'end_at'], 'string'],
            ['is_complete', 'boolean'],
            ['description', 'string', 'length' => [3, 100]],
            [['begin_at', 'end_at', 'description'], 'safe'],

        ];
    }

}
