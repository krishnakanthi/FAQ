<?php
class Addressbook extends CI_Controller
{
    private $per_page = 12;
    private $num_links = 5;
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('validated')){
            redirect('login');
        }
		$this->load->model('login_model');
		$this->login_model->checkLogin();
        $this->load->library('template');

        $this->template->prepend_metadata('<link href="/ett_new/assets/css/style.css" rel="stylesheet" type="text/css">');
        $this->template->prepend_metadata('<script language="javascript" src="images/menu.js"></script>');

        $this->load->helper('url');
        $this->load->library('pagination');
        // load model
        $this->load->model('addressbook_Model','',TRUE);
        $this->load->model('validationModel','',TRUE);
        $this->load->model('manageListModel','',TRUE);      
        
    }

    public function index()
    {
        $total = $this->addressbook_Model->count_all()->result();
        // Config setup
        //$p2_link = ($this->uri->segment(4)) ? $this->uri->segment(3,0).'/' : '';
        $config['base_url'] = base_url().'addressbook/index/';
        $config['total_rows'] = $total[0]->count;
        $config['per_page'] = $this->per_page;
        $config["uri_segment"] = 3;
        // I added this extra one to control the number of links to show up at each page.
        $config['num_links'] = $this->num_links;
        //get all the URI segments for pagination and sorting
        $segment_array=$this->uri->segment_array();
        $segment_count=$this->uri->total_segments();
        $data['page']=$segment_array[$segment_count];
        // Initialize
        $pagination_1=new CI_Pagination();
        $pagination_1->initialize($config);
        
        $data['pagination_link_1']=$pagination_1->create_links();
		     
        $config2 = array();
        $config2["base_url"] = base_url().'addressbook/index/'.$this->uri->segment(3,0).'/';
        $config2["total_rows"] = $total[0]->count;
        $config2["per_page"] = $this->per_page;
        $config2["uri_segment"] = 4;
        
        // I added this extra one to control the number of links to show up at each page.
        $config2['num_links'] = $this->num_links;

        $pagination_2=new CI_Pagination();
        $pagination_2->initialize($config2);
        
        $data['pagination_link_2']=$pagination_2->create_links();
    
        $segment_array[$segment_count] = (int) $segment_array[$segment_count];
        $segment_array[$segment_count-1] = (int) $segment_array[$segment_count-1];
        
        $data['title'] = 'addressbook';
        $data['action'] = site_url('addressbook/addContact');
        $data['link_back'] = anchor('addressbook/index/','Back to list of addressbook',array('class'=>'back'));
        $page1 = ($this->uri->segment(3,0)) ? $this->uri->segment(3,0) : 0;
        $conts = $this->addressbook_Model->list_all($this->per_page, $page1)->result();      
        foreach($conts as $contact):
            $contact->phonenumber = $this->phone_format($contact->phonenumber);
            $contact->cellphone = $this->phone_format($contact->cellphone);
        endforeach;
        $data['contacts'] = $conts;        
        $page2 = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $rconts = $this->addressbook_Model->list_all_recent_page($this->per_page, $page2)->result();;
        foreach($rconts as $contact):
            $contact->phonenumber = $this->phone_format($contact->phonenumber);
            $contact->cellphone = $this->phone_format($contact->cellphone);
        endforeach;
        $data['contacts_recent'] =   $rconts;      
        $data['latest_lists'] = $this->addressbook_Model->fetchRecentMarketingLists($this->session->userdata('userid'));
        $this->loadView('index',$data);
    }
    private function loadView($viewName,$data=NULL){
        $this->load->view('layouts/header');
        $this->load->view($viewName,$data);
        $this->load->view('layouts/footer');
    }    
    function export($con){  
        
        $array = array(
                array('Name', 'Email', 'Phone')
              
        );
        if($con == 'all')
        {
            $contacts = $this->addressbook_Model->get_con_exp_all(); 
        }
        else {    
        $con =substr($con,0,-1);
        $con_ids = str_replace('-',',',$con);   //explode('-',$con);
        //print_r($con_ids);die;
        $contacts = $this->addressbook_Model->get_con_exp($con_ids);      
        }
        foreach($contacts as $contact){
            $array[] = $contact;
        }
        $this->load->helper('csv');
        array_to_csv($array, 'export.csv');        
        //$this->loadView('index',$data);
    }   
    function addContact(){
        // set common properties
        $data['title'] = 'Add new entry';
        $data['action'] = site_url('addressbook');
        $data['link_back'] = anchor('addressbook/index/','Back to list of addressbook',array('class'=>'back'));
        $opt = '';
        // save data
       
        $rdt = array('-','_',' ','(',')','.');
        $_POST['contactPhone'] = str_replace($rdt,'',$_POST['contactPhone']);
        if(!$this->addressbook_Model->check_duplicate(trim($_POST['contactEmail']))){
            if($this->validationModel->validate_alpha_space(trim($_POST['contactName'])) && $this->validationModel->validate_email(trim($_POST['contactEmail']))   ){
                $entry = array('name' => $_POST['contactName'],
                                'email' => $_POST['contactEmail'],
                                'phonenumber' => $_POST['contactPhone'],
                                'company' => $_POST['contactcompany'],
                                'street' => $_POST['contactstreet'],
                                'city' => $_POST['contactcity'],
                                'zip' => $_POST['contactzip'],
                                'cellphone' => $_POST['contactcellphone'],
                                'webaddress' => $_POST['contactwebaddress'],
                                'iboomerangid' => $this->session->userdata('userid'));
                $id = $this->addressbook_Model->insert($entry);
                // set user message
                $this->session->set_flashdata('importError', '<div class="success">Added new contact successfully</div>');
            } else {
                if(!$this->validationModel->validate_email(trim($_POST['contactEmail']))){
                    $opt .= 'Valid Email';
                }
                if(!$this->validationModel->validate_alpha_space(trim($_POST['contactName']))){
                    if(!empty($opt)){
                        $opt .= ' and ';
                    }
                    $opt .= 'Valid Name';
                }

                else if((!$this->validationModel->validate_numeric($_POST['contactPhone']) || strlen($_POST['contactPhone']) < 10) && $_POST['contactPhone']!=''){

                    if(!empty($opt)){
                        $opt .= ' and ';
                    }
                    else $opt .= 'Valid Phone Number';
                }

                if(!empty($opt)) $this->session->set_flashdata('importError', '<div class="success">Please fill ' . $opt . '</div>');
            }
        }else {
            $this->session->set_flashdata('importError', '<div class="success">Duplicate Email Address</div>');
        }

         
        redirect('/addressbook/index');
    }
    function updateContact(){
        //echo 'hi';
        //print_r($this->validationModel->validate_alpha_space(trim($_POST['editcontactName'])));die;
        //if($this->validationModel->validate_alpha_space(trim($_POST['editcontactName'])) && $this->validationModel->validate_email(trim($_POST['editcontactEmail']))){
        $rdt = array('-','_',' ','(',')','.');
        $_POST['editcontactPhone'] = str_replace($rdt,'',$_POST['editcontactPhone']);
        if($this->validationModel->validate_alpha_space(trim($_POST['editcontactName'])) && $this->validationModel->validate_email(trim($_POST['editcontactEmail'])) && !is_nan($_POST['editcontactPhone']) && strlen($_POST['editcontactPhone']) == 10 ){
            $contact = array('name' => $_POST['editcontactName'],
			'email' => $_POST['editcontactEmail'],
			'company' => $_POST['editcompany'],
			'street' => $_POST['editstreet'],
			'city' => $_POST['editcity'],
			'zip' => $_POST['editzip'],
			'cellphone' => $_POST['editcellphone'],
			'webaddress' => $_POST['editwebaddress'],
                        'phonenumber' => $_POST['editcontactPhone']);
            //echo 'hi';die;
            $this->addressbook_Model->update($_POST['editcontactId'],$contact);
            $this->session->set_flashdata('importError', '<div class="success">Contact Updated Successfully.</div>');
        } else {
            if(!$this->validationModel->validate_email(trim($_POST['editcontactEmail']))){
                $opt .= 'Valid Email';
            }
            if(!$this->validationModel->validate_alpha_space(trim($_POST['editcontactName']))){
                if(!empty($opt)){
                    $opt .= ' and ';
                }
                $opt .= 'Valid Name';
            }
            if(is_nan(trim($_POST['editcontactPhone'])) || strlen(trim($_POST['editcontactPhone'])) > 10 || (strlen(trim($_POST['editcontactPhone'])) < 10 && strlen(trim($_POST['editcontactPhone'])) > 0)){
                if(!empty($opt)){
                    $opt .= ' and ';
                }
                $opt .= 'Valid Phone Number';
            }
            $this->session->set_flashdata('importError', '<div class="success">Please fill ' . $opt . '</div>');
        }
        
        redirect('/addressbook/index');
    }
      
    function importGContacts(){
        //error_reporting(1);
        require_once 'Zend/Loader.php';
        //print_r(BASEPATH.'../assets/Zend/Loader.php');
        Zend_Loader::loadClass('Zend_Gdata');
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Http_Client');
        Zend_Loader::loadClass('Zend_Gdata_Query');
        Zend_Loader::loadClass('Zend_Gdata_Feed');

        // set credentials for ClientLogin authentication
        $user = $_POST['gmail_id'];
        $pass = $_POST['gmail_password'];
        //echo 'hi'.$user.'---'.$pass;die;
        try {
          // perform login and set protocol version to 3.0
          $client = Zend_Gdata_ClientLogin::getHttpClient(
            $user, $pass, 'cp');
          $gdata = new Zend_Gdata($client);
          //print_r($gdata);die;
          $gdata->setMajorProtocolVersion(3);

          // perform query and get result feed
          $query = new Zend_Gdata_Query(
            'http://www.google.com/m8/feeds/contacts/default/full?max-results=2500');
          $feed = $gdata->getFeed($query);

          // display title and result count

          // parse feed and extract contact information
          // into simpler objects
          //print_r($feed);die;
          $results = array();
          foreach($feed as $entry){

            $xml = simplexml_load_string($entry->getXML());
            $obj = new stdClass;
            $obj->name = (string) $entry->title;
            $obj->orgName = (string) $xml->organization->orgName; 
            $obj->orgTitle = (string) $xml->organization->orgTitle; 
          //echo 'hi'.$xml->email;  
            foreach ($xml->email as $e) {
              $obj->emailAddress[] = (string) $e['address'];
            }

            foreach ($xml->phoneNumber as $p) {
              $obj->phoneNumber[] = (string) $p;
            }
            foreach ($xml->website as $w) {
              $obj->website[] = (string) $w['href'];
            }

            $results[] = $obj;  
           // print_r($obj);
          }
        } catch (Exception $e) {
          //die('ERROR:' . $e->getMessage());
          $this->session->set_flashdata('importError', 'ERROR:' . $e->getMessage());
          redirect('addressbook/index');
        }

        // display results
       // echo sizeof($results);die;
        $dup_emails = array();
        foreach ($results as $r) {
                    //echo @join(', ', $r->phoneNumber);
                    //echo "Name:".$r->name."<br> Phone:".@join(', ', $r->phoneNumber)."<br> Email:".@join(', ', $r->emailAddress)."<br>";
            if($r->name != '') $g_name = $r->name;
            else {
                $e_n = explode('@',@join(', ', $r->emailAddress));
                $g_name = $e_n[0];
            }
            if(!$this->addressbook_Model->check_duplicate(@join(', ', $r->emailAddress))){
            $contact[] = array(

                        "name"  => $g_name,
                        "email" => @join(', ', $r->emailAddress),
                        "phonenumber" => @join(', ', $r->phoneNumber),
                        'iboomerangid' => $this->session->userdata('userid')
                    );            
            }  else {
                $dup_emails[] = $csv_row[1];
        }
        }
        //print_r($contact);//die;
        if(count($dup_emails)>0){
                $demails = '';
                foreach($dup_emails as $email){
                    $demails .= $email.'<br/>';
                }
                $this->session->set_flashdata('importError', '<div class="success">'.count($dup_emails).' Duplicate Emails Found.<br/><br/>'.$demails.'</div>');
        }
        $this->addressbook_Model->import_contacts($contact);
//echo $this->db->last_query();
        $this->session->set_flashdata('importError', 'Contacts imported successfully');
        redirect('addressbook/index');
        
    }    
    function importContactCSV(){
        $config['upload_path'] = realpath('uploads');
        $config['allowed_types'] = 'text/plain|text/csv|csv';
        $config['max_size'] = '10000';
        $config['file_name'] = 'upload' . time();
        $dup_emails = array();
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('importContactsCSV')) echo $this->upload->display_errors();
        else {
            $file_info = $this->upload->data();
            $csvfilepath = "uploads/" . $file_info['file_name'];
            $fh = fopen($csvfilepath, "r");
            $success = 0;
            $failed = 0;
            while (($csv_row = fgetcsv($fh, 2000, ',')) !== false) {

                foreach ($csv_row as &$row) {
                    $row = strtr($row, array("'" => "\'", '"' => '\"'));
                }
                if(!$this->addressbook_Model->check_duplicate($csv_row[1])){
                if($this->validationModel->validate_alpha_space(trim($csv_row[0])) && $this->validationModel->validate_email(trim($csv_row[1]))){
                     //&& $this->validationModel->validate_numeric(trim($csv_row[2])) || strlen(trim($csv_row[2])) >= 10
                    $contact = array(
                        "name"  => $csv_row[0],
                        "email" => $csv_row[1],
                        //"phonenumber" => $csv_row[2],
                        'iboomerangid' => $this->session->userdata('userid')
                    );
                    $this->addressbook_Model->insert_ignore($contact);
                }
                }else{
                    $dup_emails[] = $csv_row[1];
            }

        }
            if(count($dup_emails)>0){
                $demails = '';
                foreach($dup_emails as $email){
                    $demails .= $email.'<br/>';
                }
                $this->session->set_flashdata('importError', '<div class="success">'.count($dup_emails).' Duplicate Emails Found.<br/><br/>'.$demails.'</div>');
            }
        redirect('/addressbook/index');
    }
    }
    
    public function updateList(){
        $data = $_POST;
        if($this->manageListModel->editList($data)){
            redirect('/addressbook');
        }
    }
    public function deletecontacts(){
         $this->addressbook_Model->deletecontacts($_REQUEST['dellID']);
    } 
    public function sort_addressbook($random, $searchid, $start=NULL){
        $searchID=urldecode($searchid);
        if(!is_null($start)){
            $check = true;
        } else {
            $check = false;
        }
        $res = $this->SortList($searchID, $check);
        print_r($res->data);
    }
    public function search_addressbook(){
        //print_r($_POST); exit;
        $searchID=urldecode(trim(urldecode($_POST['searchfor'])));
        if($_POST['searchvalue'] == 'search'){
            $check = true;
        } else {
            $check = false;
        }
        print_r($this->SortList($searchID, $check,false, $_POST['curpage']));
        
    }
    public function SortList($searchID, $start=false, $stype=FALSE, $curpage = false) 
    {
        if(!$stype){
        if(!$start){
            if ($searchID!="") {
                    $searchQuery=" AND name LIKE '$searchID%' ORDER BY name ASC "; 
            } else { $searchQuery=""; }
            
        } else{
            if ($searchID!="") {
                    $searchQuery .=" AND (name LIKE '%$searchID%'";
                    $searchQuery .=" OR email LIKE '%$searchID%') ";
                    $searchQuery .="ORDER BY name ASC "; 
            } else { $searchQuery=""; }
        }
        }else{
            switch ($stype):
                case 'name':
                    $searchQuery .=" AND (name LIKE '%$searchID%' OR email LIKE '%$searchID%')";
                    break;
                case 'email':
                    $searchQuery .=" AND email LIKE '%$searchID%' ";
                    break;
                case 'number':
                    $searchQuery .=" AND phonenumber LIKE '%$searchID%' ";
                    break;
                default:
                    $searchQuery .=" AND name LIKE '%$searchID%'";
                    break;
            endswitch;
        }
	$limitCond = " limit ".($curpage?$curpage:0).",".($this->per_page?$this->per_page:12);
        $sql = "SELECT * FROM newsletter_list_emails WHERE iboomerangid=" . $this->session->userdata['userid'] . " AND `listid` = 0 ".$searchQuery  . $limitCond;
        $res = mysql_query($sql) or die(mysql_error());
        $config['base_url'] = base_url().'addressbook/search_addressbook/';
        $config['total_rows'] = mysql_num_rows(mysql_query($sql = "SELECT * FROM newsletter_list_emails WHERE iboomerangid=" . $this->session->userdata['userid'] . " AND `listid` = 0 ".$searchQuery));
        $config['per_page'] = $this->per_page;
        $config['num_links'] = $this->num_links;
        $config['cur_page'] = $curpage?$curpage:0;
        $config["anchor_class"] = 'class="plink"';
        $pagination = new CI_Pagination();
        $pagination->initialize($config);
        $result = array();
        while($row = mysql_fetch_array( $res )) {
            $result['data'][] = array(
                        "id"=>$row['id'], 
                        "name"=>$row['name'], 
                        "email"=>$row['email'],
                        "phone"=>$this->phone_format($row['phonenumber']),
                        "editdata" =>  $row['id'].'&&'.$row['name'].'&&'.$row['email'].'&&'.$this->phone_format($row['phonenumber']).'&&'.$row['company'].'&&'.$row['street'].'&&'.$row['city'].'&&'.$row['zip'].'&&'.$this->phone_format($row['cellphone']).'&&'.$row['webaddress']
                    );
        }
        if(count($result['data'])<1) $result['data'] = false;
        $result['paging'] = $pagination->create_links();
        return json_encode($result);
    }
    function phone_format($str,$extension = FALSE){
        // Keep only be digits
        $strPhone = ereg_replace("[^0-9]",'', $str);
        if(is_numeric($strPhone)){
            $strArea = substr($strPhone, 0, 3);
            $strPrefix = substr($strPhone, 3, 3);
            $strNumber = substr($strPhone, 6, 4);
            $strExtens = substr($strPhone,10);

            $strPhone = ($strArea?$strArea:'') . '-' . $strPrefix . '-' . $strNumber;

            if ($strExtens && $extension){
                $strPhone .= ' X'.$strExtens;
            }
        }else{
            $strPhone = '';
        }
        return $strPhone;
    }

}
