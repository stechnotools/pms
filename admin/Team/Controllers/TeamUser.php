<?php
namespace Admin\Team\Controllers;
use App\Controllers\AdminController;
use Admin\Team\Models\TeamUserModel;

class TeamUser extends AdminController{
    private $error = array();
    private $teamUserModel;

    public function __construct(){
        $this->teamUserModel=new TeamUserModel();
    }

    public function index(){
        $this->template->set_meta_title(lang('Team.heading_title'));
        return $this->getList();
    }

    public function add(){
       
        $id = $this->teamUserModel->insert([
            'team_id' => (int)$this->request->getPost('team_id'),
            'user_id' => (int)$this->request->getPost('user_id'),
        ],true);

        $data = [
            'id' =>  $id,
            'status' =>  true
        ];

        return $this->response->setJSON($data);
    }

    public function edit(){

        $this->template->set_meta_title(lang('Team.heading_title'));

        if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){
            $id=$this->uri->getSegment(4);

            $this->teamModel->update($id,$this->request->getPost());

            $this->session->setFlashdata('message', 'Team Updated Successfully.');

            return redirect()->to(base_url('admin/team'));
        }
        $this->getForm();
    }

    public function delete(){
        if ($this->request->getPost('selected')){
            $selected = $this->request->getPost('selected');
        }else{
            $selected = (array) $this->uri->getSegment(4);
        }
        $this->teamModel->delete($selected);

        $this->session->setFlashdata('message', 'Team deleted Successfully.');
        return redirect()->to(base_url('admin/team'));
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

        $this->template->add_package(array('datatable','select2'),true);

        $data['add'] = admin_url('team/add');
        $data['delete'] = admin_url('team/delete');
        $data['datatable_url'] = admin_url('team/search');

        $data['heading_title'] = lang('Team.heading_title');

        $data['text_list'] = lang('Team.text_list');
        $data['text_no_results'] = lang('Team.text_no_results');
        $data['text_confirm'] = lang('Team.text_confirm');

        $data['button_add'] = lang('Team.button_add');
        $data['button_edit'] = lang('Team.button_edit');
        $data['button_delete'] = lang('Team.button_delete');

        if(isset($this->error['warning'])){
            $data['error'] 	= $this->error['warning'];
        }

        if ($this->request->getPost('selected')) {
            $data['selected'] = (array)$this->request->getPost('selected');
        } else {
            $data['selected'] = array();
        }
        
        return $this->template->view('Admin\Team\Views\team', $data);
    }

    public function search() {
        $requestData= $_REQUEST;
        $totalData = $this->teamModel->getTotals();
        $totalFiltered = $totalData;

        $filter_data = array(
            'filter_search' => $requestData['search']['value'],
            'order'  		=> $requestData['order'][0]['dir'],
            'sort' 			=> $requestData['order'][0]['column'],
            'start' 		=> $requestData['start'],
            'limit' 		=> $requestData['length']
        );
        $totalFiltered = $this->teamModel->getTotals($filter_data);

        $filteredData = $this->teamModel->getAll($filter_data);

        $datatable=array();
        foreach($filteredData as $result) {

            $action  = '<div class="btn-group btn-group-sm pull-right">';
            $action .='<a href="'.admin_url('team/edit/'.$result->id).'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>';
            $action .='<a href="'.admin_url('team/delete/'.$result->id).'" class="action-icon btn-remove" onclick="return confirm(\'Are you sure?\') ? true : false;"> <i class="mdi mdi-delete"></i></a>';
            $action .= '</div>';

            if (is_file(DIR_UPLOAD . $result->photo)) {
                $photo = resize($result->photo, 100, 100);
            } else {
                $photo = resize('no_image.png',100,100);
            }

            $datatable[]=array(
                '<div class="form-check">
                    <input type="checkbox" name="selected[]" value="'.$result->id.'" class="form-check-input" >
                 </div>',
                '<div class="table-user">
                    <img src="'.$photo.'" alt="table-user" class="me-2 rounded-circle">
                </div>',
                $result->name,
                $result->color,
                $result->description,
                $result->color,
                $action
            );

        }
        //printr($datatable);
        $json_data = array(
            "draw"            => isset($requestData['draw']) ? intval( $requestData['draw'] ):1,
            "recordsTotal"    => intval( $totalData ),
            "recordsFiltered" => intval( $totalFiltered ),
            "data"            => $datatable
        );

        return $this->response->setContentType('application/json')
            ->setJSON($json_data);

    }

    protected function getForm(){

        $this->template->add_package(array('colorbox'),true);

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

        foreach($this->teamModel->getFieldNames('pms_teams') as $field) {
            if($this->request->getPost($field)) {
                $data[$field] = $this->request->getPost($field);
            } else if(isset($team_info->{$field}) && $team_info->{$field}) {
                $data[$field] = html_entity_decode($team_info->{$field},ENT_QUOTES, 'UTF-8');
            } else {
                $data[$field] = '';
            }
        }

        if($this->request->isAJAX()){
            echo $this->template->view('Admin\Team\Views\teamForm',$data,true);
        }else{
            echo $this->template->view('Admin\Team\Views\teamForm',$data);
        }
    }


    protected function validateForm() {
        //printr($_POST);
        $validation =  \Config\Services::validation();
        $id=$this->uri->getSegment(4);
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

    public function cluster($team=''){
        if (is_ajax()){
            $clusterModel=new ClusterModel();
            $json = array(
                'team'  	=> $team,
                'cluster'   => $clusterModel->getClustersByTeam($team)
            );
            echo json_encode($json);
        }else{
            return show_404();
        }
    }

    public function grampanchayat($team=''){
        if (is_ajax()){
            $grampanchayatModel=new GrampanchayatModel();
            if(!is_numeric($team)){
                $teamrow=$this->teamModel->where('code', $team)->first();

                $team=$teamrow->id;
            }
            $json = array(
                'team'  	=> $team,
                'grampanchayat'   => $grampanchayatModel->getGpsByTeam($team)
            );
            echo json_encode($json);
        }else{
            return show_404();
        }
    }

}

/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */