<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Table\Column;

final class V20250408000001 extends AbstractMigration
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
//        $this->execute('DROP TABLE IF EXISTS user');
//        $this->execute('DROP TABLE IF EXISTS task');
//        $this->execute('DROP TABLE IF EXISTS user_task');

        $table = $this->table('user')
            // AbstractModel-nek "meta" oszlopai. Kotelezo oszlopok minden tablaban
            ->addColumn('record_status', Column::TINYINTEGER, [
                'limit' => 1,
                'default' => 1
            ])
            ->addColumn('created_at', Column::DATETIME, [
                'default' => 'CURRENT_TIMESTAMP'
            ])

            // User oszlopai
            ->addColumn('firstname', Column::STRING, ['limit' => 255])
            ->addColumn('lastname', Column::STRING, ['limit' => 255])
            ->addIndex(['record_status'])
            ->addIndex(['firstname', 'lastname'])  // Index for faster lookup by name
            ->create();


        $table = $this->table('task')
            // AbstractModel-nek "meta" oszlopai. Kotelezo oszlopok minden tablaban
            ->addColumn('record_status', Column::TINYINTEGER, [
                'limit' => 1,
                'default' => 1
            ])
            ->addColumn('created_at', Column::DATETIME, [
                'default' => 'CURRENT_TIMESTAMP'
            ])

            // Task oszlopai
            ->addColumn('title', Column::STRING, ['limit' => 255])
            ->addColumn('description', 'text')
            ->addColumn('execution_time_hours', 'decimal', ['precision' => 5, 'scale' => 2])
            // A kesz-e is_ready oszlop helyett raktam be egy statusz oszlopot:
            ->addColumn('status', 'enum', [
                'values' => [
                    'backlog',
                    'todo',
                    'in_progress',
                    'waiting_for_review',
                    'reviewed',
                    'waiting_for_testing',
                    'tested',
                    'deployed_to_staging',
                    'deployed_to_production',
                    'done',
                    'done_and_paid'
                ],
            ])
            ->addColumn('priority', 'enum', [
                'values' => [
                    'low',
                    'medium',
                    'high',
                    'blocker', // blocker mindig kell ;)
                ],
            ])
            ->addColumn('scheduled_date', 'date')
            ->addIndex(['title', 'status', 'priority', 'execution_time_hours', 'scheduled_date'])  // Index for faster lookup by name
            ->create();


        // Create the "user_task" table Many-to-Many relationship
        $table = $this->table('user_task')
            ->addColumn('user_id', Column::INTEGER)
            ->addColumn('task_id', Column::INTEGER)
            ->create();

        // Insert test data ---->

        // Insert test data into the "user" table
        $this->table('user')->insert([
            ['firstname' => 'Bálint', 'lastname' => 'Gerendás'],
            ['firstname' => 'Bence', 'lastname' => 'Klement'],
        ])->save();

        // Insert test data into the "task" table
        $this->table('task')->insert([
            [
                'title' => 'Implement login page',
                'description' => 'Create login UI and backend validation.',
                'execution_time_hours' => 3.5,
                'status' => 'in_progress',
                'priority' => 'high',
                'scheduled_date' => '2025-04-09',
            ],
            [
                'title' => 'Fix payment bug',
                'description' => 'Resolve issue with PayPal integration.',
                'execution_time_hours' => 1.75,
                'status' => 'waiting_for_review',
                'priority' => 'blocker',
                'scheduled_date' => '2025-04-10',
            ],
            [
                'title' => 'Update user dashboard',
                'description' => 'Refactor dashboard layout and styling.',
                'execution_time_hours' => 2.0,
                'status' => 'todo',
                'priority' => 'medium',
                'scheduled_date' => '2025-04-11',
            ],
        ])->save();

        // Insert test data into the "user_task" table
        $this->table('user_task')->insert([
            ['user_id' => 1, 'task_id' => 1],
            ['user_id' => 1, 'task_id' => 2],
            ['user_id' => 2, 'task_id' => 3],
        ])->save();
    }
}
