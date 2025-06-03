<?php

use yii\db\Migration;

class m250603_111640_seed_task_table extends Migration
{
    public function safeUp()
    {
        $this->batchInsert(
            'task',
            ['id', 'title', 'description', 'status', 'assigned_user_id', 'created_at', 'due_date'],
            [
                [1, 'Set up project repo', 'Initialize Git repository and set up folder structure.', 'To Do', 2, '2025-06-01 09:00:00', '2025-06-03'],
                [2, 'Create Kanban UI layout', 'Design the basic layout for the Kanban board.', 'In Progress', 3, '2025-06-01 10:15:00', '2025-06-05'],
                [3, 'Implement drag and drop', 'Use a drag-and-drop library to move tasks between columns.', 'To Do', 4, '2025-06-02 11:30:00', '2025-06-07'],
                [4, 'Build backend API', 'Create endpoints to fetch and update tasks.', 'In Progress', 2, '2025-06-02 14:00:00', '2025-06-06'],
                [5, 'User authentication', 'Implement login and signup functionality.', 'Done', 1, '2025-05-31 08:45:00', '2025-06-02'],
                [6, 'Connect frontend to backend', 'Integrate the Kanban UI with backend API.', 'To Do', 3, '2025-06-03 09:00:00', '2025-06-08'],
                [7, 'Set up database schema', 'Design and implement the task table and relations.', 'Done', 1, '2025-05-30 12:00:00', '2025-06-01'],
                [8, 'Write unit tests for API', 'Ensure each endpoint is properly tested.', 'To Do', 2, '2025-06-03 10:30:00', '2025-06-10'],
                [9, 'Add status filters', 'Allow users to filter tasks by status on the board.', 'In Progress', 4, '2025-06-02 16:00:00', '2025-06-06'],
                [10, 'Deploy MVP to Netlify', 'Deploy the frontend to a hosting platform.', 'To Do', 3, '2025-06-03 11:00:00', '2025-06-09'],
            ]
        );
    }

    public function safeDown()
    {
        $this->delete('task', ['in', 'id', range(1, 10)]);
    }
}
