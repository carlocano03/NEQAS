<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('activity_logger'))
{
    function activity_logger($var = '')
    {
    	$CI =& get_instance();
        $data['user'] = $_SESSION['username'];
        $data['info'] = $var;
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $CI->db->insert('activity_logs', $data);

    }   


}
if ( ! function_exists('getView')){

    function getView(){
    	$CI =& get_instance();
    	$sql = "SELECT * FROM users WHERE username='" . $_SESSION['username']. "'";
    	$result = $CI->db->query($sql);
    	$user = $result->row();
    	$view = "user/login";
    	
    	if($user->info==1) $view="info";
    	if($user->triage==1) $view="triage";
    	if($user->abc==1) $view="abc";
    	if($user->derma==1) $view="derma";
    	if($user->arg==1) $view="arg";
    	if($user->billing==1) $view="billing";
    	if($user->cashier==1) $view="cashier";
    	if($user->lab==1) $view="laboratory";
    	if($user->emergency==1) $view="emergency";
    	if($user->pharmacy==1) $view="pharmacy";
    	if($user->medical==1) $view="medical";
    	if($user->csr==1) $view="csr";
    	if($user->radiology==1) $view="radiology";
    	if($user->lab==1) $view="laboratory";
    	return $view;

    }

    }