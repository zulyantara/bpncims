<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function validate($username, $userpassword)
    {
        $this->db->where('user_name', $username);
        $this->db->where('user_password', sha1($userpassword));
        $this->db->where('user_isactive', 1);
        $query = $this->db->get('user');
        
        if($query->num_rows() == 1)
        {
            return $query->row();
        }
        else
        {
            return array();
        }
    }
    
    function get_nama_sekolah($kpk)
    {
        
    }
}

/* End of file auth_model.php */
/* Location: ./application/controllers/auth_model.php */