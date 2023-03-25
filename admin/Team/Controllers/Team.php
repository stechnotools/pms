<?php
namespace Admin\Team\Controllers;

use Admin\Task\Models\TaskModel;
use App\Controllers\AdminController;
use Admin\Team\Models\TeamModel;
use Admin\Users\Models\UserModel;

class Team extends AdminController{
    private $error = array();
    private $teamModel;
    private $userModel;

    public function __construct(){
        $this->teamModel=new TeamModel();
        $this->userModel=new UserModel();
    }

    public function index(){
        $this->template->set_meta_title(lang('Team.heading_title'));
        return $this->getList();
    }

    public function add(){
        $this->template->set_meta_title(lang('Team.heading_title'));
        if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){


            $id=$this->teamModel->insert($this->request->getPost());

            $this->session->setFlashdata('message', 'Team Saved Successfully.');

            if($this->request->isAJAX()){
                echo 1;
                exit;
            }else{
                return redirect()->to(admin_url('team'));
            }
        }
        $this->getForm();
    }

    public function edit(){

        $this->template->set_meta_title(lang('Team.heading_title'));

        if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){
            $id=$this->uri->getSegment(3);

            $this->teamModel->update($id,$this->request->getPost());

            $this->session->setFlashdata('message', 'Team Updated Successfully.');

            if($this->request->isAJAX()){
                echo 1;
                exit;
            }else{
                return redirect()->to(admin_url('team'));
            }
        }
        $this->getForm();
    }

    public function view(){
        $this->template->add_package(['jqautocompleter','toast'],true);
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => lang('Team.heading_title'),
            'href' => admin_url('team')
        );

        $data['team_id']=$team_id=$this->uri->getSegment(3);

        $data['heading_title'] 	= "Team Details";
        $data['cancel'] = admin_url('team');
        
        $data['team'] = $team=$this->teamModel->find($team_id);
        
        if(is_file(DIR_UPLOAD . $team->photo)){
            $team->photo=resize($team->photo,150,150);
        }else{
            $team->photo=resize("no_image.png",150,150);
        }

      
        $data['team_user']=$this->teamModel->getTeamUser($team_id);
        foreach($data['team_user'] as &$user){
            if(strpos($user->image, "https://") !== false){
				$user->image=$user->image;
			}else if(is_file(DIR_UPLOAD . $user->image)){
				$user->image=resize($user->image,150,150);
			}else{
				$user->image=resize("no_image.png",150,150);
			}
        }

        $data['total_user']=count($data['team_user']);
        //$data['taskes']=(new TeamModel())->getTeamTasks(['team_id'=>$team_id]);
        //$data['total_task']=count($data['taskes']);
       


        return $this->template->view('Admin\Team\Views\teamView',$data);
    }

    public function delete(){
        if ($this->request->getPost('selected')){
            $selected = $this->request->getPost('selected');
        }else{
            $selected = (array) $this->uri->getSegment(4);
        }
        $this->teamModel->delete($selected);

        $this->session->setFlashdata('message', 'Team deleted Successfully.');
        return redirect()->to(admin_url('team'));
    }

    protected function getList() {

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => "Home",
            'href' => admin_url('')
        );
        $data['breadcrumbs'][] = array(
            'text' => lang('Team.heading_title'),
            'href' => admin_url('team')
        );

        $data['heading_title'] = lang('Team.heading_title');
        $data['add']=admin_url('team/add');
        

        $data['teams'] = $teams= $this->teamModel->getAll();
        foreach($teams as &$team){
            $team->users=$this->teamModel->getTeamUser($team->id);
            foreach($team->users as &$user){
                if(strpos($user->image, "https://") !== false){
                    $user->image=$user->image;
                }else if(is_file(DIR_UPLOAD . $user->image)){
                    $user->image=resize($user->image,150,150);
                }else{
                    $user->image=resize("no_image.png",150,150);
                }
            }
            $team->total_task=(new TeamModel())->getTotalTaskByTeam($team->id);
          
        }
       
        return $this->template->view('Admin\Team\Views\team', $data);
    }


    protected function getForm(){
        
        $this->template->add_package(array('select2'),true);

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => lang('Team.heading_title'),
            'href' => admin_url('team')
        );

        $data['heading_title'] 	= lang('Team.heading_title');
        $data['text_form'] = $this->uri->getSegment(3) ? "Team Edit" : "Team Add";
        $data['cancel'] = admin_url('team');
        


        if(isset($this->error['warning'])){
            $data['error'] 	= $this->error['warning'];
        }

        if ($this->uri->getSegment(3) && ($this->request->getMethod(true) != 'POST')) {
            $team_info = $this->teamModel->find($this->uri->getSegment(3));
            
        }

        foreach($this->teamModel->getFieldNames('teams') as $field) {
            if($this->request->getPost($field)) {
                $data[$field] = $this->request->getPost($field);
            } else if(isset($team_info->{$field}) && $team_info->{$field}) {
                $data[$field] = html_entity_decode($team_info->{$field},ENT_QUOTES, 'UTF-8');
            } else {
                $data[$field] = '';
            }
        }

        
        if($this->request->getPost("team_user")) {
            $team_user = $this->request->getPost('team_user');
        } else if($this->uri->getSegment(3)) {
            $team_user = $this->teamModel->getTeamUser($this->uri->getSegment(3));
        } else {
            $team_user = [];
        }

        $data['team_users'] = array();
        //printr($banner_images);
        foreach ($team_user as $user) {
            if(is_object($user)){
                $data['team_user'][] = $user->id;
            }else{
                $data['team_user'][] = $user['id'];
            }
            
        }
        
        //printr($data['team_user']);

        $data['members']=$this->userModel->getAll();
        //printr($data['members']);

        if($this->request->isAJAX()){
            echo $this->template->view('Admin\Team\Views\teamForm',$data,true);
        }else{
            echo $this->template->view('Admin\Team\Views\teamForm',$data);
        }
    }


    protected function validateForm() {
        //printr($_POST);
        $validation =  \Config\Services::validation();
        $id=$this->uri->getSegment(3);
        $regex = "(\/?([a-zA-Z0-9+\$_-]\.?)+)*\/?"; // Path
        $regex .= "(\?[a-zA-Z+&\$_.-][a-zA-Z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
        $regex .= "(#[a-zA-Z_.-][a-zA-Z0-9+\$_.-]*)?"; // Anchor 

        $rules = $this->teamModel->validationRules;



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