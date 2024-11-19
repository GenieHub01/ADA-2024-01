<?php

class m170506_110025_update_advert_table extends CDbMigration
{
	public function up()
	{
	    $this->addColumn('Advert', 'country', "VARCHAR(5)");
        $this->addColumn('Advert', 'region', "VARCHAR(10)");
	}

	public function down()
	{
		$this->dropColumn('Advert', 'country');
        $this->dropColumn('Advert', 'region');
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