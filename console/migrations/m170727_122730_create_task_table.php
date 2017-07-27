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
    public function up()
    {
        $this->createTable('task', [
            'id' => $this->primaryKey(),
            'begin_at' => $this->dateTime(),
            'end_at' => $this->dateTime(),
            'is_complete' => $this->boolean(),
            'description' => $this->string(100),
            'fk_user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-task-user_id',
            'task',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-task-user_id', 'task');
        $this->dropTable('task');
    }
}
