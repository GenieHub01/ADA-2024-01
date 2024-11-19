<?php

class m170604_092300_update_Price_table extends CDbMigration
{
	public function up()
	{
	    $this->addColumn('Price', 'description', 'string NOT NULL');
	}

	public function down()
	{
		$this->dropColumn('Price', 'description');
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