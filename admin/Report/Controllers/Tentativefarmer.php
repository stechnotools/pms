<?php
namespace Admin\Report\Controllers;
use Admin\Localisation\Models\DistrictModel;
use Admin\Report\Models\ReportModel;
use Admin\Report\Models\TentativefarmerModel;
use App\Controllers\AdminController;

class Tentativefarmer extends AdminController{
	private $error = array();

    function __construct(){
        $this->tentativefarmerModel=new TentativefarmerModel();
        $this->reportModel=new ReportModel();
        $this->client = \Config\Services::curlrequest([
            'baseURI' => 'http://ommodk.lo/api/v2/',
        ]);

    }

	public function index() {
        $this->template->add_package(array('select2'),true);

        $districtModel=new DistrictModel();
        $data['districts'] = $districtModel->getAll();

        $data['years'] = array();
        for($i = 2019;$i<= date("Y");$i++){
            $j=$i+1;
            $data['years']["$i"] = $i.'-'.$j;
        }

        $data['active_district']=$this->user->getDistrict();
        $data['active_block']=$this->user->getBlock();

        $year = $data['year']=$this->request->getVar('year');
        $district = $data['district']=$this->request->getVar('district')?$this->request->getVar('district'):$data['active_district'];

        $block = $data['block']=$this->request->getVar('block');
        $grampanchayat = $data['grampanchayat']=$this->request->getVar('grampanchayat');
        $village = $data['village']=$this->request->getVar('village');

        $data['state']=false;
        if($year){
            $data['financial_year']=$year.'-'.($year+1);
            $financial_year=getFinancialYear(4,$year);
        }else{
            $year=date("Y");
            $data['financial_year']=$year.'-'.($year+1);
            $financial_year=getFinancialYear(4,$year);
        }
        //printr($financial_year);
        $filter=array(
            'year'=>$year,
            'district'=>$district,
            'block'=>$block,
            'grampanchayat'=>$grampanchayat,
            'village'=>$village,
            'financial_year'=>$financial_year
        );
        $localisation=$this->reportModel->getLocalisation($filter);

        if($localisation){
            $localisation=array_filter($localisation);
            $data['subtitle'] = implode('<br/> ', array_map(
                function ($v, $k) { return sprintf("%s : %s", $k, $v); },
                $localisation,
                array_keys($localisation)
            ));
        }else{
            $data['subtitle']='';
        }

        if($village){
            $data['submissions']= $this->tentativefarmerModel->getTentativefarmerByVillage($filter);
        }else if($grampanchayat){
            $data['submissions']= $this->tentativefarmerModel->getTentativefarmerByGP($filter);
        }else if($block){
            $data['submissions']= $this->tentativefarmerModel->getTentativefarmerByBlock($filter);
        }else if($district){
            $data['submissions']= $this->tentativefarmerModel->getTentativefarmerByDistrict($filter);
            //printr($data['submissions']);
            //exit;
        }else{
            $data['submissions']= $this->tentativefarmerModel->getTentativefarmerByState($filter);
            $data['state']=true;
        }
        $data['title'] = "Abstract of Tentative Framer: ".$data['financial_year'];
        $data['action']=admin_url('report/tentativefarmer');
        $data['download_excel_url'] = site_url('report/tentativefarmer/excel');
        $data['download_pdf_url'] = site_url('report/tentativefarmer/pdf');

        if($this->request->isAJAX()){
            return $this->template->view('Admin\Report\Views\tentativefarmer\abstract',$data,true);
        }else {
            return $this->template->view('Admin\Report\Views\tentativefarmer\abstract',$data);
        }
    }

    public function tentative_abstract(){
        $this->template->add_package(array('select2'),true);

        $districtModel=new DistrictModel();
        $data['districts'] = $districtModel->getAll();

        $data['years'] = array();
        for($i = 2019;$i<= date("Y");$i++){
            $j=$i+1;
            $data['years']["$i"] = $i.'-'.$j;
        }

        $data['active_district']=$this->user->getDistrict();
        $data['active_block']=$this->user->getBlock();

        //printr($data);
        $year = $data['year']=$this->request->getVar('year');
        $district = $data['district']=$this->request->getVar('district')?$this->request->getVar('district'):$data['active_district'];

        $block = $data['block']=$this->request->getVar('block');
        $grampanchayat = $data['grampanchayat']=$this->request->getVar('grampanchayat');
        $village = $data['village']=$this->request->getVar('village');

        $data['state']=false;
        if($year){
            $data['financial_year']=$year.'-'.($year+1);
            $financial_year=getFinancialYear(4,$year);
        }else{
            $year=date("Y");
            $data['financial_year']=$year.'-'.($year+1);
            $financial_year=getFinancialYear(4,$year);
        }
        //printr($financial_year);
        $filter=array(
            'year'=>$year,
            'district'=>$district,
            'block'=>$block,
            'grampanchayat'=>$grampanchayat,
            'village'=>$village,
            'financial_year'=>$financial_year
        );
        $localisation=$this->reportModel->getLocalisation($filter);
        if($localisation){
            $localisation=array_filter($localisation);
            $data['subtitle'] = implode('<br/> ', array_map(
                function ($v, $k) { return sprintf("%s : %s", $k, $v); },
                $localisation,
                array_keys($localisation)
            ));
        }else{
            $data['subtitle']='';
        }

        $response=$this->client->request('POST', 'tentative_abstract',[
            "headers" => [
                "Accept" => "application/json"
            ],
            'form_params' =>$filter,
        ]);

        if (strpos($response->getHeader('content-type'), 'application/json') !== false) {
            $data['result'] = json_decode($response->getBody(),true);
        }else{
            $data['result']=[];
        }
        //printr($data['result']);
        //exit;



        $data['action']=admin_url('report/tentativefarmer/abstract');
        $data['download_excel_url'] = site_url('report/tentativefarmer/excel');
        $data['download_pdf_url'] = site_url('report/tentativefarmer/pdf');
        if($this->request->isAJAX()){
            $data['filter']=$this->request->getVar('filter');
            $data['download']=$this->request->getVar('download');
            return $this->template->view('Admin\Report\Views\tentativefarmer\abstract1',$data,true);
        }else {
            $data['filter']=1;
            $data['download']=1;
            return $this->template->view('Admin\Report\Views\tentativefarmer\abstract1',$data);
        }
    }

    public function map(){
        $this->template->add_package(array('inlinesvg'),true);
        $data=[];
        if($this->request->isAJAX()){
            return $this->template->view('Admin\Report\Views\tentativefarmer\mapfarmer',$data,true);
        }else {
            return $this->template->view('Admin\Report\Views\tentativefarmer\mapfarmer',$data);
        }
    }
}

return  __NAMESPACE__ ."\\Tentativefarmer";
