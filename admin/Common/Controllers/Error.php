<?php
namespace Admin\Common\Controllers;

use App\Controllers\AdminController;

class Error extends AdminController
{
	public function __construct(){

    }
	public function index()
	{
        $data = array();
        $this->template->set_meta_title("Error");

        $data['heading_title'] 	= "Error";

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => 'Home',
            'href' => admin_url('')
        );
        $data['breadcrumbs'][] = array(
            'text' => 'Error',
            'href' => admin_url('')
        );

        echo $this->template->view('Admin\Common\Views\error',$data);

    }

}