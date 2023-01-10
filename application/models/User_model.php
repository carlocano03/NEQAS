 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model {

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

    public function user_check($username, $password)
    {
      $this->db->where('username', $username);
      $res = $this->db->get('tblaccount')->row();

      if(!$res){
        return false;
      }else{
        $hash = $res->password;
        if($this->verify_password_hash($password, $hash))
        {
          return $res;
        }else{
            return false;
        }
      }
    }

    private function verify_password_hash($password, $hash)
    {
      return password_verify($password, $hash);
    }
}
?>
