<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class data_pejabat extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('data_pejabat_model');
    $this->load->model('Kategori_jabatan_model');

    $this->data['module'] = 'Data Pejabat';    

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
    $this->data['title'] = "Data Pejabat";
    
    $this->data['data_pejabat_data'] = $this->data_pejabat_model->get_all();
    $this->load->view('back/data_pejabat/data_pejabat_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Data Pejabat Baru';
    $this->data['action']         = site_url('admin/data_pejabat/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_pejabat'] = array(
      'name'  => 'id_pejabat',
      'id'    => 'id_pejabat',
      'type'  => 'hidden',
    );

    $this->data['nama'] = array(
      'name'  => 'nama',
      'id'    => 'nama',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama'),
    );

    $this->data['jabatan'] = array(
      'name'  => 'jabatan',
      'id'    => 'jabatan',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('jabatan'),
    );

    $this->data['tempat_lahir'] = array(
      'name'  => 'tempat_lahir',
      'id'    => 'tempat_lahir',    
      'type'  => 'text',   
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('tempat_lahir'),
    );

    $this->data['tanggal_lahir'] = array(
      'name'  => 'tanggal_lahir',
      'id'    => 'tanggal_lahir',
      'type'  => 'date',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('tanggal_lahir'),
    );

    $this->data['alamat'] = array(
      'name'  => 'alamat',
      'id'    => 'alamat',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('alamat'),
    );

    $this->data['alamat_kantor'] = array(
      'name'  => 'alamat_kantor',
      'id'    => 'alamat_kantor',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('alamat_kantor'),
    );

    $this->data['periode_jabatan'] = array(
      'name'  => 'periode_jabatan',
      'id'    => 'periode_jabatan',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('periode_jabatan'),
    );

    $this->data['tugas_wewenang'] = array(
      'name'  => 'tugas_wewenang',
      'id'    => 'tugas_wewenang',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('tugas_wewenang'),
    );

    $this->data['kewajiban'] = array(
      'name'  => 'kewajiban',
      'id'    => 'kewajiban',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('kewajiban'),
    );

    $this->data['get_combo_kategori_jabatan'] = $this->Kategori_jabatan_model->get_combo_kategori_jabatan(); 
    $this->load->view('back/data_pejabat/data_pejabat_add', $this->data);
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
          $nmfile = nama_seo($this->input->post('nama'));

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/images/data_pejabat/';
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
              $config['source_image']   = './assets/images/data_pejabat/'.$userfile['file_name'].''; 
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
                'nama'                   => $this->input->post('nama'),
                'nama_seo'               => nama_seo($this->input->post('nama')),
                'jabatan'                => $this->input->post('jabatan'),
                'tempat_lahir'           => $this->input->post('tempat_lahir'),
                'tanggal_lahir'          => $this->input->post('tanggal_lahir'),
                'alamat'                 => $this->input->post('alamat'),
                'alamat_kantor'          => $this->input->post('alamat_kantor'),
                'periode_jabatan'        => $this->input->post('periode_jabatan'),
                'tugas_wewenang'         => $this->input->post('tugas_wewenang'),
                'kewajiban'              => $this->input->post('kewajiban'),
                'userfile'               => $nmfile,
                'userfile_type'          => $userfile['file_ext'],
                'userfile_size'          => $userfile['file_size'],
                'uploader'               => $this->session->userdata('identity')
              );

              // eksekusi query INSERT
              $this->data_pejabat_model->insert($data);
              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat');
              redirect(site_url('admin/data_pejabat'));
            }
        }
        else // Jika file upload kosong
        {
          $data = array(
                'nama'                  => $this->input->post('nama'),
                'nama_seo'               => nama_seo($this->input->post('nama')),
                'jabatan'               => $this->input->post('jabatan'),
                'tempat_lahir'          => $this->input->post('tempat_lahir'),
                'tanggal_lahir'         => $this->input->post('tanggal_lahir'),
                'alamat'                => $this->input->post('alamat'),
                'alamat_kantor'         => $this->input->post('alamat_kantor'),
                'periode_jabatan'       => $this->input->post('periode_jabatan'),
                'tugas_wewenang'        => $this->input->post('tugas_wewenang'),
                'kewajiban'             => $this->input->post('kewajiban'),
                'uploader'              => $this->session->userdata('identity')
          );

          // eksekusi query INSERT
          $this->data_pejabat_model->insert($data);
          // set pesan data berhasil dibuat
          $this->session->set_flashdata('message', 'Data berhasil dibuat');
          redirect(site_url('admin/data_pejabat'));
        }
      }  
  }
  
  public function update($id) 
  {
    $row = $this->data_pejabat_model->get_by_id($id);
    $this->data['data_pejabat'] = $this->data_pejabat_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Data Dejabat';
      $this->data['action']         = site_url('admin/data_pejabat/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_pejabat'] = array(
        'name'  => 'id_pejabat',
        'id'    => 'id_pejabat',
        'type'=> 'hidden',
      );

      $this->data['nama'] = array(
        'name'  => 'nama',
        'id'    => 'nama',
        'class' => 'form-control',
      );

      $this->data['kategori_jabatan_css'] = array(
        'name'  => 'jabatan',
        'id'    => 'jabatan',
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
        'type'  => 'date',
        'class' => 'form-control',
      );

      $this->data['alamat'] = array(
        'name'  => 'alamat',
        'id'    => 'alamat',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['alamat_kantor'] = array(
        'name'  => 'alamat_kantor',
        'id'    => 'alamat_kantor',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['periode_jabatan'] = array(
        'name'  => 'periode_jabatan',
        'id'    => 'periode_jabatan',
        'type'  => 'text',
        'class' => 'form-control',
      );

      $this->data['tugas_wewenang'] = array(
        'name'  => 'tugas_wewenang',
        'id'    => 'tugas_wewenang',
        'class' => 'form-control',
      );

      $this->data['kewajiban'] = array(
        'name'  => 'kewajiban',
        'id'    => 'kewajiban',
        'class' => 'form-control',
      );


        $this->data['get_combo_kategori_jabatan'] = $this->Kategori_jabatan_model->get_combo_kategori_jabatan(); 
        $this->load->view('back/data_pejabat/data_pejabat_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/data_pejabat'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rules();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_pejabat'));
    } 
      else 
      {
        $nmfile = nama_seo($this->input->post('nama'));
        $id['id_pejabat'] = $this->input->post('id_pejabat'); 
        
        /* Jika file upload diisi */
        if ($_FILES['userfile']['error'] <> 4) 
        {
          // select column yang akan dihapus (gambar) berdasarkan id
          $this->db->select("userfile, userfile_type");
          $this->db->where($id);
          $query = $this->db->get('data_pejabat');
          $row = $query->row();        

          // menyimpan lokasi gambar dalam variable
          $dir = "assets/images/data_pejabat/".$row->userfile.$row->userfile_type;
          $dir_thumb = "assets/images/data_pejabat/".$row->userfile.'_thumb'.$row->userfile_type;

          // Jika ada foto lama, maka hapus foto kemudian upload yang baru
          if($dir)
          {
            $nmfile = nama_seo($this->input->post('nama'));
            
            // Hapus foto
            unlink($dir);
            unlink($dir_thumb);

            //load uploading file library
            $config['upload_path']      = './assets/images/data_pejabat/';
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
                $config['source_image']   = './assets/images/data_pejabat/'.$userfile['file_name'].''; 
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
                  'nama'  => $this->input->post('nama'),
                  'nama_seo'               => nama_seo($this->input->post('nama')),
                  'jabatan'  => $this->input->post('jabatan'),
                  'tempat_lahir'    => $this->input->post('tempat_lahir'),
                  'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
                  'alamat'        => $this->input->post('alamat'),
                  'alamat_kantor'       => $this->input->post('alamat_kantor'),
                  'periode_jabatan'        => $this->input->post('periode_jabatan'),
                  'tugas_wewenang'        => $this->input->post('tugas_wewenang'),
                  'kewajiban'        => $this->input->post('kewajiban'),
                  'uploader'      => $this->session->userdata('identity'),

                  'userfile'      => $nmfile,
                  'userfile_type' => $userfile['file_ext'],
                  'userfile_size' => $userfile['file_size'],
                  'updater'       => $this->session->userdata('identity')
                );

                $this->data_pejabat_model->update($this->input->post('id_pejabat'), $data);
                $this->session->set_flashdata('message', 'Edit Data Berhasil');
                redirect(site_url('admin/data_pejabat'));
              }
          }
            // Jika tidak ada foto pada record, maka upload foto baru
            else
            {
              //load uploading file library
              $config['upload_path']      = './assets/images/data_pejabat/';
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
                  $config['source_image']   = './assets/images/data_pejabat/'.$userfile['file_name'].''; 
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
                    'nama'  => $this->input->post('nama'),
                    'nama_seo'               => nama_seo($this->input->post('nama')),
                    'jabatan'  => $this->input->post('jabatan'),
                    'tempat_lahir'    => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
                    'alamat'        => $this->input->post('alamat'),
                    'alamat_kantor'       => $this->input->post('alamat_kantor'),
                    'periode_jabatan'        => $this->input->post('periode_jabatan'),
                    'tugas_wewenang'        => $this->input->post('tugas_wewenang'),
                    'kewajiban'        => $this->input->post('kewajiban'),
                    'uploader'      => $this->session->userdata('identity'),

                    'userfile'      => $nmfile,
                    'userfile_type' => $userfile['file_ext'],
                    'userfile_size' => $userfile['file_size'],
                    'time_update'   => date('Y-m-d'),
                    'updater'      => $this->session->userdata('identity')
                  );

                  $this->data_pejabat_model->update($this->input->post('id_pejabat'), $data);
                  $this->session->set_flashdata('message', 'Edit Data Berhasil');
                  redirect(site_url('admin/data_pejabat'));
                }
            }
        }
          // Jika file upload kosong
          else 
          {
            $data = array(
              'nama'  => $this->input->post('nama'),
              'nama_seo'               => nama_seo($this->input->post('nama')),
              'jabatan'  => $this->input->post('jabatan'),
              'tempat_lahir'    => $this->input->post('tempat_lahir'),
              'tanggal_lahir'      => $this->input->post('tanggal_lahir'),
              'alamat'        => $this->input->post('alamat'),
              'alamat_kantor'       => $this->input->post('alamat_kantor'),
              'periode_jabatan'        => $this->input->post('periode_jabatan'),
              'tugas_wewenang'        => $this->input->post('tugas_wewenang'),
              'kewajiban'        => $this->input->post('kewajiban'),
              'uploader'      => $this->session->userdata('identity')
            );

            $this->data_pejabat_model->update($this->input->post('id_pejabat'), $data);
            $this->session->set_flashdata('message', 'Edit Data Berhasil');
            redirect(site_url('admin/data_pejabat'));
          }
      }  
  }
  
  public function delete($id) 
  {
    $row = $this->data_pejabat_model->get_by_id($id);

    $this->db->select("userfile, userfile_type");
    $this->db->where($row);
    $query = $this->db->get('data_pejabat');
    $row2 = $query->row();        

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/data_pejabat/".$row2->userfile.$row2->userfile_type;
    $dir_thumb = "assets/images/data_pejabat/".$row2->userfile.'_thumb'.$row2->userfile_type;

    // Jika data ditemukan, maka hapus foto dan record nya
    if ($row) 
    {
      // Hapus foto
      unlink($dir);
      unlink($dir_thumb);

      $this->data_pejabat_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/data_pejabat'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/data_pejabat'));
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
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');

    $this->form_validation->set_rules('id_pejabat', 'id_pejabat', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file data_pejabat.php */
/* Location: ./application/controllers/data_pejabat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */