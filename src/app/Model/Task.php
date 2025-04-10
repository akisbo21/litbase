<?php

namespace Model;

use Model\AbstractModel;

class Task extends AbstractModel
{
    protected $title;
    protected $description;
    protected $execution_time_hours;
    protected $status;
    protected $priority;
    protected $scheduled_date;

    public function initialize()
    {
        // Tabla neve
        $this->setSource('task');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getExecutionTimeHours()
    {
        return $this->execution_time_hours;
    }

    public function setExecutionTimeHours($execution_time_hours)
    {
        $this->execution_time_hours = $execution_time_hours;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    public function getScheduledDate()
    {
        return $this->scheduled_date;
    }

    public function setScheduledDate($scheduled_date)
    {
        $this->scheduled_date = $scheduled_date;
    }

    /**
     * @return UserTask[]
     */
    public function getUserTasks()
    {
        return UserTask::findByTaskId($this->getId());
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        $users = [];
        foreach ($this->getUserTasks() as $userTask) {
            $users[] = $userTask->getUser();
        }

        return $users;
    }

    public function _toArray()
    {
        $return = $this->toArray();
        $return['users'] = [];
        $users  = $this->getUsers();

        foreach ($users as $user) {
            $return['users'][] = $user->toArray();
        }

        return $return;
    }
}
