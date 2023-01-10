<?php

class My_Controller extends CI_Controller
{
   function my_page_builder($content,$title=null){
	   $this->load->view('include/header',$data=array('title'=>$title));
	   $this->load->view($content);
	   $this->load->view('include/footer');
   }
}