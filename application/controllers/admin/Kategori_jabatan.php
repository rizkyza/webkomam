<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_jabatan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kategori_jabatan_model');

    $this->data['module'] = 'Kategori Jabatan';    

    /* cek login */
    if (!$this->ion_auth->logged_in()){
      // apabila belum login maka diarahkan ke halaman login
      redirect('admin/auth/login', 'refresh');
    }
    elseif($this->ion_auth->is_user()){
      // apabila belum login maka diarahkan ke halaman login
      redirect('admin/auth/login', 'refresh');
    }
  }

  public function index()
  {
    $this->data['title'] = "Data Kategori Jabatan";

    $this->data['Kategori_jabatan_data'] = $this->Kategori_jabatan_model->get_all();
    $this->load->view('back/kategori_jabatan/kategori_jabatan_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Kategori Jabatan Baru';
    $this->data['action']         = site_url('admin/kategori_jabatan/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_kategori_jabatan'] = array(
      'name'  => 'id_kategori_jabatan',
      'id'    => 'id_kategori_jabatan',
      'type'  => 'hidden',
    );

    $this->data['nama_jabatan'] = array(
      'name'  => 'nama_jabatan',
      'id'    => 'nama_jabatan',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_jabatan'),
    );

    $this->load->view('back/kategori_jabatan/kategori_jabatan_add', $this->data);
  }
  
  public function create_action() 
  {
    $this->load->helper('judul_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->create();
    } 
      else 
      {
        $data = array(
          'nama_jabatan'  => $this->input->post('nama_jabatan'),
          'nama_jabatan_seo'    => judul_seo($this->input->post('nama_jabatan'))
        );

        // eksekusi query INSERT
        $this->Kategori_jabatan_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', 'Data berhasil dibuat');
        redirect(site_url('admin/kategori_jabatan'));
      }  
  }
  
  public function update($id) 
  {
    $row = $this->Kategori_jabatan_model->get_by_id($id);
    $this->data['kategori_jabatan'] = $this->Kategori_jabatan_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Kategori Jabatan';
      $this->data['action']         = site_url('admin/kategori_jabatan/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_kategori_jabatan'] = array(
        'name'  => 'id_kategori_jabatan',
        'id'    => 'id_kategori_jabatan',
        'type'  => 'hidden',
      );

      $this->data['nama_jabatan'] = array(
        'name'  => 'nama_jabatan',
        'id'    => 'nama_jabatan',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->load->view('back/kategori_jabatan/kategori_jabatan_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/kategori_jabatan'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('judul_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_kategori_jabatan'));
    } 
      else 
      {
        $data = array(
          'nama_jabatan'  => $this->input->post('nama_jabatan'),
          'nama_jabatan_seo'    => judul_seo($this->input->post('nama_jabatan'))
        );

        $this->Kategori_jabatan_model->update($this->input->post('id_kategori_jabatan'), $data);
        $this->session->set_flashdata('message', 'Edit Data Berhasil');
        redirect(site_url('admin/kategori_jabatan'));
      }
  }
  
  public function delete($id) 
  {
    $row = $this->Kategori_jabatan_model->get_by_id($id);
    
    if ($row) 
    {
      $this->Kategori_jabatan_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/kategori_jabatan'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/kategori_jabatan'));
      }
  }

  public function _rules() 
  {
    $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_kategori_jabatan', 'id_kategori_jabatan', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file Kategori_jabatan.php */
/* Location: ./application/controllers/Kategori_jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */