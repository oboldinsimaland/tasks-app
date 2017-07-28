<?php

use yii\db\Migration;

/**
 * Handles the creation of table `task`.
 */
class m170727_122730_create_task_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'begin_at' => 'TIMESTAMPTZ NOT NULL',                   // время начала задачи
            'end_at' => 'TIMESTAMPTZ NOT NULL',                     // время окончания задачи
            'is_complete' => $this->boolean(),                      // выполнена ли задача?
            'description' => $this->string(100)->notNull(),  // описание
            'user_id' => $this->integer()->notNull(),               // id пользователя
        ]);

        $this->addForeignKey(
            'fk_task_user_id',
            'task',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_task_user_id', 'task');
        $this->dropTable('task');
    }
}