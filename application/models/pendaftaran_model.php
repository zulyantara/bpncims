<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    /*
     *@author Zulyantara <zulyantara@gmail.com> 2014
     */
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function count_pendaftaran_head($kota)
    {
        if($kota != "00")
        {
            $this->db->where("pendaftaran_h_kota", $kota);
        }
        $query = $this->db->get('pendaftaran_head');
        return $query->num_rows();
    }
    
    function count_tim($head_id)
    {
        $this->db->where('pendaftaran_tim_head', $head_id);
        $this->db->where("pendaftaran_tim_isdeleted", 1);
        $query = $this->db->get('pendaftaran_tim');
        return $query->num_rows();
    }
    
    function count_siswa($head_id)
    {
        $this->db->where('pendaftaran_d_head', $head_id);
        $query = $this->db->get('pendaftaran_detail');
        return $query->num_rows();
    }
    
    function qty_siswa($head_id, $tim_id)
    {
        $this->db->where('pendaftaran_d_head', $head_id);
        $this->db->where('pendaftaran_d_tim', $tim_id);
        
        $query = $this->db->get('pendaftaran_detail');
        
        return $query->num_rows();
    }
    
    function cek_siswa($head_id, $tim_id, $siswa_id)
    {
        $this->db->where('pendaftaran_d_head', $head_id);
        $this->db->where('pendaftaran_d_tim', $tim_id);
        $this->db->where('pendaftaran_d_siswa', $siswa_id);
        
        $query = $this->db->get('pendaftaran_detail');
        
        return $query->num_rows();
    }
    
    function get_kota()
    {
        $this->db->select('kota_no, kota_ket');
        $this->db->order_by('kota_no');
        $this->db->where('kota_isactive', 1);
        
        $query = $this->db->get('m_kota');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function get_kota_aktif()
    {
        $this->db->select('kota_no, kota_ket');
        $this->db->order_by('kota_no');
        $this->db->where('kota_no !=', "06");
        $this->db->where('kota_no !=', "07");
        $this->db->where('kota_no !=', "08");
        $this->db->where('kota_no !=', "09");
        $this->db->where('kota_no !=', "10");
        $this->db->where('kota_no !=', "11");
        $this->db->where('kota_no !=', "12");
        $this->db->where('kota_no !=', "13");
        
        $query = $this->db->get('m_kota');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function get_kota_by_id($id)
    {
        $this->db->select('kota_no, kota_ket');
        $this->db->order_by('kota_no');
        $this->db->where('kota_isactive', 1);
        $this->db->where('kota_no', $id);
        
        $query = $this->db->get('m_kota');
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function get_pendaftar($limit, $start, $search = "", $kota = "")
    {
        $this->db->select('pendaftaran_head.*, kota_ket, jenjang_ket');
        $this->db->order_by('pendaftaran_h_id', 'desc');
        //$this->db->order_by('pendaftaran_h_jenjang', 'asc');
        //$this->db->order_by('pendaftaran_h_nama_sekolah', 'asc');
        $this->db->join('m_kota', 'pendaftaran_h_kota=kota_no', 'left');
        $this->db->join('m_jenjang', 'pendaftaran_h_jenjang=jenjang_id', 'left');
        if($search != "")
        {
            $this->db->like('pendaftaran_h_nama_sekolah', $search);
            //$this->db->where('pendaftaran_h_kota', $kota);
        }
        if($kota != "" AND $kota != "00")
        {
            $this->db->where('pendaftaran_h_kota', $kota);
        }
        //$this->db->group_by('pendaftaran_h_nama_sekolah, kota_ket, jenjang_ket');
        $this->db->limit($limit, $start);
        
        $query = $this->db->get('pendaftaran_head');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function get_jenjang()
    {
        $this->db->select('jenjang_id, jenjang_ket');
        $this->db->order_by('jenjang_id');
        $this->db->where('jenjang_isactive', 1);
        
        $query = $this->db->get('m_jenjang');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function cek_pendaftaran($nama_sekolah, $kota_sekolah, $kota_kompetisi, $jenjang)
    //function cek_pendaftaran($nama_sekolah, $kota_kompetisi, $jenjang)
    {
        $this->db->where('pendaftaran_h_nama_sekolah', $nama_sekolah);
        $this->db->like('pendaftaran_h_kota_sekolah', $kota_sekolah);
        $this->db->where('pendaftaran_h_kota', $kota_kompetisi);
        $this->db->where('pendaftaran_h_jenjang', $jenjang);
        
        $query = $this->db->get('pendaftaran_head');
        
        return $query->num_rows();
    }
    
    function cek_kode_pendaftaran($kode_pendaftaran)
    {
        $this->db->where('pendaftaran_h_kode', $kode_pendaftaran); 
        
        $query = $this->db->get('pendaftaran_head');
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function cek_no_register($no_register)
    {
        $this->db->select('pendaftaran_tim_noreg');
        $this->db->order_by('pendaftaran_tim_noreg', 'desc');
        $this->db->like('pendaftaran_tim_noreg', $no_register, 'after'); 
        //$this->db->where('pendaftaran_h_no_register', $no_register);
        
        $query = $this->db->get('pendaftaran_tim');
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function insert_pendaftaran_header($data = array())
    {
        $values['pendaftaran_h_kode']            = $data['txt_kode'];
        $values['pendaftaran_h_nama_sekolah']    = $data['txt_nama_sekolah'];
        $values['pendaftaran_h_kota_sekolah']    = $data['txt_kota_sekolah'];
        $values['pendaftaran_h_jenjang']         = $data['opt_jenjang'];
        $values['pendaftaran_h_kota']            = $data['opt_kota'];
        $values['pendaftaran_h_alamat_sekolah']  = $data['txt_alamat'];
        $values['pendaftaran_h_telp_sekolah']    = $data['txt_no_telp'];
        $values['pendaftaran_h_nama_kepsek']     = $data['txt_nama_kepsek'];
        $values['pendaftaran_h_hp_kepsek']       = $data['txt_no_hp_kepsek'];
        $values['pendaftaran_h_nama_pendamping'] = $data['txt_nama_pendamping'];
        $values['pendaftaran_h_hp_pendamping']   = $data['txt_no_hp_pendamping'];
        $values['pendaftaran_h_email']           = $data['txt_email_sekolah'];
        $values['pendaftaran_h_jml_tim']         = $data['opt_jml_tim'];
        $values['pendaftaran_h_isactive']        = 0;
        $values['pendaftaran_h_insert_date']     = date('Y-m-d H:i:s');
        
        $this->db->insert('pendaftaran_head', $values);
    }
    
    function update_pendaftaran_header($data = array())
    {
        $values['pendaftaran_h_nama_sekolah']    = $data['txt_nama_sekolah'];
        $values['pendaftaran_h_kota_sekolah']    = $data['txt_kota_sekolah'];
        $values['pendaftaran_h_jenjang']         = $data['opt_jenjang'];
        $values['pendaftaran_h_kota']            = $data['opt_kota'];
        $values['pendaftaran_h_alamat_sekolah']  = $data['txt_alamat'];
        $values['pendaftaran_h_telp_sekolah']    = $data['txt_no_telp'];
        $values['pendaftaran_h_nama_kepsek']     = $data['txt_nama_kepsek'];
        $values['pendaftaran_h_hp_kepsek']       = $data['txt_no_hp_kepsek'];
        $values['pendaftaran_h_nama_pendamping'] = $data['txt_nama_pendamping'];
        $values['pendaftaran_h_hp_pendamping']   = $data['txt_no_hp_pendamping'];
        $values['pendaftaran_h_email']           = $data['txt_email_sekolah'];
        //$values['pendaftaran_h_jml_tim']         = $data['opt_jml_tim'];
        $values['pendaftaran_h_isactive']        = 0;
        $values['pendaftaran_h_update_date']     = date('Y-m-d H:i:s');
        
        $this->db->where('pendaftaran_h_kode', $data['txt_kode_pendaftaran']);
        $this->db->update('pendaftaran_head', $values);
    }
    
    function update_pendaftaran_jml_tim($kode_pendaftaran, $jml_tim)
    {
        $values['pendaftaran_h_jml_tim'] = $jml_tim;
        $this->db->where('pendaftaran_h_kode', $kode_pendaftaran);
        $this->db->update("pendaftaran_head", $values);
    }
    
    function insert_pendaftaran_tim($data = array())
    {
        $this->db->select('pendaftaran_h_kota, pendaftaran_h_jenjang');
        $this->db->where('pendaftaran_h_id', $data['txt_head_id']);
        
        $query = $this->db->get('pendaftaran_head');
        
        $row = ($query->num_rows() > 0) ? $query->row() : "";
        
        $no_reg_last = $this->cek_no_register($row->pendaftaran_h_kota.$row->pendaftaran_h_jenjang.$data['opt_gender']);
        
        if($no_reg_last == "")
        {
            $noRegLast = "000";
        }
        else
        {
            $noRegLast = $no_reg_last->pendaftaran_tim_noreg;
            
        }
        
        $no_reg_exist = substr($noRegLast, -3) + 1;
        
        if(strlen($no_reg_exist) === 1)
        {
            $noReg = "00".$no_reg_exist;
        }
        elseif(strlen($no_reg_exist) === 2)
        {
            $noReg = "0".$no_reg_exist;
        }
        elseif(strlen($no_reg_exist) === 3)
        {
            $noReg = $no_reg_exist;
        }
        
        $no_reg = $row->pendaftaran_h_kota.$row->pendaftaran_h_jenjang.$data['opt_gender'].$noReg;
        
        $values['pendaftaran_tim_head']            = $data['txt_head_id'];
        $values['pendaftaran_tim_noreg']           = $no_reg;
        $values['pendaftaran_tim_gender']          = $data['opt_gender'];
        $values['pendaftaran_tim_nama']            = $data['txt_nama'];
        $values['pendaftaran_tim_no_rek']          = $data['txt_no_rek'];
        $values['pendaftaran_tim_an_rek']          = $data['txt_an_rek'];
        $values['pendaftaran_tim_jml_transfer']    = 75000;
        $values['pendaftaran_tim_tgl_transfer']    = $data['txt_tgl_transfer'];
        $values['pendaftaran_tim_bank_transfer']   = $data['opt_bank_pengirim'];
        $values['pendaftaran_tim_isactive']        = 0; /* Set 1 for tim active, set 0 for tim not active */
        $values['pendaftaran_tim_insert_date']     = date('Y-m-d H:i:s');
        $values['pendaftaran_tim_isdeleted']       = 1; /* Set 0 for tim deleted */
        
        $this->db->insert('pendaftaran_tim', $values);
    }
    
    function delete_pendaftaran_tim($id)
    {
        //$values['pendaftaran_tim_isdeleted'] = 0;
        $this->db->where('pendaftaran_tim_id', $id);
        //$this->db->update('pendaftaran_tim', $values);
        $this->db->delete('pendaftaran_tim');
    }
    
    function cek_pendaftaran_kode($kode)
    {
        $this->db->where('pendaftaran_h_kode', $kode);
        $query = $this->db->get('pendaftaran_head');
        return $query->num_rows();
    }
    
    function get_pendaftaran_head($kode_pendaftaran)
    {
        $this->db->select('pendaftaran_h_id, pendaftaran_h_kode, pendaftaran_h_nama_sekolah, pendaftaran_h_email, pendaftaran_h_jml_tim, pendaftaran_h_kota_sekolah, pendaftaran_h_kota, pendaftaran_h_jenjang, kota_ket');
        $this->db->join('m_kota', 'pendaftaran_h_kota=kota_no', 'left');
        $this->db->where('pendaftaran_h_kode', $kode_pendaftaran);
        
        $query = $this->db->get('pendaftaran_head');
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function get_pendaftaran_head_id_by_id($id)
    {
        $this->db->select('pendaftaran_head.*, kota_ket, jenjang_ket');
        $this->db->where('pendaftaran_h_id', $id);
        $this->db->join('m_kota', 'pendaftaran_h_kota=kota_no', 'left');
        $this->db->join('m_jenjang', 'pendaftaran_h_jenjang=jenjang_id', 'left');
        
        $query = $this->db->get('pendaftaran_head');
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function get_selected_tim($id)
    {
        $this->db->select('pendaftaran_tim_id, pendaftaran_tim_head, pendaftaran_tim_noreg, pendaftaran_tim_nama, pendaftaran_tim_gender');
        $this->db->where('pendaftaran_tim_id', $id);
        
        $query = $this->db->get('pendaftaran_tim');
        
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
    
    function get_tim($head_id)
    {
        $this->db->select('pendaftaran_tim_id, pendaftaran_tim_head, pendaftaran_tim_nama, pendaftaran_tim_gender, pendaftaran_tim_noreg');
        $this->db->where('pendaftaran_tim_head', $head_id);
        $this->db->where('pendaftaran_tim_isdeleted', 1);
        $this->db->order_by("pendaftaran_tim_insert_date");
        //$this->db->where('pendaftaran_tim_isactive', 1);
        
        $query = $this->db->get('pendaftaran_tim');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function get_qty_tim($id)
    {
        $this->db->where('pendaftaran_tim_head', $id);
        $query = $query = $this->db->get('pendaftaran_tim');
        return $query->num_rows;
    }
    
    function list_siswa($head_id, $tim_id)
    {
        $this->db->select("siswa.*, pendaftaran_d_head, pendaftaran_d_tim");
        $this->db->where('pendaftaran_d_head', $head_id);
        $this->db->where('pendaftaran_d_tim', $tim_id);
        $this->db->where('siswa_isactive', 1);
        $this->db->join('siswa', 'pendaftaran_d_siswa=siswa_id', 'left');
        
        $query = $this->db->get('pendaftaran_detail');
        
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function list_sekolah()
    {
        $this->db->select('pendaftaran_h_id, pendaftaran_h_nama_sekolah, m_kota.kota_ket, m_jenjang.jenjang_ket');
        $this->db->where('pendaftaran_h_isactive', 0);
        $this->db->join('m_kota', 'pendaftaran_h_kota=kota_no', 'left');
        $this->db->join('m_jenjang', 'pendaftaran_h_jenjang=jenjang_id', 'left');
        $query = $this->db->get('pendaftaran_head');
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function list_kota()
    {
        $this->db->where('kota_isactive', 1);
        $query = $this->db->get('m_kota');
        return ($query->num_rows() > 0) ? $query->result() : FALSE;
    }
    
    function insert_siswa($data=array())
    {
        $values['siswa_nama'] = $data['txt_nama'];
        $values['siswa_kelas'] = $data['txt_kelas'];
        $values['siswa_tmp_lahir'] = $data['txt_tmp_lahir'];
        $values['siswa_tgl_lahir'] = $data['txt_tgl_lahir'];
        $values['siswa_jns_kelamin'] = $data['txt_jns_kelamin'];
        $values['siswa_alamat'] = $data['txt_alamat'];
        $values['siswa_agama'] = $data['txt_agama'];
        $values['siswa_nama_ayah'] = $data['txt_nama_ayah'];
        $values['siswa_pekerjaan_ayah'] = $data['txt_pekerjaan_ayah'];
        $values['siswa_nama_ibu'] = $data['txt_nama_ibu'];
        $values['siswa_pekerjaan_ibu'] = $data['txt_pekerjaan_ibu'];
        $values['siswa_telp_ortu'] = $data['txt_telp_ortu'];
        $values['siswa_email_ortu'] = $data['txt_email_ortu'];
        $values['siswa_isactive'] = 1;
        $values['siswa_insert_date'] = date("Y-m-d H:i:s");
        
        $this->db->insert('siswa', $values);
        
        $this->db->select('siswa_id');
        $this->db->where('siswa_nama',$data['txt_nama']);
        $this->db->where('siswa_kelas',$data['txt_kelas']);
        $this->db->where('siswa_tmp_lahir',$data['txt_tmp_lahir']);
        $this->db->where('siswa_tgl_lahir',$data['txt_tgl_lahir']);
        $this->db->where('siswa_jns_kelamin',$data['txt_jns_kelamin']);
        $this->db->where('siswa_alamat',$data['txt_alamat']);
        $this->db->where('siswa_nama_ayah',$data['txt_nama_ayah']);
        $this->db->where('siswa_pekerjaan_ayah',$data['txt_pekerjaan_ayah']);
        $this->db->where('siswa_nama_ibu',$data['txt_nama_ibu']);
        $this->db->where('siswa_pekerjaan_ibu',$data['txt_pekerjaan_ibu']);
        $this->db->where('siswa_telp_ortu',$data['txt_telp_ortu']);
        $this->db->where('siswa_email_ortu',$data['txt_email_ortu']);
        $this->db->where('siswa_isactive', 1);
        
        $query_siswa = $this->db->get('siswa');
        $row_siswa = ($query_siswa->num_rows() > 0) ? $query_siswa->row() : FALSE;
        
        $id_siswa = $row_siswa->siswa_id;
        
        $values_detail['pendaftaran_d_head']  = $data['txt_head_id'];
        $values_detail['pendaftaran_d_tim']   = $data['txt_tim_id'];
        $values_detail['pendaftaran_d_siswa'] = $id_siswa;
        
        $this->db->insert('pendaftaran_detail', $values_detail);
    }
    
    function delete_siswa($id)
    {
        //$values['siswa_isactive'] = 0;
        $this->db->where('siswa_id', $id);
        //$this->db->update('siswa', $values);
        $this->db->delete('siswa');
        
        $this->db->delete('pendaftaran_detail', array('pendaftaran_d_siswa' => $id));
    }
    
    function get_siswa($id)
    {
        $this->db->join("m_jenjang", "siswa_jenjang=jenjang_id", "left");
        $this->db->where("siswa_id", $id);
        $this->db->where("siswa_isactive", 1);
        $query = $this->db->get("siswa");
        return ($query->num_rows() > 0) ? $query->row() : FALSE;
    }
}

/* End of file pendaftaran_model.php */
/* Location: ./application/models/pendaftaran_model.php */
