<?php
namespace Admin\Task\Controllers;

use Admin\Project\Models\ProjectModel;
use Admin\Task\Models\TaskChecklistModel;
use Admin\Task\Models\TaskCommentModel;
use Admin\Task\Models\TaskFileModel;
use Admin\Task\Models\TaskListModel;
use Admin\Task\Models\TaskModel;
use Admin\Task\Models\TaskUserModel;
use Admin\Users\Models\UserModel;
use App\Controllers\AdminController;
use CodeIgniter\Files\File;

class Task extends AdminController {

    private $default_status_id;
    public function __construct() {
        $this->taskModel = new TaskModel();
        //add to config
        $this->default_status_id = 0;
    }
    public function index() {
        $this->template->add_package(['dragula',
            'contextmenu',
            'toast',
            'inlineedit',
            'todoApp',
            'datepicker',
            'tagsinput',
            'fileupload',
            'jqautocompleter'
        ],true);
        $data = [];

        $taskListModel = new TaskListModel();

        $data['containers'] = [];

        $data['tasks'] = $this->taskModel->getTasks(['user_id'=>$this->user->getId()]);

        $data['boards'] = $taskListModel->orderBy('sort_order')->find();

        foreach ($data['boards'] as &$board) {
            $board->name = strtolower(str_replace(' ','',$board->title));
            $data['containers'][] = 'task-list-'.$board->id;
            $board->total_tasks=0;
            $board->tasks = [];
            foreach ($data['tasks'] as &$task) {
                if($task->status_id==$board->id){
                    $board->tasks[] = $task;
                    $board->total_tasks++;
                }
            }
        }

        return $this->template->view('Admin\Task\Views\index', $data);
    }

    public function add() {
        $data = [
            'name' => $this->request->getPost('name'),
            'start_date' => date('Y-m-d'),
            'user_id' => $this->user->getId(),
            'status_id' => $this->default_status_id,
        ];

        $id = $this->taskModel->insert($data);

        if($id){
            $response['status'] = true;
            $response['task_id'] = $id;
            $data = $this->taskModel->find($id);
            $response['task_item'] = view('Admin\Task\Views\task_item',(array)$data);
        } else {
            $response = ['status'=>false];
        }

        return $this->response->setJSON($response);
    }

    public function view() {

        $task = $this->taskModel->asArray()->find($this->request->getGet('id'));

        $data = $task;
        $data['title'] = $task['title'];
        $data['view'] = $this->user->user_id != $task['user_id'];

        $data['projects'] = (new ProjectModel())->findAll();

        $data['priorities'] = [];
        foreach ($this->taskModel->priorities as $key => $priority){
            $data['priorities'][$key] = $priority['text'];
        }

        //tags
        $tags = json_decode($task['tag']);

        $data['tags'] = implode(',',(array)$tags);

        $userModel = new UserModel();
        $data['created_by'] = $userModel->asArray()->find($data['user_id']);
        $data['created_by']['delete'] = null;
        if(!$data['created_by']['image']){
            $data['created_by']['image'] = 'uploads/no_image.png';
        }

        $filter = [
            'task_id' => $task['id']
        ];
        $data['comments'] = (new TaskCommentModel())->getComments($filter);

        //users
        $taskUserModel = new TaskUserModel();
        $ids = [];
        $taskusers = $taskUserModel->where('task_id',$task['id'])->find();

        foreach($taskusers as $user){
            $ids[] = $user->user_id;
        }

        $data['assigned_users'] = [];
        if($ids){
            $filter = [
                'filter_id' => $ids,
            ];
            $users = $userModel->getAll($filter);
            foreach ($users as $key => &$user) {
                if((int)$user->id==1){
                    unset($users[$key]);
                    continue;
                }
                if(!$user->image){
                    $user->image = 'uploads/no_image.png';
                }
                $user->delete = true;
                $data['assigned_users'][] = view('Admin\Task\Views\task_user',(array)$user);
            }
        }

        //files
        $taskFileModel = new TaskFileModel();
        $files = $taskFileModel->where('task_id',$task['id'])->find();
        $data['files'] = [];
        foreach ($files as $file) {

            $_file = new File(DIR_UPLOAD.$file->path);
            $ext = $_file->guessExtension();

            if(in_array($ext,$taskFileModel->icons)){
                $fdata['icon'] = $taskFileModel->icons[$ext];
            } else {
                $fdata['icon'] = $taskFileModel->icons['other'];
            }

            $fdata['id'] = $file->id;
            $fdata['filename'] = $file->filename;
            $fdata['file_url'] = site_url('uploads/'.$file->path);
            $fdata['size'] = $_file->getSizeByUnit('mb')>1 ? $_file->getSizeByUnit('mb').'MB': $_file->getSizeByUnit('kb').'KB' ;
            $data['files'][] = view('Admin\Task\Views\task_file',(array)$fdata);
        }

        $data['html'] = view('Admin\Task\Views\taskForm',$data);

        $data['todos'] = (new TaskChecklistModel())->where('task_id',$task['id'])->findAll();

        return $this->response->setJSON($data);
    }

    public function sort() {
        $status_id = $this->request->getPost('status');
        $ids = $this->request->getPost('tasks');

        $order = 1;
        foreach ($ids as $id) {
            $this->taskModel->update($id,[
                'sort_order'=>$order++,
                'status_id'=>$status_id,
            ]);
        }

        return $this->response->setJSON(['status'=>true]);
    }

    public function delete()
    {
        $task = $this->taskModel->delete($this->request->getPost('id'));

        if($task){
            $data['status'] = true;
        } else {
            $data['status'] = false;
        }
        return $this->response->setJSON($data);
    }

    public function edit() {
        $data = [];
        $task_id = 0;
        if($this->request->getPost('task_id')){
            $task_id = $this->request->getPost('task_id');
        }
        if($this->request->getPost('title')){
            $data['title'] = $this->request->getPost('title');
        }
        if($this->request->getPost('description')){
            $data['description'] = $this->request->getPost('description');
        }
        if($this->request->getPost('priority')){
            $data['priority'] = $this->request->getPost('priority');
        }
        if($this->request->getPost('project_id')){
            $data['project_id'] = $this->request->getPost('project_id');
        }
        if($this->request->getPost('due_date')){
            $data['due_date'] = $this->request->getPost('due_date');
        }
        if($this->request->getPost('thematic_id')){
            $data['thematic_id'] = $this->request->getPost('thematic_id');
        }
        if($this->request->getPost('color')){
            $data['color'] = $this->request->getPost('color');
        }
        if($this->request->getPost('checklist')){
//            $data['priority'] = $this->request->getPost('priority');
        }
        if($this->request->getPost('tag')){
            $data['tag'] = json_encode($this->request->getPost('tag'));
        }

        $json['status'] = false;
        if($this->taskModel->update($task_id,$data)){
            $json['status'] = true;
        }
        return $this->response->setJSON($json);
    }

    public function addComment() {
        $task_id = $this->request->getPost('task_id');
        $comment = $this->request->getPost('comment');

        $data = [
            'task_id'=>$task_id,
            'user_id'=>$this->user->id,
            'comment'=>$comment,
        ];

        $commentModel = new TaskCommentModel();
        $json = [];
        $id = $commentModel->insert($data,true);
        if($id){
            $comment = $commentModel->getComment($id);
            $json['status'] = true;
            $json['comment'] = view('Admin\Task\Views\task_comment',(array)$comment);
        }

        return $this->response->setJSON($json);
    }

    public function addFiles() {
        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'max_size[file,6000]',
            ]
        ]);

        if (!$input) {
            return $this->response->setJSON([
                'status'=>false,
                'message'=>'Upload failed.',
                'errors'=>$this->validator->getErrors()
            ]);
        } else {
            $file = $this->request->getFile('file');

            $file->move(DIR_UPLOAD.'/project');

            $taskFileModel = new TaskFileModel();
            $path = 'project/'.$file->getName();

            $id = $taskFileModel->insert([
                'task_id' => (int)$this->request->getPost('task_id'),
                'filename' => $file->getName(),
                'type' => $file->getClientExtension(),
                'path' => $path
            ],true);

            $_file = new File(DIR_UPLOAD.$path);
            $ext = $_file->guessExtension();

            if(in_array($ext,$taskFileModel->icons)){
                $fdata['icon'] = $taskFileModel->icons[$ext];
            } else {
                $fdata['icon'] = $taskFileModel->icons['other'];
            }

            $fdata['id'] = $id;
            $fdata['filename'] = $file->getName();
            $fdata['file_url'] = site_url('uploads/'.$path);
            $fdata['size'] = $_file->getSizeByUnit('mb')>1 ?: $_file->getSizeByUnit('kb') ;

            $data = [
                'id' =>  $id,
                'name' =>  $file->getName(),
                'size' =>  $file->getSizeByUnit('mb'),
                'url' =>  site_url('uploads/'.$path),
                'html' => view('Admin\Task\Views\task_file',(array)$fdata),
                'status' =>  true
            ];

            return $this->response->setJSON($data);
        }
    }

    public function deleteFile() {
        $file_id = $this->request->getPost('id');

        $taskFileModel = new TaskFileModel();
        $taskFileModel->delete($file_id);

        $data['status'] = true;

        return $this->response->setJSON($data);
    }

    public function addUser() {
        $taskUserModel = new TaskUserModel();
        $id = $taskUserModel->insert([
            'task_id' => (int)$this->request->getPost('task_id'),
            'user_id' => (int)$this->request->getPost('user_id'),
        ],true);

        $data = [
            'id' =>  $id,
            'status' =>  true
        ];

        return $this->response->setJSON($data);
    }

    public function deleteUser() {
        $taskUserModel = new TaskUserModel();

        $done = $taskUserModel
            ->where('task_id',(int)$this->request->getPost('task_id'))
            ->where('user_id',(int)$this->request->getPost('user_id'))
            ->delete();

        $data = [
            'status' =>  $done
        ];

        return $this->response->setJSON($data);
    }

    public function checkList() {
        $clModel = new TaskChecklistModel();

        $task_id = (int)$this->request->getPost('task_id');
        $checklist = $this->request->getPost('checklist');

        $data = [];
        $clModel->where('task_id',$task_id)->delete();
        foreach ($checklist as $item) {
            $data[] = [
                'task_id' => $task_id,
                'title' => $item['text'],
                'status' => $item['done']==true,
                'user_id' => $this->user->id,
            ];
        }
        $insert = $clModel->insertBatch($data,true,100);

        $data['status'] = false;

        if($insert){
            $data = [
                'status' => true,
                'total' => $insert,
            ];
        }
        return $this->response->setJSON($data);
    }
}
