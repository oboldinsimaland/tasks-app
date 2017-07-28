<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class TaskFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Task';
    public $depends = ['common\fixtures\UserFixture'];
}