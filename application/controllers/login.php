<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
* Description: Login controller class
*/
class Login extends CI_Controller{
    
    function __construct(){
        parent::__construct();     
        $this->load->model('login_model');        
    }
    
    public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
        //$this->login_model->checkFrontLogin();
        if($this->session->userdata('validated') || $this->login_model->checkFrontLogin()){
            redirect('dashboard/index');
        }
        $data['msg'] = $msg;
        $this->load->view('login_view', $data);
    }
    
    public function process(){
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        }else{
            // If user did validate,
            // Send them to members area
            redirect('dashboard/index');
        }        
    }
    public function do_logout(){
        $this->login_model->destroySession();
        $this->session->unset_userdata('validated');
        $this->session->sess_destroy();
        session_destroy();
        unset($this->session->unset_userdata);
        //print_r($this->session);die;
        //session_destroy();
        redirect('login');
    }
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('login');
        }
    }
    
    public function includeCountHeader($md5){
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: no-store, no-cache, must-revalidate"); 
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type: image/gif");    
        echo base64_decode('R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==');

        if(isset($md5))
        {
            $this->load->model('sendemailModel');
            //echo $md5;
            $this->sendemailModel->updateViewCount($md5);

        }
    }
}
?>