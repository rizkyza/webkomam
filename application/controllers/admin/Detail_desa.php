<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class detail_desa extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Detail_desa_model');
    $this->load->model('Data_desa_model');

    $this->data['module'] = 'Detail Desa';    

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
    $this->data['title'] = "Detail Desa";
    
    $this->data['detail_desa_data'] = $this->Detail_desa_model->get_all();
    $this->load->view('back/detail_desa/detail_desa_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Data Detail Desa';
    $this->data['action']         = site_url('admin/detail_desa/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_detail_desa'] = array(
      'name'  => 'id_detail_desa',
      'id'    => 'id_detail_desa',
      'type'  => 'hidden',
    );

    $this->data['nama_desa'] = array(
      'name'  => 'nama_desa',
      'id'    => 'nama_desa',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_desa'),
    );

    $this->data['nama_kepala_desa'] = array(
      'name'  => 'nama_kepala_desa',
      'id'    => 'nama_kepala_desa',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_kepala_desa'),
    );

    $this->data['penjelasan_desa'] = array(
      'name'  => 'penjelasan_desa',
      'id'    => 'penjelasan_desa',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('penjelasan_desa'),
    );

    $this->data['get_combo_data_desa'] = $this->Data_desa_model->get_combo_data_desa(); 
    $this->load->view('back/detail_desa/detail_desa_add', $this->data);
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
        /* Jika file upload tidak kosong*/
        /* 4 adalah menyatakan tidak ada file yang diupload*/
        if ($_FILES['userfile']['error'] <> 4) 
        {
          $nmfile = nama_seo($this->input->post('nama_desa'));

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/images/desa/';
          $config['allowed_types']    = 'jpg|jpeg|png|gif';
          $config['max_size']         = '2048'; // 2 MB
          $config['max_width']        = '2000'; //pixels
          $config['max_height']       = '2000'; //pixels
          $config['file_name']        = $nmfile; //nama yang terupload nantinya

          $this->load->library('upload', $config);
          
          if (!$this->upload->do_upload())
          {   //file gagal diupload -> kembali ke form tambah
            $this->create();
          } 
            //file berhasil diupload -> lanjutkan ke query INSERT
            else 
            { 
              $userfile = $this->upload->data();
              $thumbnail                = $config['file_name']; 
              // library yang disediakan codeigniter
              $config['image_library']  = 'gd2'; 
              // gambar yang akan dibuat thumbnail
              $config['source_image']   = './assets/images/desa/'.$userfile['file_name'].''; 
              // membuat thumbnail
              $config['create_thumb']   = TRUE;               
              // rasio resolusi
              $config['maintain_ratio'] = FALSE; 
              // lebar
              $config['width']          = 400; 
              // tinggi
              $config['height']         = 200; 

              $this->load->library('image_lib', $config);
              $this->image_lib->resize();

              $data = array(
                'nama_desa'              => $this->input->post('nama_desa'),
                'nama_desa_seo'          => nama_seo($this->input->post('nama_desa')),
                'nama_kepala_desa'       => $this->input->post('nama_kepala_desa'),
                'penjelasan_desa'        => $this->input->post('penjelasan_desa'),
                'userfile'               => $nmfile,
                'userfile_type'          => $userfile['file_ext'],
                'userfile_size'          => $userfile['file_size'],
                'uploader'               => $this->session->userdata('identity')
              );

              // eksekusi query INSERT
              $this->Detail_desa_model->insert($data);
              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat');
              redirect(site_url('admin/detail_desa'));
            }
        }
        else // Jika file upload kosong
        {
          $data = array(
                'nama_desa'              => $this->input->post('nama_desa'),
                'nama_desa_seo'          => nama_seo($this->input->post('nama_desa')),
                'nama_kepala_desa'       => $this->input->post('nama_kepala_desa'),
                'penjelasan_desa'        => $this->input->post('penjelasan_desa'),
                'uploader'               => $this->session->userdata('identity')
          );

          // eksekusi query INSERT
          $this->Detail_desa_model->insert($data);
          // set pesan data berhasil dibuat
          $this->session->set_flashdata('message', 'Data berhasil dibuat');
          redirect(site_url('admin/detail_desa'));
        }
      }  
  }
  
  public function update($id) 
  {
    $row = $this->Detail_desa_model->get_by_id($id);
    $this->data['detail_desa'] = $this->Detail_desa_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Detail Desa';
      $this->data['action']         = site_url('admin/detail_desa/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_detail_desa'] = array(
        'name'  => 'id_detail_desa',
        'id'    => 'id_detail_desa',
        'type'=> 'hidden',
      );

      $this->data['data_desa_css'] = array(
        'name'  => 'nama_desa',
        'id'    => 'nama_desa',
        'class' => 'form-control',
      );

      $this->data['nama_kepala_desa'] = array(
        'name'  => 'nama_kepala_desa',
        'id'    => 'nama_kepala_desa',      
        'class' => 'form-control',
      );

      $this->data['penjelasan_desa'] = array(
        'name'  => 'penjelasan_desa',
        'id'    => 'penjelasan_desa',
        'class' => 'form-control',
      );

        $this->data['get_combo_data_desa'] = $this->Data_desa_model->get_combo_data_desa(); 
        $this->load->view('back/detail_desa/detail_desa_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/detail_desa'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_detail_desa'));
    } 
      else 
      {
        $nmfile = nama_seo($this->input->post('nama_desa'));
        $id['id_detail_desa'] = $this->input->post('id_detail_desa'); 
        
        /* Jika file upload diisi */
        if ($_FILES['userfile']['error'] <> 4) 
        {
          // select column yang akan dihapus (gambar) berdasarkan id
          $this->db->select("userfile, userfile_type");
          $this->db->where($id);
          $query = $this->db->get('detail_desa');
          $row = $query->row();        

          // menyimpan lokasi gambar dalam variable
          $dir = "assets/images/desa/".$row->userfile.$row->userfile_type;
          $dir_thumb = "assets/images/desa/".$row->userfile.'_thumb'.$row->userfile_type;

          // Jika ada foto lama, maka hapus foto kemudian upload yang baru
          if($dir)
          {
            $nmfile = nama_seo($this->input->post('nama_desa'));
            
            // Hapus foto
            unlink($dir);
            unlink($dir_thumb);

            //load uploading file library
            $config['upload_path']      = './assets/images/desa/';
            $config['allowed_types']    = 'jpg|jpeg|png|gif';
            $config['max_size']         = '2048'; // 2 MB
            $config['max_width']        = '2000'; //pixels
            $config['max_height']       = '2000'; //pixels
            $config['file_name']        = $nmfile; //nama yang terupload nantinya

            $this->load->library('upload', $config);
            
            // Jika file gagal diupload -> kembali ke form update
            if (!$this->upload->do_upload())
            {   
              $this->update();
            } 
              // Jika file berhasil diupload -> lanjutkan ke query INSERT
              else 
              { 
                $userfile = $this->upload->data();
                // library yang disediakan codeigniter
                $thumbnail                = $config['file_name']; 
                //nama yang terupload nantinya
                $config['image_library']  = 'gd2'; 
                // gambar yang akan dibuat thumbnail
                $config['source_image']   = './assets/images/desa/'.$userfile['file_name'].''; 
                // membuat thumbnail
                $config['create_thumb']   = TRUE;               
                // rasio resolusi
                $config['maintain_ratio'] = FALSE; 
                // lebar
                $config['width']          = 400; 
                // tinggi
                $config['height']         = 200; 

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data = array(
                  'nama_desa'  => $this->input->post('nama_desa'),
                  'nama_desa_seo'               => nama_seo($this->input->post('nama_desa')),
                  'nama_kepala_desa'  => $this->input->post('nama_kepala_desa'),
                  'penjelasan_desa'    => $this->input->post('penjelasan_desa'),

                  'userfile'      => $nmfile,
                  'userfile_type' => $userfile['file_ext'],
                  'userfile_size' => $userfile['file_size'],
                  'uploader'       => $this->session->userdata('identity')
                );

                $this->Detail_desa_model->update($this->input->post('id_detail_desa'), $data);
                $this->session->set_flashdata('message', 'Edit Data Berhasil');
                redirect(site_url('admin/detail_desa'));
              }
          }
            // Jika tidak ada foto pada record, maka upload foto baru
            else
            {
              //load uploading file library
              $config['upload_path']      = './assets/images/desa/';
              $config['allowed_types']    = 'jpg|jpeg|png|gif';
              $config['max_size']         = '2048'; // 2 MB
              $config['max_width']        = '2000'; //pixels
              $config['max_height']       = '2000'; //pixels
              $config['file_name']        = $nmfile; //nama yang terupload nantinya

              $this->load->library('upload', $config);
              
              // Jika file gagal diupload -> kembali ke form update
              if (!$this->upload->do_upload())
              {   
                $this->update();
              } 
                // Jika file berhasil diupload -> lanjutkan ke query INSERT
                else 
                { 
                  $userfile = $this->upload->data();
                  // library yang disediakan codeigniter
                  $thumbnail                = $config['file_name']; 
                  //nama yang terupload nantinya
                  $config['image_library']  = 'gd2'; 
                  // gambar yang akan dibuat thumbnail
                  $config['source_image']   = './assets/images/desa/'.$userfile['file_name'].''; 
                  // membuat thumbnail
                  $config['create_thumb']   = TRUE;               
                  // rasio resolusi
                  $config['maintain_ratio'] = FALSE; 
                  // lebar
                  $config['width']          = 400; 
                  // tinggi
                  $config['height']         = 200; 

                  $this->load->library('image_lib', $config);
                  $this->image_lib->resize();

                  $data = array(
                    'nama_desa'  => $this->input->post('nama_desa'),
                    'nama_desa_seo'               => nama_seo($this->input->post('nama_desa')),
                    'nama_kepala_desa'  => $this->input->post('nama_kepala_desa'),
                    'penjelasan_desa'    => $this->input->post('penjelasan_desa'),
                    'uploader'      => $this->session->userdata('identity'),

                    'userfile'      => $nmfile,
                    'userfile_type' => $userfile['file_ext'],
                    'userfile_size' => $userfile['file_size']
                  );

                  $this->Detail_desa_model->update($this->input->post('id_detail_desa'), $data);
                  $this->session->set_flashdata('message', 'Edit Data Berhasil');
                  redirect(site_url('admin/detail_desa'));
                }
            }
        }
          // Jika file upload kosong
          else 
          {
            $data = array(
              'nama_desa'  => $this->input->post('nama_desa'),
              'nama_desa_seo'               => nama_seo($this->input->post('nama_desa')),
              'nama_kepala_desa'  => $this->input->post('nama_kepala_desa'),
              'penjelasan_desa'  => $this->input->post('penjelasan_desa'),
              'uploader'      => $this->session->userdata('identity')
            );

            $this->Detail_desa_model->update($this->input->post('id_detail_desa'), $data);
            $this->session->set_flashdata('message', 'Edit Data Berhasil');
            redirect(site_url('admin/detail_desa'));
          }
      }  
  }
  
  public function delete($id) 
  {
    $row = $this->Detail_desa_model->get_by_id($id);

    $this->db->select("userfile, userfile_type");
    $this->db->where($row);
    $query = $this->db->get('detail_desa');
    $row2 = $query->row();        

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/desa/".$row2->userfile.$row2->userfile_type;
    $dir_thumb = "assets/images/desa/".$row2->userfile.'_thumb'.$row2->userfile_type;

    // Jika data ditemukan, maka hapus foto dan record nya
    if ($row) 
    {
      // Hapus foto
      unlink($dir);
      unlink($dir_thumb);

      $this->Detail_desa_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/detail_desa'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/detail_desa'));
      }
  }

  // Aktivasi user
  
  public function activation($id) 
  {
    $row = $this->data_pejabat_model->get_by_id($id);
    $this->data['data_pejabat'] = $this->data_pejabat_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update data_pejabat';
      $this->data['action']         = site_url('admin/data_pejabat/activation_action');
      $this->data['button_submit']  = 'Active';

      $this->data['id_pejabat'] = array(
        'name'  => 'id_pejabat',
        'id'    => 'id_pejabat',
        'type'=> 'hidden',
      );

    $this->data['active'] = array(
      'name'  => 'active',
      'id'    => 'active',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('active'),
    );

    

      $this->load->view('back/data_pejabat/data_pejabat_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/data_pejabat'));
      }
  }
  
  public function activation_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_pejabat'));
    } 
      else 
      {
        $id['id_pejabat'] = $this->input->post('id_pejabat'); 
        

            $data = array(
              'active'        => $this->input->post('active'),
              'uploader'      => $this->session->userdata('identity')
            );

            $this->data_pejabat_model->update($this->input->post('id_pejabat'), $data);
            $this->session->set_flashdata('message', 'Aktivasi Data Berhasil');
            redirect(site_url('admin/data_pejabat'));
          }
  }  
  
  public function activate($id, $code=false){
    if ($code !== false)
    {
      $activation = $this->ion_auth->activate($id, $code);
    }
    

    if ($activation)
    {
      // redirect them to the auth page
      $this->session->set_flashdata('message', 'Akun berhasil diaktifkan');
      redirect(site_url('admin/data_pejabat'));
    }
    else
    {
      // redirect them to the forgot password page
      $this->session->set_flashdata('message', 'Akun gagal diaktifkan');
      redirect(site_url('admin/data_pejabat'));
    }
  }

  // Nonaktifkan user
  public function deactivate($id = NULL){
    $id = (int) $id;

    // mengarahkan ke halaman user/ data user
    $this->session->set_flashdata('message', 'Akun berhasil dinonaktifkan');
    redirect(site_url('admin/data_pejabat'));
  }

  public function _rules() 
  {
    $this->form_validation->set_rules('nama_desa', 'nama_desa', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_detail_desa', 'id_detail_desa', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file detail_desa.php */
/* Location: ./application/controllers/detail_desa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */