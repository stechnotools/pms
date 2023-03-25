<?php 
namespace Admin\Common\Controllers;
use App\Controllers\AdminController;

class Leftbar extends AdminController{

	public function __construct()
	{
		$this->user=service('user');
	}
	public function index()
	{
		
		$data = [];

        $data['menus'][] = [
            'id'       => 'menu-navigation',
            'icon'	  => '',
            'name'	  => lang('Leftbar.text_navigation'),
            'heading' => 1,
            'children'=> []
        ];
		// Dashboard
		$data['menus'][] = [
			'id'       => 'menu-home',
			'icon'	  => 'uil-home-alt',
			'name'	  => lang('Leftbar.text_home'),
			'href'     => base_url('/'),
            'heading' => 0,
			'children' => []
		];

        $data['menus'][] = [
            'id'       => 'menu-dashboard',
            'icon'	  => 'uil-chart',
            'name'	  => lang('Leftbar.text_my_dashboard'),
            'href'     => base_url('my_dashboard'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-tdashboard',
            'icon'	  => 'uil-layer-group',
            'name'	  => lang('Leftbar.text_team_dashboard'),
            'href'     => base_url('team_dashboard'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-project',
            'icon'	  => 'uil-briefcase',
            'name'	  => lang('Leftbar.text_project'),
            'href'     => base_url('project'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-task',
            'icon'	  => 'uil-clipboard-alt',
            'name'	  => lang('Leftbar.text_task'),
            'href'     => base_url('task'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-member',
            'icon'	  => 'uil-user-square',
            'name'	  => lang('Leftbar.text_member'),
            'href'     => base_url('users'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-support',
            'icon'	  => 'uil-envelope-question',
            'name'	  => lang('Leftbar.text_support'),
            'href'     => base_url('support'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-todo',
            'icon'	  => 'uil-list-ui-alt',
            'name'	  => lang('Leftbar.text_todo'),
            'href'     => base_url('todo'),
            'heading' => 0,
            'children' => []
        ];

        $data['menus'][] = [
            'id'       => 'menu-calendar',
            'icon'	  => 'uil-calender',
            'name'	  => lang('Leftbar.text_calendar'),
            'href'     => base_url('calendar'),
            'heading' => 0,
            'children' => []
        ];




		// System
		$system = [];
		
		if ($this->user->hasPermission('access', 'setting/index')) {
			$system[] = [
				'name'	  => lang('Leftbar.text_general'),
                'icon'	  => 'uil-cog',
				'href'     => admin_url('setting'),
                'heading' => 0,
				'children' => []
			];
		}

		if ($this->user->hasPermission('access', 'setting/serverinfo/index')) {
			$system[] = [
				'name'	  => lang('Leftbar.text_team'),
				'href'     => admin_url('team'),
                'heading' => 0,
				'children' => []
			];
		}

        if ($this->user->hasPermission('access', 'setting/serverinfo/index')) {
            $system[] = [
                'name'	  => lang('Leftbar.text_thematic'),
                'href'     => admin_url('thematic'),
                'heading' => 0,
                'children' => []
            ];
        }
        if ($this->user->hasPermission('access', 'setting/serverinfo/index')) {
            $system[] = [
                'name'	  => lang('Leftbar.text_role'),
                'href'     => admin_url('userrole'),
                'heading' => 0,
                'children' => []
            ];
        }
        if ($this->user->hasPermission('access', 'setting/serverinfo/index')) {
            $system[] = [
                'name'	  => lang('Leftbar.text_statuses'),
                'href'     => admin_url('taskstatus'),
                'heading' => 0,
                'children' => []
            ];
        }
       


		if ($system) {
			$data['menus'][] = [
				'id'       => 'menu-system',
				'icon'	   => 'uil-cog',
				'name'	   => lang('Leftbar.text_setting'),
				'href'     => '',
                'heading' => 0,
				'children' => $system
			];
		}



		return view('Admin\Common\Views\leftbar',$data);
	}
}

/* End of file templates.php */
/* Location: ./application/modules/templates/controllers/templates.php */
