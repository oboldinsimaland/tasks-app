<?php
namespace frontend\tests\functional;

use common\fixtures\TaskFixture;
use frontend\tests\FunctionalTester;

class IndexCest
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
        $I->seeElement('.task');
        $I->see('Сходить за продуктами');
        $I->see('Встретиться с друзьями');
        $I->see('Сходить в кино');
    }
}
