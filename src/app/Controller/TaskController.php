<?php

namespace Controller;

use Model\Task;

class TaskController extends AuthenticatedApiController
{
    public function indexAction()
    {
        /** @var Task[] $tasks */
        $tasks = Task::find([
            'limit' => 20,
            'order' => 'id DESC'
        ]);

        return $tasks;
    }
}
