<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanels extends CI_Controller
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function __construct()
    {
        parent::__construct();
        $this->check_loggin();
    }
    
    function index()
    {
        $this->load->model('pendaftaran_model');
        
        $data['content'] = 'cpanel/home';
        $data['panel_title'] = "<i class=\"uk-icon-home\"></i> CPanel BPNC IMS 2014";
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
        
        $this->load->view('template/template_cpanel', $data);
    }
    
    function frm_validasi_pendaftaran()
    {
		$this->load->model('pendaftaran_model');
		$this->load->model('cpanel_model');
		
        $data['content'] = 'cpanel/form_validasi_pendaftaran';
        $data['panel_title'] = "<i class=\"uk-icon-check-square-o\"></i> Validasi Pendaftaran";
		if($this->session->userdata("username") == "keu1" OR $this->session->userdata("username") == "keu2")
		{
			$data['query_sekolah'] = $this->cpanel_model->list_sekolah_keuangan();
		}
		elseif($this->session->userdata("username") == "cs1" OR $this->session->userdata("username") == "cs3" OR $this->session->userdata("username") == "cs4" OR $this->session->userdata("username") == "admin" OR $this->session->userdata("username") == "kusmayadi")
		{
			$data['query_sekolah'] = $this->cpanel_model->list_sekolah();
		}
		
		$data['query_kota'] = $this->pendaftaran_model->list_kota();
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
		$data['query_valid'] = $this->cpanel_model->get_pendaftar_active();
		
        $this->load->view('template/template_cpanel', $data);
    }
    
	function filter_sekolah()
	{
		$this->load->model('cpanel_model');
		$this->load->model('pendaftaran_model');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('opt_sekolah', 'Sekolah', 'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->frm_validasi_pendaftaran();
		}
		else
		{
			$pendaftaran_h_id =  $this->input->post('opt_sekolah');
			$pendaftaran_head = $this->cpanel_model->get_pendaftaran_h_by_id($pendaftaran_h_id);
			
			$head_id = $pendaftaran_head->pendaftaran_h_id;
			$tim_id = $pendaftaran_head->pendaftaran_tim_id;
			if($tim_id == "")
			{
				?>
				<script type="text/javascript">
					alert("Jumlah tim kosong");
					window.history.back()
				</script>
				<?php
			}
			$data['content']           = 'cpanel/form_validasi_pendaftaran';
			$data['panel_title']       = "<i class=\"uk-icon-check-square-o\"></i> Validasi Pendaftaran";
			
			if($this->session->userdata("username") == "keu1" OR $this->session->userdata("username") == "keu2")
			{
				$data['query_sekolah'] = $this->cpanel_model->list_sekolah_keuangan();
			}
			elseif($this->session->userdata("username") == "cs1" OR $this->session->userdata("username") == "cs3" OR $this->session->userdata("username") == "cs4" OR $this->session->userdata("username") == "admin" OR $this->session->userdata("username") == "kusmayadi")
			{
				$data['query_sekolah'] = $this->cpanel_model->list_sekolah();
			}
			
			$query_pendaftaran_head = $this->cpanel_model->get_pendaftaran_h_by_id($pendaftaran_h_id);
			$head_id = $query_pendaftaran_head->pendaftaran_h_id;
			$total_tim = $this->cpanel_model->count_tim_active($head_id);
			
			$data['query_kota']        = $this->pendaftaran_model->list_kota();
			$data['query_valid']       = $this->cpanel_model->get_pendaftar_active();;
			$data['query_pendaftaran'] = $this->cpanel_model->get_pendaftaran_h_by_id($pendaftaran_h_id);
			$data['total_tim']         = $total_tim;
			$data['total_siswa']       = $this->cpanel_model->count_siswa_by_head($head_id);
			$data['total_nonislam']    = $this->cpanel_model->count_nonislam_by_head($head_id);
			$data['sql_kota']          = $this->pendaftaran_model->list_kota();
			
			$this->load->view('template/template_cpanel', $data);
		}
	}
	
	function validasi_sekolah()
	{
		if($this->input->post('btn_proses') === "proses")
		{
			$this->load->model('cpanel_model');
			$this->load->model('pendaftaran_model');
			
			if(trim($this->input->post('rdo_valid')) == 1)
			{
				$data['rdo_valid']            = trim($this->input->post('rdo_valid'));
				$data['txt_jml_tim']          = trim($this->input->post('txt_jml_tim'));
				$data['txt_jml_transfer']     = trim($this->input->post('txt_jml_transfer'));
				$data['txt_kode_pendaftaran'] = trim($this->input->post('txt_kode_pendaftaran'));
				$data['txt_kota_no']          = trim($this->input->post('txt_kota_no'));
				$data['txt_nama_sekolah']     = trim($this->input->post('txt_nama_sekolah'));
				$data['txt_tgl_transfer']     = trim($this->input->post('txt_tgl_transfer'));
				
				if($this->session->userdata("username") == "keu1" OR $this->session->userdata("username") == "keu2")
				{
					$this->cpanel_model->validasi_pendaftaran_tim($data);
				}
				elseif($this->session->userdata("username") == "cs1" OR $this->session->userdata("username") == "cs3" OR $this->session->userdata("username") == "cs4" OR $this->session->userdata("username") == "admin" OR $this->session->userdata("username") == "kusmayadi")
				{
					$this->cpanel_model->validasi_pendaftaran_head($data);
				}
				
				$query_pendaftaran = $this->pendaftaran_model->get_pendaftaran_head(trim($this->input->post('txt_kode_pendaftaran')));
				$query_tim = $this->pendaftaran_model->get_tim($query_pendaftaran->pendaftaran_h_id);
				$query_lokasi_kompetisi = $this->cpanel_model->get_lokasi_kompetisi($query_pendaftaran->pendaftaran_h_kota, $query_pendaftaran->pendaftaran_h_jenjang);
				//echo "<pre>";print_r($query_pendaftaran);echo "</pre>";exit;
				
				if($this->session->userdata("username") == "cs1" OR $this->session->userdata("username") == "cs3" OR $this->session->userdata("username") == "cs4")
				{
					/*kirim email */
					$config['protocol']  = MAIL_PROTOCOL;
					$config['smtp_host'] = MAIL_HOST;
					$config['smtp_port'] = MAIL_PORT;
					$config['smtp_user'] = MAIL_USER;
					$config['smtp_pass'] = MAIL_PASSWORD;
					$config['mailtype']  = 'html';
					
					$mail_message = "<h2>";
					$mail_message .= "بســــــم الله الرحمن الرحيــم";
					$mail_message .= "</h2><br>";
					$mail_message .= "Selamat, Tim sekolah anda berhak mengikuti babak Penyisihan BPNCIMS 2014 dengan data konfirmasi sebagai berikut:<br>";
					
					foreach($query_tim as $row_tim)
					{
						$head_id = $query_pendaftaran->pendaftaran_h_id;
						$tim_id = $row_tim->pendaftaran_tim_id;
						
						$qty_siswa = $this->pendaftaran_model->qty_siswa($head_id, $tim_id);
						$no_siswa = ($qty_siswa == 0) ? "Silahkan lengkapi biodata siswa peserta kompetisi" : "";
						$mail_message .= "<hr>";
						$mail_message .= "<table><tr><td><b>Nama Tim</td><td>: ".$row_tim->pendaftaran_tim_nama."</b></td></tr>";
						$mail_message .= "<tr><td><b>No Peserta</td><td>: ".$row_tim->pendaftaran_tim_noreg."</b></td></tr>";
						$mail_message .= "<tr><td><b>Kota Kompetisi</td><td>: ".$query_lokasi_kompetisi->lm_nama_sekolah.", ".$query_lokasi_kompetisi->lm_alamat."</b></td></tr>";
						$mail_message .= "<tr><td><b>Jumlah Siswa Yang di Daftarkan</td><td>: ".$qty_siswa."</b>".$no_siswa."</td></tr></table>";
						$mail_message .= "<hr>";
					}
					
					$mail_message .= "<br>";
					$mail_message .= "Selanjutnya Anda dapat menukarkan Nomor Peserta dengan Tanda Peserta Kompetisi pada saat Technical Meeting dengan membawa undangan Technical Meeting terlampir.<br>";
					$mail_message .= "Terima Kasih<br>";
					$mail_message .= "Panitia BPNC IMS 2014";
					
					$this->load->library('email', $config);
					$this->email->set_newline("\r\n");
					$this->email->from('bpnc-ims@bintangpelajar.net', 'BPNC - IMS 2014');
					$this->email->to($query_pendaftaran->pendaftaran_h_email);
					$this->email->bcc('cs1-bpncims@bintangpelajar.com,cs2-bpncims@bintangpelajar.com,cs3-bpncims@bintangpelajar.com,cs4-bpncims@bintangpelajar.com, cs-bpncims@bintangpelajar.com, zul@bintangpelajar.com');
					$this->email->subject('Konfirmasi Validasi BPNC - IMS 2014');
					$this->email->message($mail_message);
					$this->email->send();
					/* end kirim email */
				}
				
				redirect("cpanels/frm_validasi_pendaftaran");
			}
			elseif(trim($this->input->post('rdo_valid')) == 0)
			{
				$query_pendaftaran = $this->pendaftaran_model->get_pendaftaran_head(trim($this->input->post('txt_kode_pendaftaran')));
				
				/*kirim email */
				$config['protocol']  = MAIL_PROTOCOL;
				$config['smtp_host'] = MAIL_HOST;
				$config['smtp_port'] = MAIL_PORT;
				$config['smtp_user'] = MAIL_USER;
				$config['smtp_pass'] = MAIL_PASSWORD;
				$config['mailtype']  = 'html';
				
				$mail_message = "<h2>";
				$mail_message = "بســــــم الله الرحمن الرحيــم
	</h2><br>";
				$mail_message .= "Terima kasih telah melakukan pendaftaran BPNCIMS 2014.<br>";
				$mail_message .= "Berdasarkan hasil verifikasi data-data yang Bapak/Ibu isikan, terdapat kriteria peserta yang <div style=\"color: #ff0000;\">belum terpenuhi/tidak valid</div><br>";
				$mail_message .= "Untuk informasi lebih jelas silahkan menghubungi panitia BPNCIMS 2014 dengan<br><br>";
				$mail_message .= "Alamat email: bpncims@bintangpelajar.com<br><br>";
				$mail_message .= "Atau hubungi nomor: ";
				$mail_message .= "CS BPNCIMS 2014 081297782020, 08571140777, 082307134000<br><br>";
				$mail_message .= "Terima Kasih<br><br>";
				$mail_message .= "Panitia BPNC IMS 2014";
				
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('bpnc-ims@bintangpelajar.net', 'BPNC - IMS 2014');
				$this->email->to($query_pendaftaran->pendaftaran_h_email);
				$this->email->bcc('cs1-bpncims@bintangpelajar.com,cs2-bpncims@bintangpelajar.com,cs3-bpncims@bintangpelajar.com,cs4-bpncims@bintangpelajar.com, cs-bpncims@bintangpelajar.com, zul@bintangpelajar.com');
				$this->email->subject('Konfirmasi Verifikasi Pendaftaran BPNC - IMS 2014');
				$this->email->message($mail_message);
				$this->email->send();
				/* end kirim email */
				
				redirect("cpanels/frm_validasi_pendaftaran");
			}
			else
			{
				redirect("cpanels/frm_validasi_pendaftaran");
			}
		}
		elseif($this->input->post('btn_update') === "update")
		{
			redirect("cpanels/frm_validasi_pendaftaran");
		}
		else
		{
			redirect("cpanels/frm_validasi_pendaftaran");
		}
	}
	
	function form_tren_sekolah()
	{
		$this->load->model('pendaftaran_model');
		$this->load->model('cpanel_model');
		
		$data['panel_title'] = "<i class=\"uk-icon-sort-numeric-asc\"></i> Tren Sekolah Pendaftar Berdasarkan Kota";
		$data['query_kota'] = $this->pendaftaran_model->get_kota();
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
		
		if($this->input->post('btn_cetak_excel') == "cetak_excel")
		{
			$this->load->view('cpanel/excel_tren_sekolah', $data);
		}
		else
		{
			$data['content'] = 'cpanel/form_tren_sekolah';
			$this->load->view('template/template_cpanel', $data);
		}
	}
	
	function form_lembaga_mitra()
	{
		$this->load->model('pendaftaran_model');
		$this->load->model('cpanel_model');
		$this->load->library('pagination');
		
		$config["base_url"] = base_url('cpanels/form_lembaga_mitra');
		$config["total_rows"] = $this->cpanel_model->count_lembaga_mitra();
		$config['per_page'] = 10;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = "<ul class=\"uk-pagination uk-pagination-left\">";
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li><span><i class="uk-icon-angle-double-left">';
		$config['first_tag_close'] = '</i></span>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="uk-active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page = $this->uri->segment(3);
		
		$data['panel_title'] = "<i class=\"uk-icon-list\"></i> Lembaga Mitra";
		$data['query_lm'] = $this->cpanel_model->list_lembaga_mitra($config["per_page"], $page);
		$data['query_jenjang'] = $this->pendaftaran_model->get_jenjang();
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
		$data['content'] = 'cpanel/form_lembaga_mitra';
		$data["links"] = $this->pagination->create_links();
		$this->load->view('template/template_cpanel', $data);
	}
	
	function input_lembaga_mitra()
	{
		$this->load->model('cpanel_model');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_nama_sekolah', 'Nama Sekolah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_alamat', 'Alamat', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('txt_no_telp', 'No Telp Sekolah', 'trim|required|xss_clean|integer');
		//$this->form_validation->set_rules('txt_website', 'Web Site', 'trim|required|xss_clean');
		$this->form_validation->set_rules('opt_kota', 'Kota', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_lembaga_mitra();
		}
		else
		{
			if($this->input->post('btn_save_lm') == "save_lm")
			{
			    $input['txt_nama_sekolah'] = $this->input->post("txt_nama_sekolah");
				$input['opt_jenjang']      = $this->input->post("opt_jenjang");
                $input['txt_alamat']       = $this->input->post("txt_alamat");
                $input['txt_telp']         = $this->input->post("txt_no_telp");
                $input['txt_website']      = $this->input->post("txt_website");
                $input['opt_kota']         = $this->input->post("opt_kota");
				
				$this->cpanel_model->insert_lembaga_mitra($input);
				redirect("cpanels/form_lembaga_mitra");
			}
			else
			{
				redirect("cpanels/form_lembaga_mitra");
			}
		}
	}
	
	function form_kota()
	{
		$this->load->model('pendaftaran_model');
		$this->load->model('cpanel_model');
		$this->load->library('pagination');
		
		$config["base_url"] = base_url('cpanels/form_kota');
		$config["total_rows"] = $this->cpanel_model->count_kota();
		$config['per_page'] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = "<ul class=\"uk-pagination uk-pagination-left\">";
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li><span><i class="uk-icon-angle-double-left">';
		$config['first_tag_close'] = '</i></span>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="uk-active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['panel_title'] = "<i class=\"uk-icon-list\"></i> Kota";
		$data['query_kota'] = $this->cpanel_model->list_kota($config['per_page'], $page);
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
		$data['content'] = 'cpanel/form_kota';
		$data["links"] = $this->pagination->create_links();
		$this->load->view('template/template_cpanel', $data);
	}
	
	function input_kota()
	{
		$this->load->model('cpanel_model');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_kota_ket', 'Kota', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_kota();
		}
		else
		{
			if($this->input->post("btn_save_kota") == "save_kota")
			{
				$last_no = $this->cpanel_model->get_last_no();
				$kotaNo = $last_no + 1;
				
				$kota_no = (strlen($kotaNo) == 2) ? $kotaNo : "0".$kotaNo;
				
				$input['txt_kota_no']  = $kota_no;
			    $input['txt_kota_ket'] = $this->input->post("txt_kota_ket");
				
				$this->cpanel_model->insert_kota($input);
				redirect("cpanels/form_kota");
			}
			else
			{
				redirect("cpanels/form_kota");
			}
		}
	}
	
	function form_bank()
	{
		$this->load->model('pendaftaran_model');
		$this->load->model('cpanel_model');
		$this->load->library('pagination');
		
		$config["base_url"] = base_url('cpanels/form_bank');
		$config["total_rows"] = $this->cpanel_model->count_bank();
		$config['per_page'] = 5;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = "<ul class=\"uk-pagination uk-pagination-left\">";
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li><span><i class="uk-icon-angle-double-left">';
		$config['first_tag_close'] = '</i></span>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="uk-active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['panel_title'] = "<i class=\"uk-icon-building-o\"></i> Bank";
		$data['query_bank'] = $this->cpanel_model->list_bank($config['per_page'], $page);
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
		$data['content'] = 'cpanel/form_bank';
		$data["links"] = $this->pagination->create_links();
		$this->load->view('template/template_cpanel', $data);
	}
	
	function input_bank()
	{
		$this->load->model('cpanel_model');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_bank_kode', 'Kode', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_bank_ket', 'Bank', 'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->form_kota();
		}
		else
		{
			if($this->input->post("btn_save_bank") == "save_bank")
			{
				$input['txt_bank_kode']  = $this->input->post("txt_bank_kode");
			    $input['txt_bank_ket'] = $this->input->post("txt_bank_ket");
				
				$this->cpanel_model->insert_bank($input);
				redirect("cpanels/form_bank");
			}
			else
			{
				redirect("cpanels/form_bank");
			}
		}
	}
	
	function form_sekolah_aktif()
	{
		$this->load->model('pendaftaran_model');
		$this->load->model('cpanel_model');
		$this->load->library('pagination');
		
		$txt_search = $this->input->post('txt_search');
		$kota_no = $this->uri->segment(3);
		
		$config["base_url"] = base_url('cpanels/form_sekolah_aktif/'.$kota_no);
		$config["total_rows"] = $this->cpanel_model->count_sekolah_aktif();
		$config['per_page'] = 100;
		$config["uri_segment"] = 4;
		$config['full_tag_open'] = "<ul class=\"uk-pagination uk-pagination-left\">";
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li><span><i class="uk-icon-angle-double-left">';
		$config['first_tag_close'] = '</i></span>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="uk-active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		if($kota_no === "00")
		{
			$ket_kota = "Semua Kota";
		}
		else
		{
			$qry_kota = $this->pendaftaran_model->get_kota_by_id($kota_no);
			$ket_kota = "Kota ".$qry_kota->kota_ket;
		}
		
		$data['panel_title'] = "<i class=\"uk-icon-building-o\"></i> Sekolah Aktif";
		$data['sql_sekolah_aktif'] = $this->cpanel_model->list_sekolah_aktif($config['per_page'], $page, $txt_search, $kota_no);
		$data['sql_kota'] = $this->pendaftaran_model->list_kota();
		$data["links"] = $this->pagination->create_links();
		
		if($this->input->post('btn_cetak_tim') == "cetak_tim")
		{
			$this->load->view('cpanel/excel_tren_sekolah', $data);
		}
		else
		{
			$data['content'] = 'cpanel/form_sekolah_aktif';
			$this->load->view('template/template_cpanel', $data);
		}
	}
	
	function form_detail_tim()
	{
		$this->load->model("cpanel_model");
		
		$data['panel_title'] = "<i class=\"uk-icon-users\"></i> Detail Tim";
	}
	
	private function check_loggin()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if( ! $is_logged_in OR $is_logged_in == FALSE)
		{
			redirect('auth');
		}
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */
