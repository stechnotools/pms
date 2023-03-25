<?php
namespace Admin\Project\Controllers;
use App\Controllers\AdminController;
use Admin\Project\Models\ProjectModel;
use Admin\Task\Models\TaskCommentModel;
use Admin\Task\Models\TaskModel;

class Project extends AdminController{
    private $error = array();
    private $projectModel;

    public function __construct(){
        $this->projectModel=new ProjectModel();
    }

    public function index(){
        $this->template->set_meta_title(lang('Project.heading_title'));
        return $this->getList();
    }

    public function add(){
        $this->template->set_meta_title(lang('Project.heading_title'));
        if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){

            $id=$this->projectModel->insert($this->request->getPost());

            $this->session->setFlashdata('message', 'Project Saved Successfully.');

            if($this->request->isAJAX()){
                echo 1;
                exit;
            }else{
                return redirect()->to(admin_url('project'));
            }
        }
        $this->getForm();
    }

    public function edit(){

        $this->template->set_meta_title(lang('Project.heading_title'));

        if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){
            $id=$this->uri->getSegment(3);

            $this->projectModel->update($id,$this->request->getPost());
            $this->session->setFlashdata('message', 'Project Updated Successfully.');
            if($this->request->isAJAX()){
                echo 1;
                exit;
            }else{
                return redirect()->to(admin_url('project'));
            }

        }
        $this->getForm();
    }

    public function delete(){
        if ($this->request->getPost('selected')){
            $selected = $this->request->getPost('selected');
        }else{
            $selected = (array) $this->uri->getSegment(4);
        }
        $this->projectModel->delete($selected);

        $this->session->setFlashdata('message', 'Project deleted Successfully.');
        return redirect()->to(base_url('admin/project'));
    }

    public function view(){
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => lang('Project.heading_title'),
            'href' => admin_url('project')
        );

        $data['project_id']=$project_id=$this->uri->getSegment(3);

       // $data['heading_title'] 	= "Project Detail";
        $data['cancel'] = admin_url('project');
        
        $data['project'] = $this->projectModel->find($project_id);
        $data['project_user']=$this->projectModel->getProjectUser($project_id);
        foreach($data['project_user'] as &$user){
            if(strpos($user->image, "https://") !== false){
				$user->image=$user->image;
			}else if(is_file(DIR_UPLOAD . $user->image)){
				$user->image=resize($user->image,150,150);
			}else{
				$user->image=resize("no_image.png",150,150);
			}
        }

        $data['taskes']=(new TaskModel())->getTasks(['project_id'=>$project_id]);
        $data['total_task']=count($data['taskes']);
        $data['completed_task']=(new TaskModel())->where(['project_id'=>$project_id,'status_id'=>4])->countAllResults();
        $data['pending_task']=(new TaskModel())->where(['project_id'=>$project_id,'status_id !='=>4])->countAllResults();
        $data['overdue_task']=0;
        return $this->template->view('Admin\Project\Views\projectView',$data);
    }

    protected function getList() {
        $this->template->add_package(array('datepicker'),true);

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => "Home",
            'href' => admin_url('project')
        );
        $data['breadcrumbs'][] = array(
            'text' => lang('Project.heading_title'),
            'href' => admin_url('project')
        );

        $data['heading_title'] = lang('Project.heading_title');
        $data['add']=admin_url('project/add');
        
        $data['projects'] = $projects=$this->projectModel->getAll();

        foreach($projects as &$project){
            $project->users=$this->projectModel->getProjectUser($project->id);
            foreach($project->users as &$user){
                if(strpos($user->image, "https://") !== false){
                    $user->image=$user->image;
                }else if(is_file(DIR_UPLOAD . $user->image)){
                    $user->image=resize($user->image,150,150);
                }else{
                    $user->image=resize("no_image.png",150,150);
                }
            }
            $project->total_taskes=(new TaskModel())->where(['project_id'=>$project->id])->countAllResults();
            $project->total_comments=0;
            $project->due_date=ymdToDmy($project->end_date);
        }
        return $this->template->view('Admin\Project\Views\project', $data);
    }


    protected function getForm(){

        $this->template->add_package(array('datepicker'),true);

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => lang('Project.heading_title'),
            'href' => admin_url('project')
        );

        $data['heading_title'] 	= lang('Project.heading_title');
        $data['text_form'] = $this->uri->getSegment(3) ? "Project Edit" : "Project Add";
        $data['cancel'] = admin_url('project');

        if(isset($this->error['warning'])){
            $data['error'] 	= $this->error['warning'];
        }

        if ($this->uri->getSegment(3) && ($this->request->getMethod(true) != 'POST')) {
            $project_info = $this->projectModel->find($this->uri->getSegment(3));
        }

        foreach($this->projectModel->getFieldNames('projects') as $field) {
            if($this->request->getPost($field)) {
                $data[$field] = $this->request->getPost($field);
            } else if(isset($project_info->{$field}) && $project_info->{$field}) {
                $data[$field] = html_entity_decode($project_info->{$field},ENT_QUOTES, 'UTF-8');
            } else {
                $data[$field] = '';
            }
        }

        if($this->request->isAJAX()){
            echo $this->template->view('Admin\Project\Views\projectForm',$data,true);
        }else{
            echo $this->template->view('Admin\Project\Views\projectForm',$data);
        }
    }


    protected function validateForm() {
        //printr($_POST);
        $validation =  \Config\Services::validation();
        $id=$this->uri->getSegment(3);
        $regex = "(\/?([a-zA-Z0-9+\$_-]\.?)+)*\/?"; // Path
        $regex .= "(\?[a-zA-Z+&\$_.-][a-zA-Z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
        $regex .= "(#[a-zA-Z_.-][a-zA-Z0-9+\$_.-]*)?"; // Anchor 

        $rules = $this->projectModel->validationRules;



        if ($this->validate($rules)){
            return true;
        }
        else{
            //printr($validation->getErrors());
            $this->error['warning']="Warning: Please check the form carefully for errors!";
            return false;
        }
        return !$this->error;
    }

   
    

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */