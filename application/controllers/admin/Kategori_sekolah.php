<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_sekolah extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kategori_sekolah_model');

    $this->data['module'] = 'Kategori Sekolah';    

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
    $this->data['title'] = "Data Kategori Sekolah";

    $this->data['Kategori_sekolah_data'] = $this->Kategori_sekolah_model->get_all();
    $this->load->view('back/kategori_sekolah/kategori_sekolah_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Kategori Sekolah Baru';
    $this->data['action']         = site_url('admin/kategori_sekolah/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_kategori_sekolah'] = array(
      'name'  => 'id_kategori_sekolah',
      'id'    => 'id_kategori_sekolah',
      'type'  => 'hidden',
    );

    $this->data['nama_kategori_sekolah'] = array(
      'name'  => 'nama_kategori_sekolah',
      'id'    => 'nama_kategori_sekolah',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_kategori_sekolah'),
    );

    $this->load->view('back/kategori_sekolah/kategori_sekolah_add', $this->data);
  }
  
  public function create_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->create();
    } 
      else 
      {
        $data = array(
          'nama_kategori_sekolah'  => $this->input->post('nama_kategori_sekolah'),
          'nama_kategori_sekolah_seo'    => nama_seo($this->input->post('nama_kategori_sekolah'))
        );

        // eksekusi query INSERT
        $this->Kategori_sekolah_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', 'Data berhasil dibuat');
        redirect(site_url('admin/kategori_sekolah'));
      }  
  }
  
  public function update($id) 
  {
    $row = $this->Kategori_sekolah_model->get_by_id($id);
    $this->data['kategori_sekolah'] = $this->Kategori_sekolah_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Kategori Sekolah';
      $this->data['action']         = site_url('admin/kategori_sekolah/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_kategori_sekolah'] = array(
        'name'  => 'id_kategori_sekolah',
        'id'    => 'id_kategori_sekolah',
        'type'  => 'hidden',
      );

      $this->data['nama_kategori_sekolah'] = array(
        'name'  => 'nama_kategori_sekolah',
        'id'    => 'nama_kategori_sekolah',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->load->view('back/kategori_sekolah/kategori_sekolah_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/kategori_sekolah'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_kategori_sekolah'));
    } 
      else 
      {
        $data = array(
          'nama_kategori_sekolah'  => $this->input->post('nama_kategori_sekolah'),
          'nama_kategori_sekolah_seo'    => nama_seo($this->input->post('nama_kategori_sekolah_seo'))
        );

        $this->Kategori_sekolah_model->update($this->input->post('id_kategori_sekolah'), $data);
        $this->session->set_flashdata('message', 'Edit Data Berhasil');
        redirect(site_url('admin/kategori_sekolah'));
      }
  }
  
  public function delete($id) 
  {
    $row = $this->Kategori_sekolah_model->get_by_id($id);
    
    if ($row) 
    {
      $this->Kategori_sekolah_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/kategori_sekolah'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/kategori_sekolah'));
      }
  }

  public function _rules() 
  {
    $this->form_validation->set_rules('nama_kategori_sekolah', 'Nama Kategori Sekolah', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_kategori_sekolah', 'id_kategori_sekolah', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file Kategori_sekolah.php */
/* Location: ./application/controllers/Kategori_sekolah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */