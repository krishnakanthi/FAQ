<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
* Description: Login model class
*/
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    public function validate(){
        //print_r($this->input->post);die;
        // grab user input		
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        if(empty($username) && empty ($password))
            return false;
        // Prep the query
        $this->db->where('login', $username);
        $this->db->where('password', $password);
        
        // Run the query
        $query = $this->db->get('iboomerang_login');
		//echo $this->db->last_query(); exit;
        //print_r($query);die;
        // Let's check if there are any results
        if($query->num_rows() > 0)
        {
            //echo "SELECT  `iboom_userterms`.`term_signed_by` FROM `iboom_terms` LEFT JOIN `iboom_userterms` ON `iboom_terms`.`term_id` = `iboom_userterms`.`term_id` AND `iboom_userterms`.`iboomerangid` =".$row->iboomerangid." WHERE iboom_terms.term_id =1";die;
          
            // If there is a user, then create session data
            $row = $query->row();
//            $terms = $this->db->query("SELECT  `iboom_userterms`.`term_signed_by` FROM `iboom_terms` LEFT JOIN `iboom_userterms` ON `iboom_terms`.`term_id` = `iboom_userterms`.`term_id` AND `iboom_userterms`.`iboomerangid` =".$row->iboomerangid." WHERE iboom_terms.term_id =2")->row();
//            //print_r($terms);die;
//            if(is_null($terms->term_signed_by))
//                redirect('http://sandbox.my.iboomerang.com/terms/terms.php?term_id=2');              
            $data = array(
                    'userid' => $row->iboomerangid,
                    'fname' => $row->fname,
                    'lname' => $row->lname,
                    'username' => $row->login,
                    'accesslevel' => $row->accesslevel,
                    'companyid' => $row->companyid,
                    'terms' => $terms->term_signed_by,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
			setcookie('iboomerangid',$row->iboomerangid,time()+60*60*12,"/");
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
	
	public function fetchUserDetails($iboomId){
		$this->db->where('iboomerangid', $iboomId);
		$query = $this->db->get('iboomerang_login');
		if($query->num_rows() == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'userid' => $row->iboomerangid,
                    'fname' => $row->fname,
                    'lname' => $row->lname,
                    'username' => $row->login,
                    'accesslevel' => $row->accesslevel,
                    'companyid' => $row->companyid,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
			return true;
        }
	}
        
        public function checkLogin(){
            if(!$this->session->userdata('validated') || (!isset($_COOKIE['iboomerangid']) && trim($_COOKIE['iboomerangid']) == 0)){
                    $this->session->unset_userdata('validated');
                    $this->session->sess_destroy();
                    setcookie("iboomerangid","0",time()-60*60*100,"/");
                    setcookie("webconfcontrol_id","0",time()-60*60*100,"/");
                    session_destroy();
                    redirect('login');
            } else{
                if($this->checkTerms($this->session->userdata('userid'))){
                    //redirect('http://my.iboomerang.com/terms/terms.php?term_id=1');
                    if (strpos($_SERVER['HTTP_HOST'], 'sandbox') !== FALSE):
                        $root = substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], '.'));
                        $later = substr($_SERVER['HTTP_HOST'], strpos($_SERVER['HTTP_HOST'], '.'));
                        $path = 'http://' . $root . '.my' . $later . '/terms/terms.php?term_id=1';
                    else:
                        $path = 'http://' . $_SERVER['HTTP_HOST'] . '/terms/terms.php?term_id=1';
                    endif;
                    redirect($path);
                }
                return true;
            }
        }
        
        private function checkTerms($userId){
            $sql = "SELECT  `iboom_userterms`.`term_signed_by` 
                FROM `iboom_terms` LEFT JOIN `iboom_userterms` ON `iboom_terms`.`term_id` = `iboom_userterms`.`term_id` 
                AND `iboom_userterms`.`iboomerangid` =".$userId." WHERE iboom_terms.term_id =1";
            $exe = $this->db->query($sql);
            $terms = $exe->result();
            $terms = $terms['0'] ;
            if(is_null($terms->term_signed_by)):
                return true;
            endif;
            return false;
        }
        
	public function checkFrontLogin(){
            if(!$this->session->userdata('validated') && (!isset($_COOKIE['iboomerangid']) && trim($_COOKIE['iboomerangid']) == 0)){
                   $this->destroySession();
                    //redirect('login');
                    return false;
            } elseif(!$this->session->userdata('validated') || (!isset($_COOKIE['iboomerangid']) && trim($_COOKIE['iboomerangid']) == 0)){
                if(isset($_COOKIE['iboomerangid']) && trim($_COOKIE['iboomerangid']) != 0){
                    $this->fetchUserDetails((int)trim($_COOKIE['iboomerangid']));             
                    return true;
                } elseif(!isset($_COOKIE['iboomerangid'])  &&  trim($_COOKIE['iboomerangid']) == 0){
                    $this->destroySession();
                    //redirect('login');
                    return false;
                } elseif($this->session->userdata('validated')){
                    setcookie('iboomerangid',$this->session->userdata('userid'),time()+60*60*12,"/");
                    return true;
                }               
            } else {
                return true;
            }
	}
        
        public function destroySession(){
            $this->session->unset_userdata('validated');
            $this->session->sess_destroy();
            setcookie("iboomerangid","0",time()-60*60*100,"/");
            setcookie("webconfcontrol_id","0",time()-60*60*100,"/");
            session_destroy();
        }
}
?>