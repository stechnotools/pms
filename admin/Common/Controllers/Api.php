<?php
namespace Admin\Common\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ApiModel;

class Api extends ResourceController
{
    use ResponseTrait;
    private $apiModel;
    private $user;


    public function __construct(){
        helper("aio");
        $this->apiModel=new ApiModel();
        $this->user=service('user');
    }

    public function login(){
        $data['message'] = "Welcome to PMS System";
        return $this->respond($data);
    }



    protected function encodeFunc($value) {
        return "\"$value\"";
    }

    protected function arraysearch($array,$search){
        foreach ($array as $element){
            if(strpos($element,$search)!==FALSE){
                return TRUE;
            }
        }
        return FALSE;
    }
}
