<?php

namespace frontend\tests\fixtures;

use yii\test\ActiveFixture;

/**
 * Task fixture
 * */
class TaskFixture extends ActiveFixture
{
    /**
     * @var string $modelClass Should contain model with a namespace for the fixture
     * @var string[] $depends  Should contain depends for the fixture
     */
    public $modelClass = 'common\models\Task';
    public $depends = ['common\fixtures\UserFixture'];
}
