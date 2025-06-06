<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%new_task}}`.
 */
class m250603_120903_create_new_task_table extends Migration
{

    protected $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function safeUp()
    {
        $this->dropTable('task');
        $this->createTiModelTable('task');
        $this->addColumn('{{%task}}', 'description', $this->string());
        $this->addColumn('{{%task}}', 'status', $this->string());
        $this->addColumn('{{%task}}', 'assigned_user_id', $this->integer());
        $this->addColumn('{{%task}}', 'due_date', $this->integer(11));

        $this->batchInsert(
            'task',
            ['id', 'title', 'description', 'status', 'assigned_user_id', 'created_at', 'due_date'],
            [
                [1, 'Set up project repo', 'Initialize Git repository and set up folder structure.', 'To Do', 2, '1748764800', '1749114000'],
                [2, 'Create Kanban UI layout', 'Design the basic layout for the Kanban board.', 'In Progress', 3, '1748769300', '1749114000'],
                [3, 'Implement drag and drop', 'Use a drag-and-drop library to move tasks between columns.', 'To Do', 4, '1748860200', '1749114000'],
                [4, 'Build backend API', 'Create endpoints to fetch and update tasks.', 'In Progress', 2, '1748869200', '1749114000'],
                [5, 'User authentication', 'Implement login and signup functionality.', 'Done', 1, '1748876400', '1749114000'],
                [6, 'Connect frontend to backend', 'Integrate the Kanban UI with backend API.', 'To Do', 3, '1748937600', '1749114000'],
                [7, 'Set up database schema', 'Design and implement the task table and relations.', 'Done', 1, '1748944800', '1749114000'],
                [8, 'Write unit tests for API', 'Ensure each endpoint is properly tested.', 'To Do', 2, '1748952000', '1749114000'],
                [9, 'Add status filters', 'Allow users to filter tasks by status on the board.', 'In Progress', 4, '1748959200', '1749114000'],
                [10, 'Deploy MVP to Netlify', 'Deploy the frontend to a hosting platform.', 'To Do', 3, '1749027600', '1749114000'],
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('task');
        $this->createTable('task', [
            'id' => $this->primaryKey(),
        ]);
        $this->addColumn('{{%task}}', 'title', $this->string());
        $this->addColumn('{{%task}}', 'description', $this->string());
        $this->addColumn('{{%task}}', 'status', $this->string());
        $this->addColumn('{{%task}}', 'assigned_user_id', $this->integer());
        $this->addColumn('{{%task}}', 'created_at', $this->integer(11));
        $this->addColumn('{{%task}}', 'due_date', $this->integer(11));
    }

    private function createTiModelTable(string $table_name)
    {
        $this->createBaseTable($table_name);
        $this->addIndexes($table_name);
        if ($table_name != 'user') {
            $this->addUserKeys($table_name);
        }
    }

    private function createBaseTable(string $table_name)
    {
        $this->createTable(
            $table_name,
            [
                'id' => 'pk',
                'slug' => 'varchar(255)',
                'title' => 'varchar(255)',
                'active' => "tinyint(1) NOT NULL DEFAULT '0'",
                'protected' => "tinyint(1) NOT NULL DEFAULT '0'",
                'orderindex' => "int(8) NOT NULL DEFAULT '-1'",
                'search' => 'varchar(255)',
                'searchfilter' => 'varchar(255)',
                'created_at' => 'int(11)',
                'created_by' => 'int(11)',
                'updated_at' => 'int(11)',
                'updated_by' => 'int(11)',
                'q_status' => 'int(1) DEFAULT 0 NOT NULL',
                'q_error' => 'varchar(1024) DEFAULT NULL',
                'history' => 'text'
            ],
            $this->tableOptions
        );
    }

    private function addUserKeys(string $table_name)
    {
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

    private function addIndexes(string $table_name)
    {
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
