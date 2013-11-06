<?php
require_once "application/models/manageListModel.php";
class Addressbook_Model extends CI_Model {
    // table name
    private $tbl= 'newsletter_list_emails';
    private $manageListObject;
 
    function __construct()
    {
		parent::__construct();
                $this->manageListObject = new ManagelistModel();
                
    }
    function get_con_exp($cids){ 
        $insert_query = "select name,email,phonenumber from newsletter_list_emails where id in (".$cids.") ";
        //echo $insert_query;die;
        return $this->db->query($insert_query)->result_array();
        //print_r($res);die;
        
    }
    function get_con_exp_all(){ 
        $insert_query = "select name,email,phonenumber from newsletter_list_emails where iboomerangid=".$this->session->userdata('userid');//print_r($insert_query);die;
        //echo $insert_query;die;
        return $this->db->query($insert_query)->result_array();
        //print_r($res);die;
        
    }    
    function count_all(){        
        $this->db->select('count(distinct(email)) as count');
		$this->db->where('iboomerangid',$this->session->userdata('userid'));                
		$this->db->where('listid',0);
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl);
    }
    function list_all($per_Page=NULL, $offset=NULL){        
        //$this->db->select('distinct(email) as email, name');
		$this->db->where('iboomerangid',$this->session->userdata('userid'));                
		$this->db->where('listid',0);
		$this->db->order_by('name','asc');
		//$this->db->group_by('email');
		if(!is_null($per_Page)){
			$this->db->limit($per_Page,$offset);
		}
		return $this->db->get($this->tbl);
    }
    function list_all_recent_page($per_Page=NULL, $offset=NULL){        
        //$this->db->select('distinct(email) as email, name');
        $this->db->where('iboomerangid',$this->session->userdata('userid'));                
        $this->db->where('listid',0);
        $this->db->order_by('id','desc');
        //$this->db->group_by('email');
        if(!is_null($per_Page)){
            $this->db->limit($per_Page,$offset);
        }
        return $this->db->get($this->tbl);
    }
    function list_all_recent($lCond = 12){
        //$this->db->select('distinct(email) as email, name');
        $this->db->order_by('id','desc');
        $this->db->where('iboomerangid',$this->session->userdata('userid'));
        $this->db->where('listid',0);
        $this->db->limit($lCond,0);
        return $this->db->get($this->tbl);
    }    
    function check_duplicate($email, $phone = false){
        $this->db->where('email',$email);
        if($phone) $this->db->where('phonenumber',$phone);
        $this->db->where('listid',0);
        $this->db->limit('1');
        $q = $this->db->get($this->tbl);
        return $q->num_rows();
    }
    function import_contacts($entry){
        //$this->db->insert($this->tbl, $entry);
        return $this->db->insert_batch($this->tbl, $entry);
    }    
    // add new person
    function insert($entry){
        $this->db->insert($this->tbl, $entry);
        return $this->db->insert_id();
    }
    //skips the duplicates while adding of contacts in bulk
    function insert_ignore($entry){
        $insert_query = $this->db->insert_string($this->tbl, $entry);
        $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        $this->db->query($insert_query);
        if($this->db->insert_id() > 0){
            return true;
        }
        return false;
    }
    // update person by id
    function update($id, $contact){
        $this->db->where('id', $id);
        $this->db->update($this->tbl, $contact);
        //echo $this->db->last_query();die;
    }
    function recently_added(){
        $this->db->order_by('id','desc');
        $this->db->where('iboomerangid',$this->session->userdata('userid'));
        return $this->db->get($this->tbl);
    }
    
    public function fetchRecentMarketingLists($userId, $listId=NULL){
        return $this->manageListObject->fetchUserLists($userId, $listId, NULL, true, 2, 'Address');
    }
    public function deletecontacts($d_ids){
        //$ids = explode(',', $d_ids);
        $ids = $d_ids;
        $this->db->where_in('id', $ids);
        $this->db->delete($this->tbl);
    }     
    public function get_contact_details($contactid){
        $this->db->where('id', $contactid);
        $this->db->limit('1');
        return $this->db->get($this->tbl);
    }
    public function get_sel_contact_details($cids){
        $this->db->where_in('id', $cids);
        //$this->db->limit('1');
        //print_r($this->db->get($this->tbl)->result());die;
        //echo $this->db->last_query();die;
        return $this->db->get($this->tbl)->result();
    }
}