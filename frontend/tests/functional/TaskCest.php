<?php
namespace frontend\tests\functional;

use common\fixtures\TaskFixture;
use frontend\tests\FunctionalTester;

class TaskCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'tasks' => [
                'class' => TaskFixture::className(),
            ]
        ]);

        $I->amOnRoute('site/login');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'testuser');
        $I->fillField('Password', '12345678');
        $I->click('login-button');
        $I->see('Logout (testuser)', 'form button[type=submit]');
    }

    public function checkListOfTasks(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->see('Сходить за продуктами', '[data-key=1]');
        $I->see('Встретиться с друзьями', '[data-key=2]');
        $I->see('Сходить в кино', '[data-key=3]');
    }

    public function createNewTask(FunctionalTester $I)
    {
        $I->amOnRoute('site/create');
        $I->seeElement('#create-form');
        $I->fillField('Начало', '2017-08-31 20:00:00+05');
        $I->fillField('Конец', '2017-08-31 21:30:00+05');
        $I->fillField('Описание', 'Купить новый iPad');
        $I->click('#create-form button[type=submit]');
        $I->see('Купить новый iPad');
        $I->seeRecord('common\models\Task', ['id' => 4,'description' => 'Купить новый iPad']);
    }

    public function updateTask(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('[data-key=2] a:nth-child(2)');
        $I->see('Изменить задачу');
        $I->fillField('Начало', '2017-08-14 08:00:00+05');
        $I->fillField('Конец', '2017-08-14 09:15:00+05');
        $I->fillField('Описание', 'Купить печенье');
        $I->click('#update-form button[type=submit]');
        $I->seeRecord('common\models\Task', [
            'id' => 2,
            'begin_at' => '2017-08-14 08:00:00+05',
            'end_at' => '2017-08-14 09:15:00+05',
            'description' => 'Купить печенье',
        ]);
        $I->see('Купить печенье');
    }

    public function deleteTask(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');
        $I->click('[data-key=2] a:nth-child(1)');
        $I->dontSeeRecord('common\models\Task', ['id' => 2,]);
        $I->dontSee('Купить печенье');
    }

    public function completeTask(FunctionalTester $I)
    {
        $I->amOnRoute('site/index');

        $I->see('Сходить за продуктами', '.task.complete');
        $I->seeRecord('common\models\Task', [
            'description' => 'Сходить за продуктами',
            'is_complete' => true,
        ]);
        $I->click('.task.complete a:nth-child(2)');
        $I->dontSee('Сходить за продуктами', '.task.complete');
        $I->seeRecord('common\models\Task', [
            'description' => 'Сходить за продуктами',
            'is_complete' => false,
        ]);

        $I->see('Сходить в кино', '[data-key=3]');
        $I->dontSee('Сходить в кино', '.task.complete');
        $I->click('[data-key=3] a:nth-child(3)');
        $I->see('Сходить в кино', '.task.complete');
    }

    public function test404(FunctionalTester $I)
    {
        $I->amOnRoute('site/delete', ['id' => 888]);
        $I->see('Not Found (#404)');
    }
}
