<?php
namespace Admin\Common\Controllers;
use Admin\Users\Models\UserModel;
use App\Controllers\AdminController;
use App\Libraries\User;
use Google_Client;
use Google_Service_Oauth2;

class Auth extends AdminController
{
    public function __construct()
    {
        $this->uri = service('uri');
    }
    public function login() {
        log_message('debug', 'login 1');

        $data['login_error']='';
        $data['site_name'] = $this->settings->config_site_title;
        if (is_file(DIR_UPLOAD . $this->settings->config_site_logo)) {
            $data['logo'] = base_url('storage/uploads') . '/' . $this->settings->config_site_logo;
        } else {
            $data['logo'] = '';
        }

        $logged_in = $this->user->isLogged();
        if($logged_in){
            log_message('info', 'login 2');
            return redirect()->to(base_url());
        }
        if($this->request->getMethod(1)=='POST'){
            $logged_in = $this->user->login(
                $this->request->getPost('username'),
                $this->request->getPost('password')
            );

        }

        $data['action']=base_url('login');

        if($this->uri->getTotalSegments() > 0){
            $route=uri_string();
            $data['redirect'] = $route;
        } else {
            $data['redirect'] = '';
        }

        //gmail login
        $clientID = getenv('google.clientID');
        $clientSecret = getenv('google.clientSecret');
        $redirectUri = site_url('login');

        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        $data['glogin']=$client->createAuthUrl();

        // authenticate code from Google OAuth Flow

        if (isset($_GET['code'])) {
            log_message('info', 'login 3');

            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            $access_token = $token['access_token'];

            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $email =  $google_account_info->email;
            $name =  $google_account_info->name;
            $photo =  $google_account_info->picture;
            $firstname =  $google_account_info->givenName;
            $lastname =  $google_account_info->familyName;

            $userModel = new UserModel();
            $user = $userModel->where(['email'=>$email])->first();

            if(!$user){
                $user = [
                    'email' => $email,
                    'password' => getenv('app.defaultpassword'),
                    'photo' => $photo,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'token' => $access_token,
                    'color' => rand_color(),
                    'user_group_id' => 2
                ];
                $user_id = $userModel->skipValidation(1)->insert($user);

            } else {
                $user_id = $user->id;
                log_message('info', 'login 4');
            }
            $logged_in = $this->user->loginByUserId($user_id);

        }
        if($logged_in){

            //$redirect = $this->session->get('redirect');
            if ($this->request->getPost('redirect') && (strpos($this->request->getPost('redirect'), base_url()) == 0 )) {
                return redirect()->to($this->request->getPost('redirect'));
            } else{
                return redirect()->to(base_url());
            }
        } else {
            $data['login_error']=$this->session->getFlashdata('error');
        }

        return $this->template->view('Admin\Common\Views\login',$data);

    }

    public function logout() {
        $this->user->logout();
        $this->session->remove('redirect');
        return redirect()->to(admin_url());
    }
    public function reLogin(){

        $user = $this->session->get('temp_user');
        $this->session->set('user',$user);
        $this->user->assignUserAttr($user);
        $this->session->remove('temp_user');
        return redirect()->to(admin_url());
    }
}

return  __NAMESPACE__ ."\Auth";