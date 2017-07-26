<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpanel_model extends CI_Model
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function get_pendaftaran_h_by_id($head_id)
    {
        $this->db->select('pendaftaran_h_kode, pendaftaran_h_id, pendaftaran_tim_id, pendaftaran_h_nama_sekolah, pendaftaran_h_kota_sekolah, pendaftaran_h_jml_tim, pendaftaran_tim_tgl_transfer, pendaftaran_tim_no_rek, pendaftaran_tim_an_rek, kota_ket, bank_ket');
        $this->db->join('pendaftaran_tim', 'pendaftaran_h_id=pendaftaran_tim_head', 'left');
        $this->db->join("m_kota", "pendaftaran_h_kota=kota_no", 'left');
        $this->db->join("m_bank", "pendaftaran_tim_bank_transfer=bank_kode");
        $this->db->where('pendaftaran_h_id', $head_id);
        $query = $this->db->get('pendaftaran_head');
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function count_siswa($head_id, $tim_id)
    {
        $this->db->where("pendaftaran_d_head", $head_id);
        $this->db->where("pendaftaran_d_tim", $tim_id);
        $query = $this->db->get("pendaftaran_detail");
        return $query->num_rows();
    }
    
    function count_siswa_by_head($head_id)
    {
        $this->db->join("pendaftaran_tim", "pendaftaran_d_tim=pendaftaran_tim_id");
        $this->db->where("pendaftaran_d_head", $head_id);
        $this->db->where("pendaftaran_tim_isdeleted", 1);
        $query = $this->db->get("pendaftaran_detail");
        return $query->num_rows();
    }
    
    function count_nonislam($head_id, $tim_id)
    {
        $this->db->join("pendaftaran_detail", "siswa_id=pendaftaran_d_siswa", "left");
        $this->db->where("pendaftaran_d_head", $head_id);
        $this->db->where("pendaftaran_d_tim", $tim_id);
        $this->db->where("siswa_agama", 0);
        $this->db->where("siswa_isactive", 1);
        $query = $this->db->get("siswa");
        return $query->num_rows();
    }
    
    function count_nonislam_by_head($head_id)
    {
        $this->db->join("pendaftaran_detail", "siswa_id=pendaftaran_d_siswa", "left");
        $this->db->where("pendaftaran_d_head", $head_id);
        $this->db->where("siswa_agama", 0);
        $this->db->where("siswa_isactive", 1);
        $query = $this->db->get("siswa");
        return $query->num_rows();
    }
    
    function count_agama_siswa($head_id, $tim_id, $agama)
    {
        $this->db->where("pendaftaran_d_head", $head_id);
        $this->db->where("pendaftaran_d_tim", $tim_id);
        $this->db->where("pendaftaran_d_tim", $tim_id);
        $query = $this->db->get("pendaftaran_detail");
        return $query->num_rows();
    }
    
    function count_sekolah_aktif()
    {
        $this->db->where("pendaftaran_tim_isactive", 1);
        $this->db->where("pendaftaran_tim_isdeleted", 1);
        $query = $this->db->get("pendaftaran_tim");
        return $query->num_rows();
    }
    
    function validasi_pendaftaran_head($data = array())
    {
        $values['pendaftaran_h_isactive'] = $data['rdo_valid'];
        $values['pendaftaran_h_update_date'] = date('Y-m-d H:i:s');
        $values['pendaftaran_h_update_by'] = $this->session->userdata("userid");
        
        $this->db->where('pendaftaran_h_kode', $data['txt_kode_pendaftaran']);
        $this->db->update('pendaftaran_head', $values);
    }
    
    function validasi_pendaftaran_tim($data = array())
    {
        $values['pendaftaran_tim_isactive']    = $data['rdo_valid'];
        $values['pendaftaran_tim_update_date'] = date('Y-m-d H:i:s');
        $values['pendaftaran_tim_update_by']   = $this->session->userdata("userid");
        
        $query_head = $this->get_id_pendaftaran_head($data['txt_kode_pendaftaran']);
        
        $this->db->where('pendaftaran_tim_head', $query_head->pendaftaran_h_id);
        $this->db->update('pendaftaran_tim', $values);
        //echo $this->db->last_query();
    }
    
    function get_id_pendaftaran_head($kode)
    {
        $this->db->select("pendaftaran_h_id");
        $this->db->where("pendaftaran_h_kode", $kode);
        $query = $this->db->get("pendaftaran_head");
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function get_pendaftar_active()
    {
        $this->db->select('pendaftaran_h_id, pendaftaran_h_kode, pendaftaran_h_nama_sekolah, kota_ket');
        $this->db->join('m_kota', 'pendaftaran_h_kota=kota_no', 'left');
        $this->db->where('pendaftaran_h_isactive', 1);
        $query = $this->db->get('pendaftaran_head');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function get_tim_by_head_id($id)
    {
        $this->db->where('pendaftaran_tim_head', $id);
        //$this->db->where("pendaftaran_tim_isactive", 1);
        $this->db->where("pendaftaran_tim_isdeleted", 1);
        $this->db->order_by("pendaftaran_tim_insert_date", "desc");
        $query = $this->db->get('pendaftaran_tim');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function jml_tim_i_by_head_id($id)
    {
        $this->db->where('pendaftaran_tim_head', $id);
        $this->db->where('pendaftaran_tim_gender', 1);
        $query = $this->db->get('pendaftaran_tim');
        
        return $query->num_rows();
    }
    
    function jml_tim_a_by_head_id($id)
    {
        $this->db->where('pendaftaran_tim_head', $id);
        $this->db->where('pendaftaran_tim_gender', 2);
        $query = $this->db->get('pendaftaran_tim');
        
        return $query->num_rows();
    }
    
    function jml_sd_by_kota($kota_no)
    {
        $this->db->where('pendaftaran_h_kota', $kota_no);
        $this->db->where('pendaftaran_h_jenjang', 1);
        $this->db->where('pendaftaran_h_isactive', 1);
        $query = $this->db->get('pendaftaran_head');
        return $query->num_rows();
    }

    function jml_smp_by_kota($kota_no)
    {
        $this->db->where('pendaftaran_h_kota', $kota_no);
        $this->db->where('pendaftaran_h_jenjang', 2);
        $this->db->where('pendaftaran_h_isactive', 1);
        $query = $this->db->get('pendaftaran_head');
        return $query->num_rows();
    }

    function jml_sma_by_kota($kota_no)
    {
        $this->db->where('pendaftaran_h_kota', $kota_no);
        $this->db->where('pendaftaran_h_jenjang', 3);
        $this->db->where('pendaftaran_h_isactive', 1);
        $query = $this->db->get('pendaftaran_head');
        return $query->num_rows();
    }
    
    function jml_tim_by_kota($kota_no, $jenjang)
    {
        $query = $this->db->query("SELECT * FROM pendaftaran_tim WHERE MID(pendaftaran_tim_noreg,1,2)='".$kota_no."' AND MID(pendaftaran_tim_noreg,3,1)='".$jenjang."' and pendaftaran_tim_isdeleted=1 and pendaftaran_tim_isactive=1");
        /*
        $this->db->select_sum('pendaftaran_h_jml_tim');
        $this->db->where('pendaftaran_h_kota', $kota_no);
        $this->db->where('pendaftaran_h_jenjang', $jenjang);
        $this->db->where('pendaftaran_h_isactive', 1);
        $query = $this->db->get('pendaftaran_head');
        */
        return $query->num_rows();
    }
    
    function list_sekolah()
    {
        $this->db->distinct();
        $this->db->select('pendaftaran_h_id, pendaftaran_h_kode, pendaftaran_h_nama_sekolah, pendaftaran_h_kota_sekolah, jenjang_ket');
        $this->db->join('m_jenjang', 'pendaftaran_h_jenjang=jenjang_id');
        $this->db->join('pendaftaran_tim', 'pendaftaran_h_id=pendaftaran_tim_head');
        $this->db->where('pendaftaran_h_isactive', 0);
        $this->db->where('pendaftaran_tim_isactive', 1);
        $this->db->order_by("jenjang_ket", "asc");
        $query = $this->db->get('pendaftaran_head');
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function list_sekolah_keuangan()
    {
        $this->db->distinct();
        $this->db->select('pendaftaran_h_id, pendaftaran_h_kode, pendaftaran_h_nama_sekolah, pendaftaran_h_kota_sekolah, jenjang_ket');
        $this->db->join('m_jenjang', 'pendaftaran_h_jenjang=jenjang_id');
        $this->db->join('pendaftaran_tim', 'pendaftaran_h_id=pendaftaran_tim_head');
        $this->db->where('pendaftaran_h_isactive', 0);
        $this->db->where('pendaftaran_tim_isactive', 0);
        $this->db->order_by("jenjang_ket", "asc");
        $query = $this->db->get('pendaftaran_head');
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function count_lembaga_mitra()
    {
        $this->db->where("lm_isactive", 1);
        $query = $this->db->get("m_lembaga_mitra");
        return $query->num_rows();
    }
    
    function all_list_lembaga_mitra($jenjang = "")
    {
        $this->db->select("lm_nama_sekolah, lm_alamat, lm_telp, lm_website, kota_ket");
        $this->db->order_by("lm_kota", "asc");
        $this->db->join("m_kota", "lm_kota=kota_no");
        if($jenjang != "")
        {
            $this->db->where("lm_jenjang", $jenjang);
        }
        $query = $this->db->get("m_lembaga_mitra");
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function list_lembaga_mitra($limit, $start)
    {
        $this->db->select("lm_id, lm_nama_sekolah, lm_alamat, lm_telp, lm_website, jenjang_ket, kota_ket");
        $this->db->join("m_kota", "lm_kota=kota_no");
        $this->db->join("m_jenjang", "lm_jenjang=jenjang_id");
        $this->db->limit($limit, $start);
        $query = $this->db->get("m_lembaga_mitra");
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function insert_lembaga_mitra($data = array())
    {
        $values['lm_nama_sekolah'] = ucwords(trim($data['txt_nama_sekolah']));
        $values['lm_jenjang']      = trim($data['opt_jenjang']);
        $values['lm_alamat']       = trim($data['txt_alamat']);
        $values['lm_telp']         = trim($data['txt_telp']);
        $values['lm_website']      = trim($data['txt_website']);
        $values['lm_kota']         = trim($data['opt_kota']);
        $values['lm_isactive']     = 1;
        
        $this->db->insert('m_lembaga_mitra', $values);
    }
    
    function count_kota()
    {
        $this->db->where("kota_isactive", 1);
        $query = $this->db->get("m_kota");
        return $query->num_rows();
    }
    
    function all_list_kota()
    {
        $this->db->where("kota_isactive", 1);
        $query = $this->db->get("m_kota");
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function list_kota($limit="", $start="")
    {
        $this->db->where("kota_isactive", 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get("m_kota");
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function insert_kota($data = array())
    {
        $values['kota_no']        = trim($data['txt_kota_no']);
        $values['kota_ket']       = ucwords(trim($data['txt_kota_ket']));
        $values['kota_isactive']  = 1;
        $values['kota_update_by'] = $this->session->userdata('userid');
        
        $this->db->insert('m_regional', $values);
    }
    
    function get_last_no()
    {
        $this->db->select_max("kota_no");
        $query = $this->db->get("m_kota");
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function count_bank()
    {
        $this->db->where("bank_isactive", 1);
        $query = $this->db->get("m_bank");
        return $query->num_rows();
    }
    
    function all_list_bank()
    {
        $this->db->where("bank_isactive", 1);
        $query = $this->db->get("m_bank");
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function list_bank($limit="", $start="")
    {
        $this->db->where("bank_isactive", 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get("m_bank");
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function insert_bank($data = array())
    {
        $values['bank_kode']      = trim($data['txt_bank_kode']);
        $values['bank_ket']       = ucwords(trim($data['txt_bank_ket']));
        $values['bank_isactive']  = 1;
        $values['bank_update_by'] = $this->session->userdata('userid');
        
        $this->db->insert('m_bank', $values);
    }
    
    function list_sekolah_aktif($limit="", $start="", $search = "", $kota = "")
    {
        
        $this->db->select('pendaftaran_head.*, pendaftaran_tim.*, jenjang_ket');
        $this->db->join("pendaftaran_head", "pendaftaran_tim_head=pendaftaran_h_id", "left");
        $this->db->join("m_jenjang", "pendaftaran_h_jenjang=jenjang_id", "left");
        
        if($search != "")
        {
            $this->db->like('pendaftaran_h_nama_sekolah', $search);
            //$this->db->where('pendaftaran_h_kota', $kota);
        }
        if($kota != "" AND $kota != "00")
        {
            $this->db->where('pendaftaran_h_kota', $kota);
        }
        
        $this->db->where("pendaftaran_h_isactive", 1);
        //$this->db->where("pendaftaran_tim_isactive", 1);
        $this->db->where("pendaftaran_tim_isdeleted", 1);
        $this->db->limit($limit, $start);
        
        $query = $this->db->get("pendaftaran_tim");
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function get_lokasi_kompetisi($kota, $jenjang)
    {
        $this->db->where("lm_kota", $kota);
        $this->db->where("lm_jenjang", $jenjang);
        $this->db->where("lm_isactive", 1);
        $query = $this->db->get("m_lembaga_mitra");
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function count_tim_active($head_id)
    {
        $this->db->where("pendaftaran_tim_head", $head_id);
        $this->db->where("pendaftaran_tim_isdeleted", 1);
        $query = $this->db->get("pendaftaran_tim");
        return $query->num_rows();
    }
    
    function count_siswa_by_tim($tim_id)
    {
		$this->db->where("pendaftaran_d_tim", $tim_id);
		$query = $this->db->get("pendaftaran_detail");
		return $query->num_rows();
	}
}

/* End of file cpanel_model.php */
/* Location: ./application/models/cpanel_model.php */
