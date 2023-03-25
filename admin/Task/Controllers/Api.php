<?php
namespace Admin\Task\Controllers;

use Admin\Task\Models\TaskModel;
use App\Controllers\AdminController;
use CodeIgniter\RESTful\ResourceController;

class Api extends AdminController {

    public function __construct() {
        $this->taskModel = new TaskModel();
    }

    public function getMyTasks() {
        $tasks = $this->taskModel->getTasks(['user_id'=>$this->user->getId()]);

        $json['tasks'] = [];
        foreach ($tasks as $task) {
            $json['tasks'][] = [
                'status_id' => $task->status_id,
                'task' => view('Admin\Task\Views\task_item',(array)$task)
            ];
        }

        return $this->response->setJSON($json);
    }

    public function getBoards() {

    }

    public function addTask() {

    }
}
