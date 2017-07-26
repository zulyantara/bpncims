<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function index($error = "")
    {
        if($this->session->userdata('is_logged_in') == FALSE)
        {
			$data['error'] = $error;
            $this->load->view('login/home', $data);
        }
        else
        {
            redirect('cpanels');
        }
    }
    
    function validate_credential()
    {
		if($this->input->post('btn_login') === 'btn_login')
		{
			$this->load->model('auth_model');
			
			$query = $this->auth_model->validate($this->input->post('txt_user_name'), $this->input->post('txt_user_password'));
			
			if($query)
			{
				$data = array(
					'userid' => $query->user_id,
					'username' => $query->user_name,
					'userlevel' => $query->user_level,
					'userrealname' => $query->user_real_name,
					'is_logged_in' => TRUE
				);
				
				$this->session->set_userdata($data);
				redirect("cpanels");
			}
			else
			{
				$this->index("<div class=\"alert alert-danger\">Username atau Password salah</div>");
			}
		}
		else
		{
			$this->index();
		}
    }
	
    function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */