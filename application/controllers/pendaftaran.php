<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran extends CI_Controller
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $this->form_pendaftaran();
    }
    
    function cari_sekolah()
    {
        if($this->uri->segment(3))
        {
            $this->load->model('pendaftaran_model');
            $this->load->library('pagination');
            
            $txt_search = $this->input->post('txt_search');
            $kota_no = $this->uri->segment(3);
            
            $config = array();
            $config["base_url"] = base_url('pendaftaran/cari_sekolah/'.$kota_no);
            $config["total_rows"] = $this->pendaftaran_model->count_pendaftaran_head($kota_no);
            $config['per_page'] = 20;
            $config["uri_segment"] = 4;
            $config['full_tag_open'] = "<ul class=\"uk-pagination uk-pagination-left\">";
            $config['full_tag_close'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
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
            
            $data['content'] = 'daftar_sekolah';
            $data['panel_title'] = "<i class=\"uk-icon-list\"></i> Daftar Peserta Sekolah BPNC IMS 2014 ".$ket_kota;
            $data['sql_pendaftaran'] = $this->pendaftaran_model->get_pendaftar($config["per_page"], $page, $txt_search, $kota_no);
            $data['sql_kota'] = $this->pendaftaran_model->get_kota();
            $data["links"] = $this->pagination->create_links();
            
            $this->load->view('template/template', $data);
        }
        else
        {
            redirect('home');
        }
    }
    
    function form_edit_pendaftaran($error = "")
    {
        $this->load->helper('captcha');
        $this->load->model('pendaftaran_model');
		
        $cek_kode = $this->pendaftaran_model->cek_pendaftaran_kode($this->input->post("txt_pendaftaran_kode"));
        
        if($cek_kode === 0)
        {
            redirect("pendaftaran/form_pendaftaran");
        }
        else
        {
            $data['content'] = 'form_pendaftaran';
            $data['panel_title'] = "<i class=\"uk-icon-file-text\"></i> Formulir Edit Pendaftaran BPNC IMS 2014";
            $data['sql_kota'] = $this->pendaftaran_model->get_kota();
            $data['sql_jenjang'] = $this->pendaftaran_model->get_jenjang();
            $data['query_edit'] = $this->pendaftaran_model->cek_kode_pendaftaran($this->input->post('txt_pendaftaran_kode'));
            $data['error'] = $error;
            $data['sql_kota'] = $this->pendaftaran_model->get_kota();
            $data['kode_pendaftaran'] = $this->input->post('txt_pendaftaran_kode');
            
            $captchaVals = array(
                'word' => random_string('numeric', 3),
                'img_path' => './assets/captcha/',
                'img_url' => base_url().'assets/captcha/',
                'img_width' => 150,
                'img_height' => 30,
                'expiration' => 7200
            );
            
            $myCap = create_captcha($captchaVals);
            
            $this->session->set_userdata('mycaptcha', $myCap['word']);
            
            $data['cap'] = $myCap;
            
            $this->load->view('template/template', $data);
        }
    }
    
    function form_pendaftaran($error = "")
    {
        $this->load->helper('captcha');
        $this->load->model('pendaftaran_model');
		
        $data['content'] = 'form_pendaftaran';
        $data['panel_title'] = "<i class=\"uk-icon-file-text\"></i> Formulir Pendaftaran BPNC IMS 2014";
        $data['sql_kota_aktif'] = $this->pendaftaran_model->get_kota();
		$data['sql_kota'] = $this->pendaftaran_model->get_kota();
        $data['sql_jenjang'] = $this->pendaftaran_model->get_jenjang();
        $data['error'] = $error;
        
        $captchaVals = array(
            'word' => random_string('numeric', 3),
            'img_path' => './assets/captcha/',
            'img_url' => base_url().'assets/captcha/',
            'img_width' => 150,
            'img_height' => 30,
            'expiration' => 7200
        );
        
        $myCap = create_captcha($captchaVals);
        
        $this->session->set_userdata('mycaptcha', $myCap['word']);
        
        $data['cap'] = $myCap;
        
        $this->load->view('template/template', $data);
    }
    
    function input_pendaftaran()
    {
        $this->load->model('pendaftaran_model');
        $this->load->library('form_validation');
        
        if($this->input->post('btn_simpan') == "simpan")
        {
            $this->form_validation->set_rules('txt_pendaftaran_kode', 'Kode Pendaftaran', 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('txt_nama_sekolah', 'Nama Sekolah', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_kota_sekolah', 'Kota Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_kota', 'Kota', 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_jenjang', 'Jenjang Pendidikan', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txt_alamat', 'Alamat Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txt_no_telp', 'No Telp Sekolah', 'trim|required|xss_clean|integer');
        $this->form_validation->set_rules('txt_nama_kepsek', 'Nama Kepala Sekolah', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txt_no_hp_kepsek', 'No HP Kepala Sekolah', 'trim|required|xss_clean|integer');
        $this->form_validation->set_rules('txt_nama_pendamping', 'Nama Pendamping', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txt_no_hp_pendamping', 'No HP Pendamping', 'trim|required|xss_clean|integer');
        $this->form_validation->set_rules('txt_email_sekolah', 'Email Sekolah', 'trim|required|valid_email');
        $this->form_validation->set_rules('opt_jml_tim', 'Rencana Pembayaran', 'trim|required|xss_clean');
        
        /*
		if($this->input->post('btn_input_tim') == "input_tim")
		{
			$this->form_validation->set_rules('opt_jml_tim', 'Jumlah Tim', 'trim|required|xss_clean');
		}
		*/
        $this->form_validation->set_rules('txt_captcha', 'Captcha', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
        
        if ($this->form_validation->run() == FALSE)
        {
            if($this->input->post('btn_simpan') == "simpan")
            {
                $this->form_edit_pendaftaran();
            }
            else
            {
                $this->form_pendaftaran();
            }
        }
        else
        {
            if ($this->input->post() && ($this->input->post('txt_captcha') == $this->session->userdata('mycaptcha')))
            {
                if($this->input->post('btn_input_tim') == "input_tim")
                {
                    $nama_sekolah = trim($this->input->post('txt_nama_sekolah'));
                    $kota_sekolah = trim(ucwords(strtolower($this->input->post('txt_kota_sekolah'))));
                    $kota_kompetisi = trim($this->input->post('opt_kota'));
                    $jenjang_sekolah = trim($this->input->post('opt_jenjang'));
                    $nama_kepsek = $this->input->post('txt_nama_kepsek');
                    
                    $kode_pendaftaran = random_string('alnum', 5);
                    
                    $input['txt_kode']             = $kode_pendaftaran;
                    $input['txt_nama_sekolah']     = $nama_sekolah;
					$input['txt_kota_sekolah']     = $kota_sekolah;
                    $input['opt_kota']             = $kota_kompetisi;
                    $input['opt_jenjang']          = $jenjang_sekolah;
                    $input['txt_alamat']           = trim($this->input->post('txt_alamat'));
                    $input['txt_no_telp']          = trim($this->input->post('txt_no_telp'));
                    $input['txt_nama_kepsek']      = trim(ucwords($nama_kepsek));
                    $input['txt_no_hp_kepsek']     = trim($this->input->post('txt_no_hp_kepsek'));
                    $input['txt_nama_pendamping']  = trim(ucwords($this->input->post('txt_nama_pendamping')));
                    $input['txt_no_hp_pendamping'] = trim($this->input->post('txt_no_hp_pendamping'));
                    $input['txt_email_sekolah']    = trim(strtolower($this->input->post('txt_email_sekolah')));
                    $input['opt_jml_tim']          = trim($this->input->post('opt_jml_tim')); /* pindah ke pendaftaran_tim */
                    //echo "<pre>";print_r($input);echo "</pre>";exit;
                    
                    $cek_pendaftaran = $this->pendaftaran_model->cek_pendaftaran($nama_sekolah, $kota_sekolah, $kota_kompetisi, $jenjang_sekolah);
                    //$cek_pendaftaran = $this->pendaftaran_model->cek_pendaftaran($nama_sekolah, $kota_kompetisi, $jenjang_sekolah);
                    //echo $this->db->last_query();exit;
                    
                    /*
                     * cek pendaftaran
                     * jika nama sekolah, kota, jenjang dan nama_kepsek tidak sama maka insert jika go to next page
                     */
                    if($cek_pendaftaran == 0)
                    {
                        $this->pendaftaran_model->insert_pendaftaran_header($input);
                        
                        /*send kode_pendaftaran to email*/
                        $config['protocol']  = MAIL_PROTOCOL;
                        $config['smtp_host'] = MAIL_HOST;
                        $config['smtp_port'] = MAIL_PORT;
                        $config['smtp_user'] = MAIL_USER;
                        $config['smtp_pass'] = MAIL_PASSWORD;
                        $config['mailtype']  = 'html';
                        
                        $qry_kota = $this->pendaftaran_model->get_kota_by_id($kota_kompetisi);
                        $kota_ket = $qry_kota->kota_ket;
                        
                        /*kirim email */
                        $mail_message = "<h2>";
                        $mail_message .= "بســــــم الله الرحمن الرحيــم
</h2><br>";
                        $mail_message .= "Terima Kasih telah melakukan pendaftaran BPNCIMS 2014. Berikut adalah data konfirmasi Anda :<br><hr>";
                        $mail_message .= "<table><tr><td><b>Nama Sekolah</td><td>: ".$nama_sekolah."</b></td></tr>";
                        $mail_message .= "<tr><td><b>Kode Pendaftaran Sekolah</td><td>: ".$input['txt_kode']."</b></td></tr>";
                        $mail_message .= "<tr><td><b>Kota Kompetisi</td><td>: ".$kota_ket."</b></td></tr>";
                        $mail_message .= "<tr><td><b>Jumlah TIM yang di daftarkan</td><td>: ".trim($this->input->post('opt_jml_tim'))." (Pastikan anda telah menginput data tim dengan lengkap sesuai dengan jumlah tim yang didaftarkan)</b></td></tr>";
                        $mail_message .= "<tr><td><b>Status</td><td>: Sedang diverifikasi</b></td></tr></table><hr><br>";
                        $mail_message .= "<p>Selanjutnya Anda dapat menggunakan Kode Pendaftaran Sekolah sebagai password untuk melakukan penambahan jumlah tim atau memperbaharui (edit) data anggota tim melalui (".base_url("pendaftaran/form_pendaftaran#edit-pendaftaran").")</p>";
                        $mail_message .= "<p>Kami akan mengirimkan Nomor Peserta Kompetisi setelah melalui verifikasi, paling lambat tiga hari setelah melakukan pendaftaran.Demikian informasi dari kami. Untuk informasi lebih lanjut silahkan hubungi kami melalui email (bpncims@bintangpelajar.com) pada jam kerja (08.00 - 18.00 WIB).</p>";
                        
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('bpnc-ims@bintangpelajar.net', 'BPNC - IMS 2014');
                        $this->email->to(strtolower($this->input->post('txt_email_sekolah')));
                        $this->email->bcc('cs1-bpncims@bintangpelajar.com,cs2-bpncims@bintangpelajar.com,cs3-bpncims@bintangpelajar.com,cs4-bpncims@bintangpelajar.com, cs-bpncims@bintangpelajar.com, zul@bintangpelajar.com');
                        $this->email->subject('Konfirmasi Kode Pendaftaran BPNC - IMS 2014');
                        $this->email->message($mail_message);
                        $this->email->send();
                        /* end kirim email */
                        
                        // go to next page
                        $this->form_input_tim($kode_pendaftaran);
                    }
                    else
                    {
                        $this->form_pendaftaran("<div class=\"uk-alert uk-alert-warning\">Sekolah sudah terdaftar</div>");
                    }
                }
                elseif($this->input->post('btn_simpan') == "simpan" OR $this->input->post('btn_update_tim') == "update_tim")
                {
                    $nama_sekolah = trim($this->input->post('txt_nama_sekolah'));
                    $kota_sekolah = trim(ucwords($this->input->post('txt_kota_sekolah')));
                    $kota_kompetisi = trim($this->input->post('opt_kota'));
                    $jenjang_sekolah = trim($this->input->post('opt_jenjang'));
                    
                    //$qry_head = $this->pendaftaran_model->get_pendaftaran_head($this->input->post('txt_kode_pendaftaran'));
                    //$update_jml_tim = trim($this->input->post('opt_jml_tim')) + $qry_head->pendaftaran_h_jml_tim;
                    
                    $input['txt_kode_pendaftaran'] = $this->input->post('txt_pendaftaran_kode');
                    $input['txt_nama_sekolah']     = $nama_sekolah;
                    $input['txt_kota_sekolah']     = $kota_sekolah;
                    $input['opt_kota']             = $kota_kompetisi;
                    $input['opt_jenjang']          = $jenjang_sekolah;
                    $input['txt_alamat']           = trim($this->input->post('txt_alamat'));
                    $input['txt_no_telp']          = trim($this->input->post('txt_no_telp'));
                    $input['txt_nama_kepsek']      = trim(ucwords($this->input->post('txt_nama_kepsek')));
                    $input['txt_no_hp_kepsek']     = trim($this->input->post('txt_no_hp_kepsek'));
                    $input['txt_nama_pendamping']  = trim(ucwords($this->input->post('txt_nama_pendamping')));
                    $input['txt_no_hp_pendamping'] = trim($this->input->post('txt_no_hp_pendamping'));
                    $input['txt_email_sekolah']    = trim(strtolower($this->input->post('txt_email_sekolah')));
                    $input['opt_jml_tim']          = $update_jml_tim;
                    
                    /*send kode_pendaftaran to email*/
                    $config['protocol']  = MAIL_PROTOCOL;
                    $config['smtp_host'] = MAIL_HOST;
                    $config['smtp_port'] = MAIL_PORT;
                    $config['smtp_user'] = MAIL_USER;
                    $config['smtp_pass'] = MAIL_PASSWORD;
                    $config['mailtype']  = 'html';
                    
                    $qry_kota = $this->pendaftaran_model->get_kota_by_id($kota_kompetisi);
                    $kota_ket = $qry_kota->kota_ket;
                    
                    /* kirim email */
                    $mail_message = "<h2>بســــــم الله الرحمن الرحيــم
</h2><br>";
                    $mail_message .= "Terima Kasih telah melakukan pendaftaran BPNCIMS 2014. Berikut adalah data konfirmasi Anda :<br><hr>";
                    $mail_message .= "<table><tr><td><b>Nama Sekolah</td><td>: ".$nama_sekolah."</b></td></tr>";
                    $mail_message .= "<tr><td><b>Kode Pendaftaran Sekolah</td><td>: ".$this->input->post('txt_pendaftaran_kode')."</b></td></tr>";
                    $mail_message .= "<tr><td><b>Kota Kompetisi</td><td>: ".$kota_ket."</b></td></tr>";
                    $mail_message .= "<tr><td><b>Jumlah TIM yang di daftarkan</td><td>: ".trim($this->input->post('opt_jml_tim'))." (Pastikan anda telah menginput jumlah tim sesuai dengan jumlah tim yang didaftarkan dan biodata siswa)</b></td></tr></table><hr><br>";
                    $mail_message .= "<p>Selanjutnya Anda dapat menggunakan Kode Pendaftaran Sekolah sebagai password untuk melakukan penambahan jumlah tim atau memperbaharui (edit) data anggota tim melalui (".base_url("pendaftaran/form_pendaftaran#edit-pendaftaran").")</p>";
                    $mail_message .= "<p>Kami akan mengirimkan Nomor Peserta Kompetisi setelah melalui verifikasi, paling lambat tiga hari setelah melakukan pendaftaran.Demikian informasi dari kami. Untuk informasi lebih lanjut silahkan hubungi kami melalui email (bpncims@bintangpelajar.com) pada jam kerja (08.00 - 18.00 WIB).</p>";
                    
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from('bpnc-ims@bintangpelajar.net', 'BPNC - IMS 2014');
                    $this->email->to(strtolower($this->input->post('txt_email_sekolah')));
                    $this->email->bcc('cs1-bpncims@bintangpelajar.com,cs2-bpncims@bintangpelajar.com,cs3-bpncims@bintangpelajar.com,cs4-bpncims@bintangpelajar.com, cs-bpncims@bintangpelajar.com, zul@bintangpelajar.com');
                    $this->email->subject('Edit Pendaftaran BPNC - IMS 2014');
                    $this->email->message($mail_message);
                    $this->email->send();
                    /* end kirim email */
                    
                    $this->pendaftaran_model->update_pendaftaran_header($input);
					if($this->input->post('btn_update_tim') == "update_tim")
					{
						$this->form_input_tim($this->input->post('txt_kode_pendaftaran'));
					}
					else
					{
						redirect("pendaftaran/form_pendaftaran");
					}
                }
            }
            else
            {
                $this->form_pendaftaran("<div class=\"uk-alert uk-alert-warning\">Captcha tidak sama</div>");
            }
        }
    }
    
    function form_edit_tim()
    {
        $this->load->model("pendaftaran_model");
        
        $cek_kode = $this->pendaftaran_model->cek_pendaftaran_kode($this->input->post("txt_pendaftaran_kode"));
        
        if($cek_kode === 0)
        {
            redirect("pendaftaran/form_pendaftaran");
        }
        else
        {
            $this->form_input_tim($this->input->post("txt_pendaftaran_kode"));
        }
    }
    
    function form_tambah_tim()
    {
        $this->load->model("pendaftaran_model");
        
        $cek_kode = $this->pendaftaran_model->cek_pendaftaran_kode($this->input->post("txt_pendaftaran_kode"));
        
        if($cek_kode === 0)
        {
            redirect("pendaftaran/form_pendaftaran");
        }
        else
        {
            $qry_head = $this->pendaftaran_model->get_pendaftaran_head($this->input->post('txt_kode_pendaftaran'));
            $update_jml_tim = $this->input->post("opt_jml_tim") + $qry_head->pendaftaran_h_jml_tim;
			
            $this->pendaftaran_model->update_pendaftaran_jml_tim($this->input->post("txt_pendaftaran_kode"), $update_jml_tim);
            $this->form_input_tim($this->input->post("txt_kode_pendaftaran"));
        }
    }
    
    function form_input_tim($kode_pendaftaran = "", $error = "")
    {
        $this->load->model('pendaftaran_model');
        $this->load->model('cpanel_model');
        
        $id_head = $this->pendaftaran_model->get_pendaftaran_head($kode_pendaftaran);
        
        if($this->input->post('btn_selesai') == "btn_selesai")
        {
            $this->form_pendaftaran();
        }
        
        $data['content']     = 'form_input_tim';
        $data['panel_title'] = "<i class=\"uk-icon-file-text\"></i> Formulir Informasi Tim";
        $data['query_head']  = $this->pendaftaran_model->get_pendaftaran_head($kode_pendaftaran);
        $data['query_bank']  = $this->cpanel_model->all_list_bank();
        $data['sql_tim']     = $this->pendaftaran_model->get_tim($id_head->pendaftaran_h_id);
        $data['no_tim']      = $this->pendaftaran_model->get_qty_tim($id_head->pendaftaran_h_id);
        $data['jumlah_tim1']  = $this->pendaftaran_model->count_tim($id_head->pendaftaran_h_id);
        $data['jumlah_tim2']  = $this->input->post("opt_jml_tim");
        $data['sql_kota'] = $this->pendaftaran_model->get_kota();
        $data['error'] = $error;
        
        //echo "<pre>";print_r($data);echo "</pre>";
        
        $this->load->view('template/template', $data);
    }
    
    function input_tim()
    {
        if($this->input->post('btn_selesai'))
        {
            redirect('pendaftaran');
        }
		
        $this->load->model('pendaftaran_model');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('txt_no_rek', 'No Rekening', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txt_an_rek', 'Rekening Atas Nama', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('txt_jml_transfer', 'Jumlah Transfer', 'trim|required|xss_clean');
        $this->form_validation->set_rules('txt_tgl_transfer', 'Tanggal Transfer', 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_bank_pengirim', 'Bank Pengirim', 'trim|required|xss_clean');
        $this->form_validation->set_rules('opt_gender', 'Gender', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
        
        if ($this->form_validation->run() == FALSE)
        {
            $head_kode = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($this->input->post('txt_pendaftaran_h_id'));
            $this->form_input_tim($head_kode->pendaftaran_h_kode);
        }
        else
        {
            //generate nama tim
            $no_tim = $this->pendaftaran_model->get_qty_tim($this->input->post('txt_pendaftaran_h_id'))+1;
            $nama_tim = trim($this->input->post('txt_nama_tim')). " T".($this->input->post('opt_gender')==1?"I":"A")."-".(strlen($no_tim)==2?$no_tim:"0".$no_tim);
            //echo $nama_tim;exit;
            
            $input['txt_head_id']         = $this->input->post('txt_pendaftaran_h_id');
            $input['txt_nama']            = $nama_tim;
            $input['opt_gender']          = $this->input->post('opt_gender');
            $input['txt_no_rek']          = $this->input->post('txt_no_rek');
            $input['txt_an_rek']          = $this->input->post('txt_an_rek');
            $input['txt_jml_transfer']    = $this->input->post('txt_jml_transfer');
            $input['opt_bank_pengirim']   = $this->input->post('opt_bank_pengirim');
            $input['txt_tgl_transfer']    = $this->input->post('txt_tgl_transfer');
            
            if($this->input->post('btn_simpan') == 'btn_simpan')
            {
                $this->pendaftaran_model->insert_pendaftaran_tim($input);
                $head_kode = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($this->input->post('txt_pendaftaran_h_id'));
                $this->form_input_tim($head_kode->pendaftaran_h_kode);
            }
        }
    }
    
    function delete_tim()
    {
        $this->load->model('pendaftaran_model');
        
        $id = $this->uri->segment(3);
        $head_id = $this->uri->segment(4);
        
        $query_pendaftaran_head = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($head_id);
        
        $hapus = $this->pendaftaran_model->delete_pendaftaran_tim($id);
        
        $this->form_input_tim($query_pendaftaran_head->pendaftaran_h_kode);
    }
    
    function form_edit_siswa()
    {
        $this->load->model('pendaftaran_model');
        
        $tim_id = ($this->uri->segment(3) != "") ? $this->uri->segment(3) : $this->input->post('txt_pendaftaran_tim_id');
        $head_id = ($this->uri->segment(4) != "") ? $this->uri->segment(4) : $this->input->post('txt_pendaftaran_h_id');
        
        $data['content'] = 'form_input_siswa';
        $data['panel_title'] = "<i class=\"uk-icon-file-text\"></i> Formulir Informasi Siswa";
        $data['pendaftaran_head_id'] = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($head_id);
        $data['sql_edit_siswa'] = $this->pendaftaran_model->get_siswa($head_id, $tim_id);
        $data['sql_siswa'] = $this->pendaftaran_model->list_siswa($head_id, $tim_id);
        $data['sql_tim'] = $this->pendaftaran_model->get_selected_tim($tim_id);
        $data['sql_kota'] = $this->pendaftaran_model->get_kota();
        $data['count_siswa'] = $this->pendaftaran_model->qty_siswa($head_id, $tim_id);
        $data['tim_id'] = $tim_id;
        
        $this->load->view('template/template', $data);
    }
    
    function form_input_siswa()
    {
        $this->load->model('pendaftaran_model');
        
        $tim_id = ($this->uri->segment(3) != "") ? $this->uri->segment(3) : $this->input->post('txt_pendaftaran_tim_id');
        $head_id = ($this->uri->segment(4) != "") ? $this->uri->segment(4) : $this->input->post('txt_pendaftaran_h_id');
        
        $data['content'] = 'form_input_siswa';
        $data['panel_title'] = "<i class=\"uk-icon-file-text\"></i> Formulir Informasi Siswa";
        $data['pendaftaran_head_id'] = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($head_id);
        $data['sql_siswa'] = $this->pendaftaran_model->list_siswa($head_id, $tim_id);
        $data['sql_tim'] = $this->pendaftaran_model->get_selected_tim($tim_id);
        $data['sql_kota'] = $this->pendaftaran_model->get_kota();
        $data['count_siswa'] = $this->pendaftaran_model->qty_siswa($head_id, $tim_id);
        $data['tim_id'] = $tim_id;
        
        $this->load->view('template/template', $data);
    }
    
    function input_siswa()
    {
        $this->load->model('pendaftaran_model');
        
        if($this->input->post('btn_kembali')=='Kembali')
        {
            $id_head = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($this->input->post('txt_pendaftaran_h_id'));
            $this->form_input_tim($id_head->pendaftaran_h_kode);
        }
        elseif($this->input->post('btn_selesai')=='Selesai')
        {
            redirect('pendaftaran');
        }
        elseif($this->input->post('btn_simpan')=='Simpan')
        {
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('txt_nama', 'Nama Lengkap Siswa', 'trim|required|xss_clean');
			$this->form_validation->set_rules('opt_kelas', 'Kelas', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_tmp_lahir', 'Tempat Lahir', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_tgl_lahir', 'Tanggal', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('opt_bulan_lahir', 'Bulan', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_thn_lahir', 'Tahun', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_alamat', 'Alamat', 'trim|required|xss_clean');
            $this->form_validation->set_rules('opt_agama', 'Agama', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_nama_ayah', 'Nama Ayah', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_nama_ibu', 'Nama Ibu', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_telp_ortu', 'No Telp Ayah/Ibu', 'trim|required|xss_clean|integer');
			
			$this->form_validation->set_error_delimiters('<div class="uk-alert uk-alert-warning">', '</div>');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->form_input_siswa();
			}
			else
			{
				$tgl = (trim($this->input->post('txt_thn_lahir'))=="") ? "00" : trim($this->input->post('txt_thn_lahir'));
				$bulan = (trim($this->input->post('opt_bulan_lahir'))=="Bulan") ? "00" : trim($this->input->post('opt_bulan_lahir'));
				$thn = (trim($this->input->post('txt_tgl_lahir'))=="") ? "0000" : trim($this->input->post('txt_tgl_lahir'));
				
				$input['txt_head_id']        = trim($this->input->post('txt_pendaftaran_h_id'));
				$input['txt_tim_id']         = trim($this->input->post('txt_pendaftaran_tim_id'));
				$input['txt_nama']           = trim(ucwords($this->input->post('txt_nama')));
				$input['txt_kelas']          = trim($this->input->post('opt_kelas'));
				$input['txt_tmp_lahir']      = trim(ucwords($this->input->post('txt_tmp_lahir')));
				$input['txt_tgl_lahir']      = $tgl."-".$bulan."-".$thn;
				$input['txt_jns_kelamin']    = trim($this->input->post('txt_jns_kelamin'));
				$input['txt_alamat']         = trim($this->input->post('txt_alamat'));
                $input['txt_agama']          = trim($this->input->post('opt_agama'));
				$input['txt_nama_ayah']      = trim(ucwords($this->input->post('txt_nama_ayah')));
				$input['txt_pekerjaan_ayah'] = trim($this->input->post('txt_pekerjaan_ayah'));
				$input['txt_nama_ibu']       = trim(ucwords($this->input->post('txt_nama_ibu')));
				$input['txt_pekerjaan_ibu']  = trim($this->input->post('txt_pekerjaan_ibu'));
				$input['txt_telp_ortu']      = trim($this->input->post('txt_telp_ortu'));
				$input['txt_email_ortu']     = trim($this->input->post('txt_email_ortu'));
				
				$this->pendaftaran_model->insert_siswa($input);
				
				$this->form_input_siswa();
			}
        }
    }
    
    function delete_siswa()
    {
        $this->load->model('pendaftaran_model');
        if($this->uri->segment(3))
        {
            $hapus = $this->pendaftaran_model->delete_siswa($this->uri->segment(5));
            redirect("pendaftaran/form_input_siswa/".$this->uri->segment(3)."/".$this->uri->segment(4));
        }
        else
        {
            redirect("pendaftaran/form_pendaftaran");
        }
    }
    
    function detail_sekolah()
    {
        $this->load->model("pendaftaran_model");
        
        $data['query_detail'] = $this->pendaftaran_model->get_pendaftaran_head_id_by_id($this->input->post("id_pendaftaran"));
        $this->load->view("detail_sekolah", $data);
    }
}
/* End of file pendaftaran.php */
/* Location: ./application/controllers/pendaftaran.php */
