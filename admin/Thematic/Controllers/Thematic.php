<?php
namespace Admin\Thematic\Controllers;
use App\Controllers\AdminController;
use Admin\Thematic\Models\ThematicModel;

class Thematic extends AdminController{
	private $error = array();
	private $thematicModel;
	
	public function __construct(){
		$this->thematicModel=new ThematicModel();
    }
	
	public function index(){
		$this->template->set_meta_title(lang('Thematic.heading_title'));
		return $this->getList();  
	}
	
	public function add(){
		
		$this->template->set_meta_title(lang('Thematic.heading_title'));
		
		if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){
            $this->thematicModel->insert($this->request->getPost());
			$this->session->setFlashdata('message', 'Thematic Saved Successfully.');
            if($this->request->isAJAX()){
                echo "1";
                exit;
            }else{
                return redirect()->to(base_url('thematic'));
            }
        }
		$this->getForm();
	}
	
	public function edit(){
		$this->template->set_meta_title(lang('Thematic.heading_title'));
		
		if ($this->request->getMethod(1) === 'POST' && $this->validateForm()){	
			$id=$this->uri->getSegment(3);
			$this->thematicModel->update($id,$this->request->getPost());
			$this->session->setFlashdata('message', 'Thematic Updated Successfully.');
		
			return redirect()->to(base_url('thematic'));
		}
		$this->getForm();
	}
	
	public function delete(){
		if ($this->request->getPost('selected')){
			$selected = $this->request->getPost('selected');
		}else{
			$selected = (array) $this->uri->getSegment(4);
		}
		$this->thematicModel->delete($selected);
        foreach($selected as $id){
            $thematic=$this->thematicModel->find($id);
            $this->thematicModel->deleteCentralThematic($thematic->central_appthematic_id);
        }

		
		$this->session->setFlashdata('message', 'Thematic deleted Successfully.');
		return redirect()->to(base_url('admin/thematic'));
	}
	
	protected function getList() {
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => lang('Thematic.heading_title'),
			'href' => admin_url('thematic')
		);
		
		$this->template->add_package(array('datatable'),true);

		$data['add'] = admin_url('thematic/add');
		$data['delete'] = admin_url('thematic/delete');

        $data['datatable_url'] = admin_url('thematic/search');

		$data['heading_title'] = lang('Thematic.heading_title');
		
		$data['text_list'] = lang('Thematic.text_list');
		$data['text_no_results'] = lang('Thematic.text_no_results');
		$data['text_confirm'] = lang('Thematic.text_confirm');
		
		$data['button_add'] = lang('Thematic.button_add');
		$data['button_edit'] = lang('Thematic.button_edit');
		$data['button_delete'] = lang('Thematic.button_delete');
		
		if(isset($this->error['warning'])){
			$data['error'] 	= $this->error['warning'];
		}

		if ($this->request->getPost('selected')) {
			$data['selected'] = (array)$this->request->getPost('selected');
		} else {
			$data['selected'] = array();
		}

		return $this->template->view('Admin\Thematic\Views\thematic', $data);
	}
	
	public function search() {
		$requestData= $_REQUEST;
		$totalData = $this->thematicModel->getTotal();
		$totalFiltered = $totalData;
		
		$filter_data = array(
			'filter_search' => $requestData['search']['value'],
			'order'  		=> $requestData['order'][0]['dir'],
			'sort' 			=> $requestData['order'][0]['column'],
			'start' 		=> $requestData['start'],
			'limit' 	    => $requestData['length']
		);
		$totalFiltered = $this->thematicModel->getTotal($filter_data);
			
		$filteredData = $this->thematicModel->getAll($filter_data);
		//printr($filteredData);
		$datatable=array();
		foreach($filteredData as $result) {

			$action  = '<div class="btn-group btn-group-sm pull-right">';
            $action .='<a href="'.admin_url('thematic/edit/'.$result->id).'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>';
            $action .='<a href="'.admin_url('thematic/delete/'.$result->id).'" onclick="return confirm(\'Are you sure?\') ? true : false;" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
            $action .= '</div>';

            $datatable[]=array(
				'<input type="checkbox" name="selected[]" value="'.$result->id.'" />',
				$result->name,
				'<i class="ri-checkbox-blank-circle-fill" style="color: '.$result->color.'"></i>',
                $result->description,
                $result->color?'Enable':'Disable',
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

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => lang('Thematic.heading_title'),
			'href' => admin_url('thematic')
		);
		

		$data['heading_title'] 	= lang('Thematic.heading_title');
		$data['text_form'] = $this->uri->getSegment(3) ? "Thematic Edit" : "Thematic Add";
		$data['cancel'] = admin_url('thematic');
		
		if(isset($this->error['warning'])){
			$data['error'] 	= $this->error['warning'];
		}
		
		if ($this->uri->getSegment(3) && ($this->request->getMethod(true) != 'POST')) {
			$thematic_info = $this->thematicModel->find($this->uri->getSegment(3));
		}
		
		foreach($this->thematicModel->getFieldNames('thematics') as $field) {
			if($this->request->getPost($field)) {
				$data[$field] = $this->request->getPost($field);
			} else if(isset($thematic_info->{$field}) && $thematic_info->{$field}) {
				$data[$field] = html_entity_decode($thematic_info->{$field},ENT_QUOTES, 'UTF-8');
			} else {
				$data[$field] = '';
			}
		}

        if($this->request->isAJAX()){
            echo $this->template->view('Admin\Thematic\Views\thematicForm',$data,true);
        }else{
            echo $this->template->view('Admin\Thematic\Views\thematicForm',$data);
        }
    }
	
	protected function validateForm() {
		//printr($_POST);
		$validation =  \Config\Services::validation();

		$rules = $this->thematicModel->validationRules;

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