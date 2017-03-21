<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class kepala_desa extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Kepala_desa_model');
    $this->load->model('Detail_desa_model');
    $this->load->model('Data_desa_model');

    $this->data['module'] = 'Kepala Desa';    

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
    $this->data['title'] = "Data Kepala Desa";
    
    $this->data['kepala_desa_data'] = $this->Kepala_desa_model->get_all();
    $this->load->view('back/kepala_desa/kepala_desa_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Data Kepala Desa';
    $this->data['action']         = site_url('admin/kepala_desa/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_kepala_desa'] = array(
      'name'  => 'id_kepala_desa',
      'id'    => 'id_kepala_desa',
      'type'  => 'hidden',
    );

    $this->data['nama_kepala_desa'] = array(
      'name'  => 'nama_kepala_desa',
      'id'    => 'nama_kepala_desa',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_kepala_desa'),
    );

    $this->data['periode_jabatan'] = array(
      'name'  => 'periode_jabatan',
      'id'    => 'periode_jabatan',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('periode_jabatan'),
    );

    $this->data['nama_desa'] = array(
      'name'  => 'nama_desa',
      'id'    => 'nama_desa',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama_desa'),
    );

    $this->data['tempat_lahir'] = array(
      'name'  => 'tempat_lahir',
      'id'    => 'tempat_lahir',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('tempat_lahir'),
    );

    $this->data['tanggal_lahir'] = array(
      'name'  => 'tanggal_lahir',
      'id'    => 'tanggal_lahir',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('tanggal_lahir'),
    );

    $this->data['alamat'] = array(
      'name'  => 'alamat',
      'id'    => 'alamat',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('alamat'),
    );

    $this->data['get_combo_data_desa'] = $this->Data_desa_model->get_combo_data_desa(); 
    $this->load->view('back/kepala_desa/kepala_desa_add', $this->data);
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
          $nmfile = nama_seo($this->input->post('nama_kepala_desa'));

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/images/kepala_desa/';
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
              $config['source_image']   = './assets/images/kepala_desa/'.$userfile['file_name'].''; 
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
                'nama_kepala_desa'              => $this->input->post('nama_kepala_desa'),
                'nama_kepala_desa_seo'          => nama_seo($this->input->post('nama_kepala_desa')),
                'periode_jabatan'       => $this->input->post('periode_jabatan'),
                'nama_desa'        => $this->input->post('nama_desa'),
                'tempat_lahir'        => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'alamat'        => $this->input->post('alamat'),
                'userfile'               => $nmfile,
                'userfile_type'          => $userfile['file_ext'],
                'userfile_size'          => $userfile['file_size'],
                'uploader'               => $this->session->userdata('identity')
              );

              // eksekusi query INSERT
              $this->Kepala_desa_model->insert($data);
              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat');
              redirect(site_url('admin/kepala_desa'));
            }
        }
        else // Jika file upload kosong
        {
          $data = array(
                'nama_kepala_desa'              => $this->input->post('nama_kepala_desa'),
                'nama_kepala_desa_seo'          => nama_seo($this->input->post('nama_kepala_desa')),
                'periode_jabatan'       => $this->input->post('periode_jabatan'),
                'nama_desa'        => $this->input->post('nama_desa'),
                'tempat_lahir'        => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'alamat'        => $this->input->post('alamat'),
                'uploader'               => $this->session->userdata('identity')
          );

          // eksekusi query INSERT
          $this->Kepala_desa_model->insert($data);
          // set pesan data berhasil dibuat
          $this->session->set_flashdata('message', 'Data berhasil dibuat');
          redirect(site_url('admin/kepala_desa'));
        }
      }  
  }
  
  public function update($id) 
  {
    $row = $this->Kepala_desa_model->get_by_id($id);
    $this->data['kepala_desa'] = $this->Kepala_desa_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Kepala Desa';
      $this->data['action']         = site_url('admin/kepala_desa/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_kepala_desa'] = array(
        'name'  => 'id_kepala_desa',
        'id'    => 'id_Kepala_desa',
        'type'=> 'hidden',
      );

      $this->data['nama_kepala_desa'] = array(
        'name'  => 'nama_kepala_desa',
        'id'    => 'nama_kepala_desa',      
        'class' => 'form-control',
      );

      $this->data['periode_jabatan'] = array(
        'name'  => 'periode_jabatan',
        'id'    => 'periode_jabatan',      
        'class' => 'form-control',
      );

      $this->data['data_desa_css'] = array(
        'name'  => 'nama_desa',
        'id'    => 'nama_desa',
        'class' => 'form-control',
      );

      $this->data['tempat_lahir'] = array(
        'name'  => 'tempat_lahir',
        'id'    => 'tempat_lahir',      
        'class' => 'form-control',
      );

      $this->data['tanggal_lahir'] = array(
        'name'  => 'tanggal_lahir',
        'id'    => 'tanggal_lahir',      
        'class' => 'form-control',
      );

      $this->data['alamat'] = array(
        'name'  => 'alamat',
        'id'    => 'alamat',      
        'class' => 'form-control',
      );

        $this->data['get_combo_data_desa'] = $this->Data_desa_model->get_combo_data_desa(); 
        $this->load->view('back/kepala_desa/kepala_desa_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/kepala_desa'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_kepala_desa'));
    } 
      else 
      {
        $nmfile = nama_seo($this->input->post('nama_kepala_desa'));
        $id['id_kepala_desa'] = $this->input->post('id_kepala_desa'); 
        
        /* Jika file upload diisi */
        if ($_FILES['userfile']['error'] <> 4) 
        {
          // select column yang akan dihapus (gambar) berdasarkan id
          $this->db->select("userfile, userfile_type");
          $this->db->where($id);
          $query = $this->db->get('kepala_desa');
          $row = $query->row();        

          // menyimpan lokasi gambar dalam variable
          $dir = "assets/images/kepala_desa/".$row->userfile.$row->userfile_type;
          $dir_thumb = "assets/images/kepala_desa/".$row->userfile.'_thumb'.$row->userfile_type;

          // Jika ada foto lama, maka hapus foto kemudian upload yang baru
          if($dir)
          {
            $nmfile = nama_seo($this->input->post('nama_kepala_desa'));
            
            // Hapus foto
            unlink($dir);
            unlink($dir_thumb);

            //load uploading file library
            $config['upload_path']      = './assets/images/kepala_desa/';
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
                $config['source_image']   = './assets/images/kepala_desa/'.$userfile['file_name'].''; 
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
                  'nama_kepala_desa'  => $this->input->post('nama_kepala_desa'),
                  'nama_kepala_desa_seo'               => nama_seo($this->input->post('nama_kepala_desa')),
                  'periode_jabatan'  => $this->input->post('periode_jabatan'),
                  'nama_desa'    => $this->input->post('nama_desa'),
                  'tempat_lahir'    => $this->input->post('tempat_lahir'),
                  'tanggal_lahir'    => $this->input->post('tanggal_lahir'),
                  'alamat'    => $this->input->post('alamat'),

                  'userfile'      => $nmfile,
                  'userfile_type' => $userfile['file_ext'],
                  'userfile_size' => $userfile['file_size'],
                  'uploader'       => $this->session->userdata('identity')
                );

                $this->Kepala_desa_model->update($this->input->post('id_kepala_desa'), $data);
                $this->session->set_flashdata('message', 'Edit Data Berhasil');
                redirect(site_url('admin/kepala_desa'));
              }
          }
            // Jika tidak ada foto pada record, maka upload foto baru
            else
            {
              //load uploading file library
              $config['upload_path']      = './assets/images/kepala_desa/';
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
                  $config['source_image']   = './assets/images/kepala_desa/'.$userfile['file_name'].''; 
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
                    'nama_kepala_desa'  => $this->input->post('nama_kepala_desa'),
                    'nama_kepala_desa_seo'               => nama_seo($this->input->post('nama_kepala_desa')),
                    'periode_jabatan'  => $this->input->post('periode_jabatan'),
                    'nama_desa'    => $this->input->post('nama_desa'),
                    'tempat_lahir'    => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'    => $this->input->post('tanggal_lahir'),
                    'alamat'    => $this->input->post('alamat'),
                    'uploader'      => $this->session->userdata('identity'),

                    'userfile'      => $nmfile,
                    'userfile_type' => $userfile['file_ext'],
                    'userfile_size' => $userfile['file_size']
                  );

                  $this->Kepala_desa_model->update($this->input->post('id_kepala_desa'), $data);
                  $this->session->set_flashdata('message', 'Edit Data Berhasil');
                  redirect(site_url('admin/kepala_desa'));
                }
            }
        }
          // Jika file upload kosong
          else 
          {
            $data = array(
              'nama_kepala_desa'  => $this->input->post('nama_kepala_desa'),
              'nama_kepala_desa_seo'               => nama_seo($this->input->post('nama_kepala_desa')),
              'periode_jabatan'  => $this->input->post('periode_jabatan'),
              'nama_desa'  => $this->input->post('nama_desa'),
              'tempat_lahir'  => $this->input->post('tempat_lahir'),
              'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
              'alamat'  => $this->input->post('alamat'),
              'uploader'      => $this->session->userdata('identity')
            );

            $this->Kepala_desa_model->update($this->input->post('id_kepala_desa'), $data);
            $this->session->set_flashdata('message', 'Edit Data Berhasil');
            redirect(site_url('admin/kepala_desa'));
          }
      }  
  }
  
  public function delete($id) 
  {
    $row = $this->Kepala_desa_model->get_by_id($id);

    $this->db->select("userfile, userfile_type");
    $this->db->where($row);
    $query = $this->db->get('kepala_desa');
    $row2 = $query->row();        

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/kepala_desa/".$row2->userfile.$row2->userfile_type;
    $dir_thumb = "assets/images/kepala_desa/".$row2->userfile.'_thumb'.$row2->userfile_type;

    // Jika data ditemukan, maka hapus foto dan record nya
    if ($row) 
    {
      // Hapus foto
      unlink($dir);
      unlink($dir_thumb);

      $this->Kepala_desa_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/kepala_desa'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/kepala_desa'));
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
    $this->form_validation->set_rules('nama_kepala_desa', 'nama_kepala_desa', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_kepala_desa', 'id_kepala_desa', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file kepala_desa.php */
/* Location: ./application/controllers/kepala_desa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */