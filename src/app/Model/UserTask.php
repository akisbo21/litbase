<?php

namespace Model;

use Model\AbstractModel;

class UserTask extends AbstractModel
{
    protected $user_id;
    protected $task_id;

    public function initialize()
    {
        // Tabla neve
        $this->setSource('user_task');
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getTaskId()
    {
        return $this->task_id;
    }

    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return User::getById($this->user_id);
    }

    /**
     * @return Task
     */
    public function getTask()
    {
        return Task::getById($this->task_id);
    }
}
