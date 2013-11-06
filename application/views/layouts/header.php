<?php
        header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
        //$terms = $this->db->query("SELECT  `iboom_userterms`.`term_signed_by` FROM `iboom_terms` LEFT JOIN `iboom_userterms` ON `iboom_terms`.`term_id` = `iboom_userterms`.`term_id` AND `iboom_userterms`.`iboomerangid` =".$row->iboomerangid." WHERE iboom_terms.term_id =2")->row();
        //print_r($terms);die;
//        if(is_null($this->session->userdata['terms']))
//            redirect('http://sandbox.my.iboomerang.com/terms/terms.php?term_id=2');          
        //require_once '../../new.header-html.php';       
        /*require_once '../../backoffice.class.php';*/
//        require_once 'c:/Inetpub/vhosts/iboomerang.com/subdomains/my/httpdocs/new.bo.class.php';
//        $bo = new BackOffice;
//        mysql_select_db('iboomerang_db');
//        $terms = mysql_fetch_assoc(mysql_query("SELECT  `iboom_userterms`.`term_signed_by` FROM `iboom_terms` LEFT JOIN `iboom_userterms` ON `iboom_terms`.`term_id` = `iboom_userterms`.`term_id` AND `iboom_userterms`.`iboomerangid` =".$row->iboomerangid." WHERE iboom_terms.term_id =1"));
//            //print_r($terms);die;
//        if(is_null($terms->term_signed_by))
//                redirect('http://my.iboomerang.com/terms/terms.php?term_id=1');          
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">    
    
    <title>FAQ</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('css/bootstrap.css'); ?>" rel="stylesheet">
   <?php 
   //Temporary login check
   if(!$this->session->userdata['userid']): ?>
    <script type="text/javascript">
        window.location = '<?=base_url().'login'?>';
    </script>    
   <?php endif;
   //$bo->init($this->session->userdata['userid']);
   ?>
</head>



<body >
    <div class="container">
        <div class="container2">