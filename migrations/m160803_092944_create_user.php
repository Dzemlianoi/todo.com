<?php

use yii\db\Migration;

class m160803_092944_create_user extends Migration
{
    public function up()
    {

        $this->createTable('users',[
           'id'=>$this->primaryKey(),
            'login'=>$this->string(40)->unique()->notNull(),
            'password'=>$this->string(32)->notNull(),
            'email'=>$this->string(45)->unique()->notNull(),
            'auth_key'=>$this->string(32)->notNull(),
            'created_at'=>$this->integer()->notNull(),
            'updated_at'=>$this->integer()->notNull()
        ]);

    }

    public function down()
    {

        $this->dropTable('users');

    }

}
