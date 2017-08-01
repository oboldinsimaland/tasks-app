<?php
namespace frontend\tests\unit\models;

use yii\codeception\DbTestCase;
use common\models\Task;
use frontend\tests\fixtures\TaskFixture;

class TaskTest extends DbTestCase
{

    protected $task;

    public function fixtures()
    {
        return [
            'tasks' => TaskFixture::className(),
        ];
    }

    public function _before()
    {
        $this->task = new Task();
        $this->task->id = 4;
        $this->task->begin_at = '2018-01-22 00:40:00';
        $this->task->end_at = '2018-01-22 05:00:00';
        $this->task->is_complete = false;
        $this->task->description = 'Пойти погулять';
        $this->task->user_id = 1;
    }

    public function testCreateCorrectTask()
    {
        expect($this->task->validate());
    }

    public function testFindTaskById()
    {
        expect_that($task = Task::findOne(1));
        expect($task->description)->equals('Сходить за продуктами');
    }

    public function testDeleteTask()
    {
        expect($task = Task::findOne(1));
        $task->delete();
        expect_not(Task::findOne(1));
    }

    public function testUpdateTask()
    {
        $task = Task::findOne(1);
        expect($task->description)->equals('Сходить за продуктами');
        $task->description = 'Сходить в оперный театр';
        $task->save();

        expect(Task::findOne(1)->description)->equals('Сходить в оперный театр');
    }
}
