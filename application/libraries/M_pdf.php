<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 include_once APPPATH.'/third_party/m_pdf/mpdf.php';
 
class M_pdf {
 
    public $param;
    public $pdf;

    public function __construct($param = '"en-GB-x","Letter","","",0,0,0,0,0,0')
    {
        $this->param =$param;
        $this->pdf = new mPDF($this->param);
    }
}