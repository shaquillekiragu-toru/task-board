<?php
/**
 * This view is used by TiCMS/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */

echo "<?php\n";
if (!empty($namespace)) {
	echo "	namespace {$namespace};\n";
}
?>

class
<?= $className ?> extends \yii\db\Migration {

protected $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

public function safeUp () {
$this->createTiModelTable ('
<?= $table; ?>');
}

public function safeDown () {
$this->dropTable ('
<?= $table; ?>');
}

private function cleanupAndForceRelation (string $table_name, string $key_name, string $origin, string $update_action = 'CASCADE', string $delete_action = 'CASCADE') {
Yii::$app->db->createCommand ('DELETE FROM ' . $table_name . ' WHERE ' . $key_name . ' NOT IN (SELECT id FROM ' . $origin . ') ' . ($delete_action == 'CASCADE' ? (' OR ' . $key_name . ' IS NULL') : ''))->execute ();
$this->removeFK ($table_name, $key_name);
$this->addFK ($table_name, $key_name, $origin, $update_action, $delete_action);
}

private function removeColumnWithFK (string $table_name, string $key_name) {
$this->removeFK ($table_name, $key_name);
$this->dropColumn ($table_name, $key_name);
}

private function removeFK (string $table_name, string $key_name) {
$this->dropForeignKey ('fk_' . $table_name . '_' . $key_name, $table_name);
}

private function addFK (string $table_name, string $key_name, string $origin, string $update_action = 'CASCADE', string $delete_action = 'CASCADE') {
$this->addForeignKey (
'fk_' . $table_name . '_' . $key_name,
$table_name,
$key_name,
$origin,
'id',
$delete_action,
$update_action
);
}

private function addKeyWithFK (string $table_name, string $key_name, string $type, string $origin, string $update_action = 'CASCADE', string $delete_action = 'CASCADE') {
$this->addColumn ($table_name, $key_name, $type);
$this->addFK ($table_name, $key_name, $origin, $update_action, $delete_action);
}

private function createTiModelTable (string $table_name) {
$this->createBaseTable ($table_name);
$this->addIndexes ($table_name);
if ($table_name != "user") {
$this->addUserKeys ($table_name);
}
}

private function createBaseTable (string $table_name) {
$this->createTable (
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

private function addUserKeys (string $table_name) {
$this->addForeignKey (
'fk_' . $table_name . '_created_by',
$table_name,
'created_by',
'user',
'id',
'SET NULL',
'CASCADE'
);

$this->addForeignKey (
'fk_' . $table_name . '_updated_by',
$table_name,
'updated_by',
'user',
'id',
'SET NULL',
'CASCADE'
);
}

private function addIndexes (string $table_name) {
$this->createIndex (
'i_' . $table_name . '_slug',
$table_name,
'slug',
true
);

$this->createIndex (
'i_' . $table_name . '_search',
$table_name,
'search',
false
);
}
}
