<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function __construct()
    {
        parent::__construct();
        //$this->check_loggin();
		$this->load->model('pendaftaran_model');
    }
    
    function index()
    {
		$this->load->helper('captcha');
		$this->load->helper('directory');
		
        $data['content'] = 'home';
		$data['files4'] = directory_map("./downloads/semifinal", 1);
		//$data['panel_title'] = "<i class=\"uk-icon-home\"></i> Bintang Pelajar National Competition Islamic Knowledge, Mathematics and Science 2014";
		$data['sql_kota'] = $this->pendaftaran_model->get_kota();
		
        $this->load->view('template/template', $data);
    }
	
    function faq()
    {
		$this->load->helper('directory');
		
		$data['files1'] = directory_map("./downloads", 1);
		$data['files2'] = directory_map("./pedoman", 1);
		$data['files3'] = directory_map("./downloads/technical_meeting_peserta", 1);
		$data['files4'] = directory_map("./downloads/semifinal", 1);
        $data['content'] = 'faq';
		$data['panel_title'] = "<i class=\"uk-icon-question-circle\"></i> Petunjuk Teknis";
		$data['sql_kota'] = $this->pendaftaran_model->get_kota();
		
        $this->load->view('template/template', $data);
    }
	
	function download_form_pendaftaran($filename)
	{
		$this->load->helper("download");
		$data = file_get_contents(base_url()."downloads/".$filename);
		force_download($filename, $data);
	}
	
	function download_pedoman_pendaftaran($filename)
	{
		$this->load->helper("download");
		$data = file_get_contents(base_url()."pedoman/".$filename);
		force_download($filename, $data);
	}
	
	function download_technical_meeting($filename)
	{
		$this->load->helper("download");
		$data = file_get_contents(base_url()."downloads/technical_meeting_peserta/".$filename);
		force_download($filename, $data);
	}
	
	function download_semi_final($filename)
	{
		$this->load->helper("download");
		$data = file_get_contents(base_url()."downloads/semifinal/".$filename);
		force_download($filename, $data);
	}
	
	function list_lokasi_kompetisi()
	{
		$this->load->model("cpanel_model");
		
        $data['content'] = 'lokasi_kompetisi';
		$data['panel_title'] = "<i class=\"uk-icon-anchor\"></i> Lokasi Kompetisi";
		$data['sql_kota'] = $this->pendaftaran_model->get_kota();
		$data["sql_lokasi_kompetisi_sd"] = $this->cpanel_model->all_list_lembaga_mitra(1);
		$data["sql_lokasi_kompetisi_smp"] = $this->cpanel_model->all_list_lembaga_mitra(2);
		$data["sql_lokasi_kompetisi_sma"] = $this->cpanel_model->all_list_lembaga_mitra(3);
		
        $this->load->view('template/template', $data);
	}
	
	function lokasi_semi_final()
	{
		$data['content'] = "lokasi_semi_final";
		$data['panel_title'] = "<i class=\"uk-icon-square\"></i> Lokasi Semi Final";
		$this->load->view('template/template', $data);
	}
	
	private function check_loggin()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if( ! $is_logged_in || $is_logged_in != TRUE)
		{
			redirect('auth');
		}
	}
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */