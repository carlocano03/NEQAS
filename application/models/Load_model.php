<?php
defined('BASEPATH') OR exit('No direct script access allowed');

   class Load_model extends CI_Model {
     var $table = 'tbl_laboratory';
     var $column_order = array('institution_name','email_add','contact_no'); //set column field database for datatable orderable
     var $column_search = array('institution_name','email_add','contact_no'); //set column field database for datatable searchable
     var $order = array('id' => 'desc'); // default order

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
 		$this->db->from($this->table);
 		return $this->db->count_all_results();
 	}

 	public function count_filtered_application()
 	{
 		$this->_get_application_query();
 		$query = $this->db->get();
 		return $query->num_rows();
 	}

 	public function _get_application_query()
 	{
    if ($this->input->post('institution_name'))
    {
      $this->db->where('institution_name', $this->input->post('institution_name'));
    }
 		$this->db->from($this->table);
    $this->db->where('tbl_laboratory.userID', $_SESSION['loggedIn']['user_id']);
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


  function labList($postData){

     $response = array();

     if(isset($postData['search']) ){
       // Select record
       // $this->db->select('*');
       // $this->db->where('userID', $_SESSION['loggedIn']['user_id']);
       // $this->db->where("institution_name like '%".$postData['search']."%'");
       // $records = $this->db->get('tbl_laboratory')->result();

       $this->db->from('tbl_laboratory');
       $this->db->join('tbl_participant', 'tbl_participant.lab_ID = tbl_laboratory.labID', 'left');
       $this->db->where('tbl_participant.status_approval =', 'APPROVED');
       $this->db->where('tbl_laboratory.userID', $_SESSION['loggedIn']['user_id']);
       $this->db->where("tbl_laboratory.institution_name like '%".$postData['search']."%'");
       $records = $this->db->get()->result();

       foreach($records as $row)
       {
          $response[] = array(
            "labID" => $row->labID,
            "label" => strtoupper($row->institution_name),
            "province_code" => $row->province_code,
            "mun_code" => $row->municipal_code,
            "brgy_code" => $row->brgy_code,
            "street" => $row->no_street,
            "postal_code" => $row->postal_code,
            "contact_no" => $row->contact_number,
            "email" => $row->email_add,
          );
       }
     }
     return $response;
  }

}
