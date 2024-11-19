<?php

class m170606_122113_update_plan_table extends CDbMigration
{
	public function up()
	{
        $this->addColumn('plan', 'currency', 'varchar(5) NOT NULL');
        $this->update('plan', [
            'currency' => Advert::CURRENCY,
        ]);
	}

	public function down()
	{
		$this->dropColumn('plan', 'currency');
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