<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vimi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Vimi_model');

    $this->data['module'] = 'Vimi';    

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
    $this->data['title'] = "Data Visi & Misi";

    $this->data['Vimi_data'] = $this->Vimi_model->get_all();
    $this->load->view('back/vimi/vimi_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Visi & Misi Baru';
    $this->data['action']         = site_url('admin/vimi/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_vimi'] = array(
      'name'  => 'id_vimi',
      'id'    => 'id_vimi',
      'type'  => 'hidden',
    );

    $this->data['visi'] = array(
      'name'  => 'visi',
      'id'    => 'visi',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('visi'),
    );

    $this->data['misi'] = array(
      'name'  => 'misi',
      'id'    => 'misi',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('misi'),
    );

    $this->load->view('back/vimi/vimi_add', $this->data);
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
          'visi'  => $this->input->post('visi'),
          'misi'  => $this->input->post('misi'),
          'vimi_seo'    => $this->input->post('visi')
        );

        // eksekusi query INSERT
        $this->Kategori_model->insert($data);
        // set pesan data berhasil dibuat
        $this->session->set_flashdata('message', 'Data berhasil dibuat');
        redirect(site_url('admin/vimi'));
      }  
  }
  
  public function update($id) 
  {
    $row = $this->Vimi_model->get_by_id($id);
    $this->data['vimi'] = $this->Vimi_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Visi & Misi';
      $this->data['action']         = site_url('admin/vimi/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_vimi'] = array(
        'name'  => 'id_vimi',
        'id'    => 'id_vimi',
        'type'  => 'hidden',
      );

      $this->data['visi'] = array(
        'name'  => 'visi',
        'id'    => 'visi',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['misi'] = array(
        'name'  => 'misi',
        'id'    => 'misi',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->load->view('back/vimi/vimi_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/vimi'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('judul_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_vimi'));
    } 
      else 
      {
        $data = array(
          'visi'  => $this->input->post('visi'),
          'misi'    => $this->input->post('misi')
        );

        $this->Vimi_model->update($this->input->post('id_vimi'), $data);
        $this->session->set_flashdata('message', 'Edit Data Berhasil');
        redirect(site_url('admin/vimi'));
      }
  }
  
  public function delete($id) 
  {
    $row = $this->Vimi_model->get_by_id($id);
    
    if ($row) 
    {
      $this->Vimi_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/vimi'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/vimi'));
      }
  }

  public function _rules() 
  {
    $this->form_validation->set_rules('visi', 'visi', 'trim|required');
    $this->form_validation->set_rules('misi', 'misi', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_vimi', 'id_vimi', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file Vimi.php */
/* Location: ./application/controllers/Vimi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */