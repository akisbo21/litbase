<?php

namespace Controller;

use Model\Task;
use Model\UserTask;

class TaskController extends AuthenticatedApiController
{
    public function indexAction()
    {
        /** @var Task[] $tasks */
        $tasks = Task::find([
            'limit' => 20,
            'order' => 'id DESC'
        ]);

        $return = [];
        foreach ($tasks as $task) {
            $return[] = $task->_toArray();
        }

        return $return;
    }

    public function editAction($id)
    {
        $task = Task::getById($id);

        if (!$task) {
            return $this->response->setJsonContent(["error" => "Task not found"]);
        }

        if ($this->request->isPost()) {
            $data = $this->request->getJsonRawBody();
//            echo '<pre>';print_r($data);die();

            if ($data->title) {
                $task->setTitle($data->title);
            }
            if ($data->description) {
                $task->setDescription($data->description);
            }
            if ($data->execution_time_hours) {
                $task->setExecutionTimeHours($data->execution_time_hours);
            }
            if ($data->status) {
                $task->setStatus($data->status);
            }
            if ($data->priority) {
                $task->setPriority($data->priority);
            }
            if ($data->scheduled_date) {
                $scheduledDate = new \DateTime($data->scheduled_date);
//                var_dump($data->scheduled_date);var_dump($scheduledDate);die();
                $task->setScheduledDate($scheduledDate->format('Y-m-d'));
            }

            try {
                $task->save();
                return $this->response->setJsonContent(["success" => true, "task" => $task->toArray()]);
            }
            catch (\Exception $e){
                return $this->response->setJsonContent(["error" => "Failed to save task", "messages" => $task->getMessages()]);
            }
        }

        return $task->_toArray();
    }

    public function createAction()
    {
        $task = new Task();

        if ($this->request->isPost()) {
            $data = $this->request->getJsonRawBody();

            if ($data->title) {
                $task->setTitle($data->title);
            }
            if ($data->description) {
                $task->setDescription($data->description);
            }
            if ($data->execution_time_hours) {
                $task->setExecutionTimeHours($data->execution_time_hours);
            }
            if ($data->status) {
                $task->setStatus($data->status);
            }
            if ($data->priority) {
                $task->setPriority($data->priority);
            }
            if ($data->scheduled_date) {
                $scheduledDate = new \DateTime($data->scheduled_date);
                $task->setScheduledDate($scheduledDate->format('Y-m-d'));
            }

            try {
                if ($task->save()) {
//                    echo '<pre>';print_r($task->toArray());die();
                    return $task;
                } else {
                    return $this->response->setJsonContent(["error" => "Failed to save task", "messages" => $task->getMessages()]);
                }
            }
            catch (\Exception $e){
                return $this->response->setJsonContent(["error" => "Failed to save task", "message" => $e->getMessage()]);
            }
        }

        return $this->response->setJsonContent(["error" => "Invalid request method"]);
    }
}
