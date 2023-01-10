<?php
defined('BASEPATH') OR exit('No direct script access allowed');

   class Admin_model extends CI_Model {
     var $table = 'tbl_participant';
     var $column_order = array('reference_no','institution_name','email_add','contact_no','date_register','status'); //set column field database for datatable orderable
     var $column_search = array('tbl_participant.reference_no','tbl_laboratory.institution_name'); //set column field database for datatable searchable
     var $order = array('tbl_participant.date_register' => 'desc'); // default order

   /**
    * __construct function.
    *
    * @access Public
    * @return void
    */
   Public function __construct()
   {
       parent::__construct();
       $this->load->database();
   }

  public function get_application_table()
 	{
 		$this->_get_application_query();
 		if($_POST['length'] != -1)
 		$this->db->limit($_POST['length'], $_POST['start']);
 		$query = $this->db->get();
 		return $query->result();
 	}

 	public function count_all_application()
 	{
 		// $this->db->from($this->table);
 		$this->join_table();
 		return $this->db->count_all_results();
 	}

 	public function count_filtered_application()
 	{
 		$this->_get_application_query();
 		$query = $this->db->get();
 		return $query->num_rows();
 	}

 	function join_table()
 	{
 		$this->db->from($this->table);
 		$this->db->join('tbl_laboratory', 'tbl_laboratory.labID = tbl_participant.lab_ID','inner');
    
 		// $this->db->join('tblprogram_Enrollment', 'tblprogram_Enrollment.reference_no = tbl_participant.reference_no', 'inner');
    // $this->db->where('tbl_laboratory.userID', $_SESSION['loggedIn']['user_id']);
 	}

 	public function _get_application_query()
 	{
 		$this->join_table();
 		$i = 0;
 		foreach ($this->column_search as $item) // loop column
 		{
 			if($_POST['search']['value']) // if datatable send POST for search
 			{
 				if($i===0) // first loop
 				{
 					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
 					$this->db->like($item, $_POST['search']['value']);
 				}
 				else
 				{
 					$this->db->or_like($item, $_POST['search']['value']);
 				}
 				if(count($this->column_search) - 1 == $i) //last loop
 					$this->db->group_end(); //close bracket
 			}
 			$i++;
 		}
 		if(isset($_POST['order'])) // here order processing
 		{
 			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
 		}
 		else if(isset($this->order))
 		{
 			$order = $this->order;
 			$this->db->order_by(key($order), $order[key($order)]);
 		}

 	}//end of function

}
