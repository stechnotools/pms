<?php
namespace Admin\Setting\Controllers;
use Admin\Setting\Models\FDashboardModel;
use Admin\Users\Models\UserGroupModel;
use App\Controllers\AdminController;

class FDashboard extends AdminController{
	private $error = array();
	private $dashboardModel;
	
	public function __construct(){
		$this->dashboardModel=new FDashboardModel();
	}
	
	public function index(){
		$this->template->set_meta_title(lang('FDashboard.heading_title'));
		return $this->getList();  
	}
	
	public function add(){
		
		$this->template->set_meta_title(lang('FDashboard.heading_title'));
		
		if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){	

			$id=$this->dashboardModel->insert($this->request->getPost());
			
			$this->session->setFlashdata('message', 'FDashboard Report Saved Successfully.');

			if($this->request->isAJAX()){
                echo 1;
                exit;
            }else{
                return redirect()->to(admin_url('setting/dashboard'));
            }

		}
		$this->getForm();
	}
	
	public function edit(){
		
		$this->template->set_meta_title(lang('FDashboard.heading_title'));
		
		if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){	
			$id=$this->uri->getSegment(5);
			
			$this->dashboardModel->update($id,$this->request->getPost());
			
			$this->session->setFlashdata('message', 'FDashboard Updated Successfully.');
            if($this->request->isAJAX()){
                echo 1;
                exit;
            }else{
                return redirect()->to(admin_url('setting/dashboard'));
            }

		}
		$this->getForm();
	}
	
	public function delete(){
		if ($this->request->getPost('selected')){
			$selected = $this->request->getPost('selected');
		}else{
			$selected = (array) $this->uri->getSegment(5);
		}
		$this->dashboardModel->delete($selected);
		
		$this->session->setFlashdata('message', 'FDashboard deleted Successfully.');
		return redirect()->to(admin_url('setting/dashboard'));
	}
	
	protected function getList() {
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => lang('FDashboard.heading_title'),
			'href' => admin_url('dashboard')
		);
		
		$this->template->add_package(array('datatable','select2'),true);

		$data['add'] = admin_url('setting/dashboard/add');
		$data['delete'] = admin_url('setting/dashboard/delete');
		$data['datatable_url'] = admin_url('dashboard/search');

		$data['admin_title'] = lang('FDashboard.admin_title');
        $data['front_title'] = lang('FDashboard.front_title');

		$data['text_list'] = lang('FDashboard.text_list');
		$data['text_no_results'] = lang('FDashboard.text_no_results');
		$data['text_confirm'] = lang('FDashboard.text_confirm');
		
		$data['button_add'] = lang('FDashboard.button_add');
		$data['button_edit'] = lang('FDashboard.button_edit');
		$data['button_delete'] = lang('FDashboard.button_delete');
		
		if(isset($this->error['warning'])){
			$data['error'] 	= $this->error['warning'];
		}

		if ($this->request->getPost('selected')) {
			$data['selected'] = (array)$this->request->getPost('selected');
		} else {
			$data['selected'] = array();
		}

        $usergroupModel=new UserGroupModel();
        $data['roles']=$usergroupModel->getAll();

        $data['dreports']=$this->dashboardModel->getFDashboardReports(1);
        $data['dmreports']=$this->dashboardModel->getFDashboardReports(2);


        return $this->template->view('Admin\Setting\Views\dashboard', $data);
	}
	
	public function search() {
		$requestData= $_REQUEST;
		$totalData = $this->dashboardModel->getTotals();
		$totalFiltered = $totalData;
		
		$filter_data = array(
			'filter_search' => $requestData['search']['value'],
			'filter_district' => $requestData['district'],
			'filter_dashboard' => $requestData['dashboard'],
			'order'  		 => $requestData['order'][0]['dir'],
			'sort' 			 => $requestData['order'][0]['column'],
			'start' 			 => $requestData['start'],
			'limit' 			 => $requestData['length']
		);
		$totalFiltered = $this->dashboardModel->getTotals($filter_data);
			
		$filteredData = $this->dashboardModel->getAll($filter_data);
		
		$datatable=array();
		foreach($filteredData as $result) {

			$action  = '<div class="btn-group btn-group-sm pull-right">';
			$action .= 		'<a class="btn btn-sm btn-primary" href="'.admin_url('dashboard/edit/'.$result->id).'"><i class="fa fa-pencil"></i></a>';
			$action .=		'<a class="btn-sm btn btn-danger btn-remove" href="'.admin_url('dashboard/delete/'.$result->id).'" onclick="return confirm(\'Are you sure?\') ? true : false;"><i class="fa fa-trash-o"></i></a>';
			$action .= '</div>';
			
			$datatable[]=array(
				'<input type="checkbox" name="selected[]" value="'.$result->id.'" />',
				$result->code,
				$result->name,
				$result->district,
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
			'text' => lang('FDashboard.heading_title'),
			'href' => admin_url('dashboard')
		);
		
		//printr($_SESSION);
		$_SESSION['isLoggedIn'] = true;
        
		$data['heading_title'] 	= lang('FDashboard.heading_title');
		$data['text_form'] = $this->uri->getSegment(5) ? "FDashboard Report Edit" : "FDashboard Report Add";
		$data['cancel'] = admin_url('dashboard');
		
		if(isset($this->error['warning'])){
			$data['error'] 	= $this->error['warning'];
		}
		
		if ($this->uri->getSegment(5) && ($this->request->getMethod(true) != 'POST')) {
			$dashboard_info = $this->dashboardModel->find($this->uri->getSegment(5));
		}

		foreach($this->dashboardModel->getFieldNames('dashboard_report') as $field) {
			if($this->request->getPost($field)) {
				$data[$field] = $this->request->getPost($field);
			} else if(isset($dashboard_info->{$field}) && $dashboard_info->{$field}) {
				$data[$field] = html_entity_decode($dashboard_info->{$field},ENT_QUOTES, 'UTF-8');
			} else {
				$data[$field] = '';
			}
		}
		

	    if($this->request->isAJAX()){
            $data['hideclass']="d-none";
		    echo $this->template->view('Admin\Setting\Views\dashboardForm',$data,true);
        }else{
            $data['hideclass']="";
            echo $this->template->view('Admin\Setting\Views\dashboardForm',$data);
        }
    }
	
	protected function validateForm() {
		//printr($_POST);
		$validation =  \Config\Services::validation();
		$id=$this->uri->getSegment(4);
		$regex = "(\/?([a-zA-Z0-9+\$_-]\.?)+)*\/?"; // Path
		$regex .= "(\?[a-zA-Z+&\$_.-][a-zA-Z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
		$regex .= "(#[a-zA-Z_.-][a-zA-Z0-9+\$_.-]*)?"; // Anchor 

		$rules = $this->dashboardModel->validationRules;
		
		
		
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