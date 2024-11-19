<?php

class m170605_054728_create_card_table extends CDbMigration
{
	public function up()
	{
	    $this->createTable('card', [
	        'id' => 'pk',
            'user_id' => 'integer NOT NULL',
            'card_hash' => 'string NOT NULL',
            'stripe_customer_id' => 'string NOT NULL',
        ]);

	    $this->addForeignKey('fk-card-user_id', 'card', 'user_id', 'User', 'id');
	}

	public function down()
	{
		$this->dropTable('card');
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
