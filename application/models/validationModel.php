<?php
class ValidationModel extends CI_Model {
 
    function __construct(){
        parent::__construct();
    }
    
    /**
     * Purpose: To validate alpha character
     *
     * Access is restricted to class and its child classes
     *
     * @param	varchar	$str String to validate	
     * @return  
     */
	public function validate_alpha_space($str) 
	{
	    $result = preg_match('/^[a-zA-Z ]+$/',$str);
		if( !$result || $result == 0){
	    	return false;
	    } else if($result || $result != 0){
	    	return true;
	    }
	}
        
	public function validate_alphanumeric_space($str) 
	{
	    $result = preg_match('/^[a-zA-Z0-9 ]+$/',$str);
		if( !$result || $result == 0){
	    	return false;
	    } else if($result || $result != 0){
	    	return true;
	    }
	}
        
	public function validate_alphanumeric_space_list($str) 
	{
	    $result = preg_match('/^[a-zA-Z0-9 -]+$/',$str);
		if( !$result || $result == 0){
	    	return false;
	    } else if($result || $result != 0){
	    	return true;
	    }
	}
	
	/**
     * Purpose: To validate numeric character
     *
     * Access is restricted to class and its child classes
     *
     * @param	varchar	$str String to validate	
     * @return  
     */
	public function validate_numeric($str) 
	{
	    //return preg_match('/^[0-9]+$/',$str);
	    if( !preg_match('/^[1-9][0-9]*$/',$str) || preg_match('/^[1-9][0-9]*$/',$str) == 0){
	    	return false;
	    } else if(preg_match('/^[1-9][0-9]*$/',$str) || preg_match('/^[1-9][0-9]*$/',$str) != 0){
	    	return true;
	    }
	}
	

	/**
     * Purpose: To validate digits
     *
     * Access is restricted to class and its child classes
     *
     * @param	varchar	$str String to validate	
     * @return  
     */
	public function validate_digits($str) 
	{
	    //return preg_match('/^[0-9]+$/',$str);
	    if( !preg_match('/^[0-9]+$/',$str) || preg_match('/^[0-9]+$/',$str) == 0){
	    	return false;
	    } else if(preg_match('/^[0-9]+$/',$str) || preg_match('/^[0-9]+$/',$str) != 0){
	    	return true;
	    }
	}
	
	/**
     * Purpose: To validate email
     *                    Allowed characters are .,_,@
     *
     * Access is restricted to class and its child classes
     *
     * @param	varchar	$str String to validate	
     * @return  
     */
	public function validate_email($str) 
	{
	    $regexp = "/^[^0-9_.][a-zA-Z]+[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/";
	    if(preg_match($regexp,$str) || preg_match($regexp,$str) != 0){	    	
                return true;
	    }
	    return false;
	}
        
	public function validate_invalid_character($str) 
	{
	    $regexp = "/[~`!#$%^&*()-+={}[]|:;<>?/\\]+$/";
	    if(preg_match($regexp,$str) || preg_match($regexp,$str) != 0){	    	
                return true;
	    }
	    return false;
	}
        public function validate_phone($str) 
	{
	    $regexp = "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
	    if(preg_match($regexp,$str) || preg_match($regexp,$str) != 0){	    	
                return true;
	    }
	    return false;
	}
    
}