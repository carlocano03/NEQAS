<?php
if(!function_exists('getpost'))
{
       function getpost($t,$fpost){
	 $ci =&get_instance();
         $ci->load->database();
    	 $result = $ci->db->get($t);
	 $_colnames = $result->list_fields();
         $data  = array();
			   
		foreach ($fpost as $key=>$value) {
			if(in_array($key,$_colnames) ||  $key=='url')
				   	$data[$key]	 = $value;
		}
		 		return $data;	
	}
}
