<?php

class MY_Session extends CI_Session {

public function __construct() {
    parent::__construct();
}

function sess_destroy() {

    //write your update here 
   $sql = "UPDATE sys_staff SET login_status=0 WHERE idnum = '{$_SESSION['ratee']}' ";
   $CI = & get_instance();
   $this->CI->db->query($sql);

    //call the parent 
    parent::sess_destroy();
}

}


