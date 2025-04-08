<?php

namespace Config;

class Router extends \Phalcon\Mvc\Router
{
    public function __construct(bool $defaultRoutes = true)
    {
        parent::__construct(false);

        $this->notFound([
            'controller' => 'Controller\\Index',
            'action' => 'notFound',
        ]);

        $this->add('/probe/liveness', 'Controller\\Probe::liveness');

        $this->add('/', 'Controller\\User::index');
        $this->add('/users', 'Controller\\User::index');
        $this->add('/tasks', 'Controller\\Task::index');
        $this->add('/user-tasks', 'Controller\\UserTask::index');
    }
}
