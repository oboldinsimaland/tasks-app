<?php
namespace common\tests\unit\models;

use yii\codeception\DbTestCase;
use common\models\Task;
use common\fixtures\TaskFixture;

class TaskTest extends DbTestCase
{
//    protected $tester;
    protected $task;

    public function fixtures()
    {
        return [
          'tasks' => TaskFixture::className(),
        ];
    }

    public function _before()
    {
//        $this->tester->haveFixtures([
//            'task' => [
//                'class' => TaskFixture::className(),
//                'dataFile' => codecept_data_dir() . 'task.php'
//            ]
//        ]);

        $this->task = new Task();
        $this->task->id = 4;
        $this->task->begin_at = '2018-01-22 00:40:00';
        $this->task->end_at = '2018-01-22 05:00:00';
        $this->task->is_complete = false;
        $this->task->description = 'Пойти погулять';
        $this->task->user_id = 125;
    }

    public function testCreateCorrectTask()
    {
        $this->task->scenario = Task::SCENARIO_CREATE;

        expect($this->task->validate());
    }

    public function testCreateIncorrectTaskWithoutDescription()
    {
        $this->task->scenario = Task::SCENARIO_CREATE;
        $this->task->description = null;

        expect_not($this->task->validate());
    }

    public function testCreateIncorrectTaskWithTooShortDescription()
    {
        $this->task->scenario = Task::SCENARIO_CREATE;
        $this->task->description = 'ab';

        expect_not($this->task->validate());
    }

    public function testCreateIncorrectTaskWithTooLongDescription()
    {
        $this->task->scenario = Task::SCENARIO_CREATE;
        $this->task->description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec.';

        expect_not($this->task->validate());
    }

    public function testCreateIncorrectTaskWithWrongDatetimeFormat()
    {
        $this->task->scenario = Task::SCENARIO_CREATE;
        $this->task->begin_at = '01-22-2018 68:1:00';

        expect_not($this->task->validate());
    }

    public function testFindTaskById()
    {
        expect_that($task = Task::findOne(1));
        expect($task->description)->equals('Сходить за продуктами');
        expect_not(Task::findOne(8));
    }

    public function testDeleteTask()
    {
        expect_that(Task::findOne(1)->delete());
        expect_not(Task::findOne(1));
    }

    public function testUpdateTask()
    {

    }
}
