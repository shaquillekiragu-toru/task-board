/Volumes/T5SSD/Projects/chainsaw.cloud/hacksaw/console/migrations/m220302_112532_adding_attachments_to_emails.php
<?php

class m210721_095521_add_email_table extends \yii\db\Migration {

	protected $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

	public function safeUp() {
		$this->createTiModelTable('email');

		$this->addColumn('email', 'email', 'VARCHAR(64)');
		$this->addColumn('email', 'status', 'VARCHAR(64)');
		$this->addColumn('email', 'order', 'VARCHAR(12)');
		$this->addColumn('email', 'model_id', 'INT(11)');
		$this->addColumn('email', 'model_name', 'VARCHAR(512)');
		$this->addColumn('email', 'template', 'VARCHAR(512)');
		$this->addColumn('email', 'params', 'TEXT');
		$this->addColumn('email', 'error', 'TEXT');
		$this->addColumn('email', 'ses_id', 'VARCHAR(128)');
		$this->addColumn('email', 'subject', 'VARCHAR(128)');
	}

	public function safeDown() {
		$this->dropTable('email');
	}

	private function createTiModelTable(string $table_name) {
		$this->createBaseTable($table_name);
		$this->addIndexes($table_name);
		if ($table_name != "user") {
			$this->addUserKeys($table_name);
		}
	}

	private function createBaseTable(string $table_name) {
		$this->createTable(
			$table_name,
			[
				"id" => "pk",
				"slug" => "varchar(255)",
				"title" => "varchar(255)",
				"active" => "tinyint(1) NOT NULL DEFAULT '0'",
				"protected" => "tinyint(1) NOT NULL DEFAULT '0'",
				"orderindex" => "int(8) NOT NULL DEFAULT '-1'",
				"search" => "varchar(255)",
				"searchfilter" => "varchar(255)",
				"created_at" => "int(11)",
				"created_by" => "int(11)",
				"updated_at" => "int(11)",
				"updated_by" => "int(11)",
				"q_status" => "int(1) DEFAULT 0 NOT NULL",
				"q_error" => "varchar(1024) DEFAULT NULL",
				"history" => "text"
			],
			$this->tableOptions
		);
	}

	private function addUserKeys(string $table_name) {
		$this->addForeignKey(
			'fk_' . $table_name . '_created_by',
			$table_name,
			'created_by',
			'user',
			'id',
			'SET NULL',
			'CASCADE'
		);

		$this->addForeignKey(
			'fk_' . $table_name . '_updated_by',
			$table_name,
			'updated_by',
			'user',
			'id',
			'SET NULL',
			'CASCADE'
		);
	}

	private function addIndexes(string $table_name) {
		$this->createIndex(
			'i_' . $table_name . '_slug',
			$table_name,
			'slug',
			true
		);

		$this->createIndex(
			'i_' . $table_name . '_search',
			$table_name,
			'search',
			false
		);
	}
}
