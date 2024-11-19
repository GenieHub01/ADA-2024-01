<?php

class m170603_075116_create_plan_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('plan', [
            'id' => 'pk',
            'stripe_id' => 'VARCHAR(32) NOT NULL',
            'name' => 'string NOT NULL',
            'package' => 'integer NOT NULL',
            'interval' => 'integer NOT NULL',
            'amount' => 'decimal(10,2) NOT NULL',
        ]);

        $this->createIndex('idx-plan-stripe_id', 'plan', 'id', true);
	}

	public function down()
	{
        $this->dropTable('plan');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}