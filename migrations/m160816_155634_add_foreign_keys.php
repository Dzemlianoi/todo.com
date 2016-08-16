<?php

use yii\db\Migration;

class m160816_155634_add_foreign_keys extends Migration
{
    public function up()
    {
        $this->addForeignKey('user_id','projects','user_id', 'users','id');
        $this->addForeignKey('project_id','tasks','project_id','projects','id');
    }

    public function down()
    {

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
