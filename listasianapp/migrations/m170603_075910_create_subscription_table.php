<?php

class m170603_075910_create_subscription_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('subscription', [
            'id' => 'pk',
            'advert_id' => 'integer NOT NULL',
            'plan_id' => 'integer NOT NULL',
            'stripe_subscription_id' => 'string NOT NULL',
        ]);

        $this->addForeignKey('fk-subscription-advert_id', 'subscription', 'advert_id', 'Advert', 'id', 'CASCADE');
        $this->addForeignKey('fk-subscription-plan_id', 'subscription', 'plan_id', 'plan', 'id', 'CASCADE');
        $this->createIndex('idx-subscription-stripe_subscription_id', 'subscription', 'stripe_subscription_id', true);
    }

    public function down()
    {
        $this->dropTable('subscription');
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