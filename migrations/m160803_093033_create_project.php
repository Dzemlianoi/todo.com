<?php

use yii\db\Migration;

class m160803_093033_create_project extends Migration
{
    public function up()
    {
        $this->createTable('projects',[
            'id'=>$this->primaryKey(),
            'name'=>$this->string(40)->unique()->notNull(),
        ]);
    }

    public function down()
    {

        $this->dropTable('projects');

    }
}
