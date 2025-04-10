<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class V20250408000002 extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // Insert some more test data into the "task" table
        $this->table('task')->insert([
            [
                'title' => 'Fix login bug',
                'description' => 'Resolve issue with incorrect password handling.',
                'execution_time_hours' => 1.5,
                'status' => 'in_progress',
                'priority' => 'high',
                'scheduled_date' => '2025-04-12',
            ],
            [
                'title' => 'Write API documentation',
                'description' => 'Document all public endpoints in the API.',
                'execution_time_hours' => 3.0,
                'status' => 'todo',
                'priority' => 'low',
                'scheduled_date' => '2025-04-15',
            ],
            [
                'title' => 'Optimize database queries',
                'description' => 'Improve performance of task-related queries.',
                'execution_time_hours' => 2.5,
                'status' => 'todo',
                'priority' => 'high',
                'scheduled_date' => '2025-04-13',
            ],
            [
                'title' => 'Add dark mode toggle',
                'description' => 'Implement dark mode and toggle functionality.',
                'execution_time_hours' => 4.0,
                'status' => 'in_progress',
                'priority' => 'medium',
                'scheduled_date' => '2025-04-14',
            ],
            [
                'title' => 'Deploy to staging',
                'description' => 'Deploy current changes to the staging environment.',
                'execution_time_hours' => 1.0,
                'status' => 'done',
                'priority' => 'medium',
                'scheduled_date' => '2025-04-10',
            ],
            [
                'title' => 'Setup CI/CD',
                'description' => 'Configure automated builds and deployments.',
                'execution_time_hours' => 6.0,
                'status' => 'todo',
                'priority' => 'high',
                'scheduled_date' => '2025-04-16',
            ],
            [
                'title' => 'Create unit tests for services',
                'description' => 'Add unit tests for user and task services.',
                'execution_time_hours' => 3.5,
                'status' => 'todo',
                'priority' => 'medium',
                'scheduled_date' => '2025-04-12',
            ],
            [
                'title' => 'Review pull requests',
                'description' => 'Go through all open PRs and give feedback.',
                'execution_time_hours' => 1.0,
                'status' => 'in_progress',
                'priority' => 'low',
                'scheduled_date' => '2025-04-11',
            ],
            [
                'title' => 'Update dependencies',
                'description' => 'Run npm and composer updates and test the app.',
                'execution_time_hours' => 2.0,
                'status' => 'todo',
                'priority' => 'medium',
                'scheduled_date' => '2025-04-17',
            ],
            [
                'title' => 'Conduct user testing',
                'description' => 'Run usability tests with 3 users.',
                'execution_time_hours' => 5.0,
                'status' => 'todo',
                'priority' => 'high',
                'scheduled_date' => '2025-04-18',
            ],
        ])->save();

        // Insert some more test data into the "user_task" table
        $this->table('user_task')->insert([
            ['user_id' => 1, 'task_id' => 4],
            ['user_id' => 1, 'task_id' => 5],
            ['user_id' => 2, 'task_id' => 4],
            ['user_id' => 2, 'task_id' => 6],
            ['user_id' => 2, 'task_id' => 7],
        ])->save();
    }
}
