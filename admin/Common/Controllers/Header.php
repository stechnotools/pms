<?php
namespace Admin\Common\Controllers;
use App\Controllers\AdminController;

class Header extends AdminController
{
	public function __construct()
    {
		$this->settings = new \Config\Settings();
	}

    /**
     * @return string
     */
    public function index()
	{
		$data=array();
		
		$data['site_name'] = $this->settings->config_site_title??"";
		if (isset($this->settings->config_site_title) && is_file(DIR_UPLOAD . $this->settings->config_site_logo)) {
			$data['logo'] = base_url('uploads') . '/' . $this->settings->config_site_logo;
		} else {
			$data['logo'] = '';
		}
		$data['logout'] = admin_url('logout');

		if($this->session->get('temp_user')){
		    $data['relogin']=true;
        }else {
            $data['relogin']=false;
        }
		$data['name']=$this->user->getFirstName();
        $data['role']=$this->user->getGroupName();
        $data['photo']=$this->user->getImage();
		if($this->user->isLogged()){
			$leftbar = new Leftbar(); // Create an instance
			$data['menu']=$leftbar->index();
            /*$menu = new \App\Libraries\Menu(); // Create an instance
            $data['menu']=$menu->nav_menu([
                'theme_location'=>'admin',
                'menu_class'     => 'nav-main'
            ]);*/
		}

		if ($this->uri->getSegment(1)) {
			$data['class'] = $this->uri->getSegment(1);
		} else if(!$this->user->isLogged()){
			$data['class'] = 'authentication-bg pb-0';
		}else{
            $data['class']="";
        }
		return view('Admin\Common\Views\header',$data);
		
	}
}

return  __NAMESPACE__ ."\Header";
?>