<?php

use yii\db\Migration;

class m160803_093041_create_task extends Migration
{
    public function up()
    {
        $this->createTable('tasks',[
            'id'=>$this->primaryKey(),
            'text'=>$this->string(255),
            'priority'=>$this->smallInteger()->notNull()->unique(),
            'done'=>$this->boolean(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull(),
            'project_id'=>$this->integer(),
        ]);

    }

    public function down()
    {

        $this->dropTable('tasks');

    }

}
