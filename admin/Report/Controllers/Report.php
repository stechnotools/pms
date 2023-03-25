<?php
namespace Admin\Report\Controllers;
use Admin\Forms\Models\AggricultureModel;
use Admin\Forms\Models\HorticultureModel;
use Admin\Forms\Models\HouseholdModel;
use App\Controllers\AdminController;

class Report extends AdminController{
	private $error = array();

    function __construct(){
        //$this->componentModel=new ReportModel();
    }

	public function index() {
        $data=[];
        return $this->template->view('Admin\Report\Views\report',$data);
	}
}

return  __NAMESPACE__ ."\\Report";
