<?php

use yii\db\Migration;

class m160803_093041_create_task extends Migration
{
    public function up()
    {
        $this->createTable('tasks',[
            'id'=>$this->primaryKey(),
            'text'=>$this->string(40),
            'priority'=>$this->smallInteger()->notNull(),
            'done'=>$this->boolean(),
            'project_id'=>$this->integer()
        ]);

    }

    public function down()
    {

        $this->dropTable('tasks');

    }

}
