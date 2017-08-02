<?php
namespace common\tests\unit\models;

use yii\codeception\DbTestCase;
use common\models\Task;
use common\fixtures\TaskFixture;

class TaskTest extends DbTestCase
{
    /**
     * @inheritdoc
     */
    public function fixtures()
    {
        return [
            'tasks' => TaskFixture::className(),
        ];
    }

    /**
     * Tests creating new task
     */
    public function testCreateCorrectTask()
    {
        $task = new Task();
        $task->id = 4;
        $task->begin_at = '2018-01-22 00:40:00+05';
        $task->end_at = '2018-01-22 05:00:00+05';
        $task->is_complete = false;
        $task->description = 'Пойти погулять';
        $task->user_id = 1;

        $task->save();

        expect(Task::findOne(4)->description === 'Пойти погулять');
    }

    /**
     * Tests finding task by id
    */
    public function testFindTaskById()
    {
        expect_that($task = Task::findOne(1));
        expect($task->description)->equals('Сходить за продуктами');
    }

    /**
     * Tests finding task by id
     */
    public function testDeleteTask()
    {
        expect($task = Task::findOne(1));
        $task->delete();
        expect_not(Task::findOne(1));
    }

    /**
     * Tests updating task
     */
    public function testUpdateTask()
    {
        $task = Task::findOne(1);
        expect($task->description)->equals('Сходить за продуктами');
        $task->description = 'Сходить в оперный театр';
        expect($task->save());

        expect(Task::findOne(1)->description)->equals('Сходить в оперный театр');
    }
}
