<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class data_penduduk extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Data_penduduk_model');
    $this->load->model('Data_desa_model');

    $this->data['module'] = 'Data Penduduk';    

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
    $this->data['title'] = "Data Penduduk";
    
    $this->data['data_penduduk_data'] = $this->Data_penduduk_model->get_all();
    $this->load->view('back/data_penduduk/data_penduduk_list', $this->data);
  }

  public function create() 
  {
    $this->data['title']          = 'Tambah Data Penduduk';
    $this->data['action']         = site_url('admin/data_penduduk/create_action');
    $this->data['button_submit']  = 'Submit';
    $this->data['button_reset']   = 'Reset';

    $this->data['id_penduduk'] = array(
      'name'  => 'id_penduduk',
      'id'    => 'id_penduduk',
      'type'  => 'hidden',
    );

    $this->data['nik'] = array(
      'name'  => 'nik',
      'id'    => 'nik',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nik'),
    );

    $this->data['nama'] = array(
      'name'  => 'nama',
      'id'    => 'nama',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('nama'),
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

    $this->data['options_jenis_kelamin'] = array(
      'Laki-laki'    => 'Laki-laki',
      'Perempuan' => 'Perempuan',
    ); 

    $this->data['jenis_kelamin'] = array(
      'name'  => 'jenis_kelamin',
      'id'    => 'jenis_kelamin',
      'type'  => 'text',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('jenis_kelamin'),
    );

    $this->data['options_gol_darah'] = array(
      'A'    => 'A',
      'B' => 'B',
      'AB' => 'AB',
      'O' => 'O',
    );

    $this->data['gol_darah'] = array(
      'name'  => 'gol_darah',
      'id'    => 'gol_darah',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('gol_darah'),
    );

    $this->data['alamat'] = array(
      'name'  => 'alamat',
      'id'    => 'alamat',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('alamat'),
    );

    $this->data['kel_desa'] = array(
      'name'  => 'kel_desa',
      'id'    => 'kel_desa',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('kel_desa'),
    );

    $this->data['kecamatan'] = array(
      'name'  => 'kecamatan',
      'id'    => 'kecamatan',
      'value' => 'Muara Komam',
      'class' => 'form-control',
    );

    $this->data['options_agama'] = array(
      'Islam'    => 'Islam',
      'Katolik' => 'Katolik',
      'Protestan' => 'Protestan',
      'Hindu' => 'Hindu',
      'Budha' => 'Budha',
    );

    $this->data['agama'] = array(
      'name'  => 'agama',
      'id'    => 'agama',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('agama'),
    );

    $this->data['options_status'] = array(
      'Lajang'    => 'Lajang',
      'Menikah' => 'Menikah',
      'Duda' => 'Duda',
      'Janda' => 'Janda',
    );

    $this->data['status_perkawinan'] = array(
      'name'  => 'status_perkawinan',
      'id'    => 'status_perkawinan',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('status_perkawinan'),
    );

    $this->data['options_pekerjaan'] = array(
      'Pelajar'    => 'Pelajar',
      'Mahasiswa' => 'Mahasiswa',
      'PNS' => 'PNS',
      'Polisi' => 'Polisi',
      'TNI' => 'TNI',
      'Swasta' => 'Swasta',
    );

    $this->data['pekerjaan'] = array(
      'name'  => 'pekerjaan',
      'id'    => 'pekerjaan',
      'class' => 'form-control',
      'value' => $this->form_validation->set_value('pekerjaan'),
    );

    $this->data['kewarganegaraan'] = array(
      'name'  => 'kewarganegaraan',
      'id'    => 'kewarganegaraan',
      'class' => 'form-control',
      'value' => 'Indonesia',
    );

    $this->data['get_combo_data_desa'] = $this->Data_desa_model->get_combo_data_desa(); 
    $this->load->view('back/data_penduduk/data_penduduk_add', $this->data);
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
          $nmfile = nama_seo($this->input->post('nik'));

          /* memanggil library upload ci */
          $config['upload_path']      = './assets/images/data_penduduk/';
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
              $config['source_image']   = './assets/images/data_penduduk/'.$userfile['file_name'].''; 
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
                'nik'              => $this->input->post('nik'),
                'nik_seo'          => nama_seo($this->input->post('nik')),
                'nama'       => $this->input->post('nama'),
                'tempat_lahir'        => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                'gol_darah'        => $this->input->post('gol_darah'),
                'alamat'        => $this->input->post('alamat'),
                'kel_desa'        => $this->input->post('kel_desa'),
                'kecamatan'        => $this->input->post('kecamatan'),
                'agama'        => $this->input->post('agama'),
                'status_perkawinan'        => $this->input->post('status_perkawinan'),
                'pekerjaan'        => $this->input->post('pekerjaan'),
                'kewarganegaraan'        => $this->input->post('kewarganegaraan'),
                'userfile'               => $nmfile,
                'userfile_type'          => $userfile['file_ext'],
                'userfile_size'          => $userfile['file_size'],
                'uploader'               => $this->session->userdata('identity')
              );

              // eksekusi query INSERT
              $this->Data_penduduk_model->insert($data);
              // set pesan data berhasil dibuat
              $this->session->set_flashdata('message', 'Data berhasil dibuat');
              redirect(site_url('admin/data_penduduk'));
            }
        }
        else // Jika file upload kosong
        {
          $data = array(
                'nik'              => $this->input->post('nik'),
                'nik_seo'          => nama_seo($this->input->post('nik')),
                'nama'       => $this->input->post('nama'),
                'tempat_lahir'        => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                'gol_darah'        => $this->input->post('gol_darah'),
                'alamat'        => $this->input->post('alamat'),
                'kel_desa'        => $this->input->post('kel_desa'),
                'kecamatan'        => $this->input->post('kecamatan'),
                'agama'        => $this->input->post('agama'),
                'status_perkawinan'        => $this->input->post('status_perkawinan'),
                'pekerjaan'        => $this->input->post('pekerjaan'),
                'kewarganegaraan'        => $this->input->post('kewarganegaraan'),
                'uploader'               => $this->session->userdata('identity')
          );

          // eksekusi query INSERT
          $this->Data_penduduk_model->insert($data);
          // set pesan data berhasil dibuat
          $this->session->set_flashdata('message', 'Data berhasil dibuat');
          redirect(site_url('admin/data_penduduk'));
        }
      }  
  }
  
  public function update($id) 
  {
    $row = $this->Data_penduduk_model->get_by_id($id);
    $this->data['data_penduduk'] = $this->Data_penduduk_model->get_by_id($id);

    if ($row) 
    {
      $this->data['title']          = 'Update Data Penduduk';
      $this->data['action']         = site_url('admin/data_penduduk/update_action');
      $this->data['button_submit']  = 'Update';
      $this->data['button_reset']   = 'Reset';

      $this->data['id_penduduk'] = array(
      'name'  => 'id_penduduk',
      'id'    => 'id_penduduk',
      'type'  => 'hidden',
      );

      $this->data['nik'] = array(
        'name'  => 'nik',
        'id'    => 'nik',
        'class' => 'form-control',
        'readonly' => 'true',
      );

      $this->data['nama'] = array(
        'name'  => 'nama',
        'id'    => 'nama',      
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

      $this->data['options_jenis_kelamin'] = array(
        'Laki-laki'    => 'Laki-laki',
        'Perempuan' => 'Perempuan',
      );

      $this->data['jenis_kelamin'] = array(
        'name'  => 'jenis_kelamin',
        'id'    => 'jenis_kelamin',      
        'class' => 'form-control',
      );

      $this->data['options_gol_darah'] = array(
        'A'    => 'A',
        'B' => 'B',
        'AB' => 'AB',
        'O' => 'O',
      );

      $this->data['gol_darah'] = array(
        'name'  => 'gol_darah',
        'id'    => 'gol_darah',      
        'class' => 'form-control',
      );

      $this->data['alamat'] = array(
        'name'  => 'alamat',
        'id'    => 'alamat',      
        'class' => 'form-control',
      );

      $this->data['data_desa_css'] = array(
        'name'  => 'kel_desa',
        'id'    => 'kel_desa',
        'class' => 'form-control',
      );

      $this->data['kecamatan'] = array(
        'name'  => 'kecamatan',
        'id'    => 'kecamatan',      
        'class' => 'form-control',
      );

      $this->data['options_agama'] = array(
        'Islam'    => 'Islam',
        'Katolik' => 'Katolik',
        'Protestan' => 'Protestan',
        'Hindu' => 'Hindu',
        'Budha' => 'Budha',
      );

      $this->data['agama'] = array(
        'name'  => 'agama',
        'id'    => 'agama',      
        'class' => 'form-control',
      );

      $this->data['options_status'] = array(
        'Lajang'    => 'Lajang',
        'Menikah' => 'Menikah',
        'Duda' => 'Duda',
        'Janda' => 'Janda',
      );

      $this->data['status_perkawinan'] = array(
        'name'  => 'status_perkawinan',
        'id'    => 'status_perkawinan',      
        'class' => 'form-control',
      );

      $this->data['options_pekerjaan'] = array(
        'Pelajar'    => 'Pelajar',
        'Mahasiswa' => 'Mahasiswa',
        'PNS' => 'PNS',
        'Polisi' => 'Polisi',
        'TNI' => 'TNI',
        'Swasta' => 'Swasta',
      );

      $this->data['pekerjaan'] = array(
        'name'  => 'pekerjaan',
        'id'    => 'pekerjaan',      
        'class' => 'form-control',
      );

      $this->data['kewarganegaraan'] = array(
        'name'  => 'kewarganegaraan',
        'id'    => 'kewarganegaraan',      
        'class' => 'form-control',
      );

        $this->data['get_combo_data_desa'] = $this->Data_desa_model->get_combo_data_desa(); 
        $this->load->view('back/data_penduduk/data_penduduk_edit', $this->data);
    } 
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/data_penduduk'));
      }
  }
  
  public function update_action() 
  {
    $this->load->helper('nama_seo_helper');
    $this->_rulesupdate();

    if ($this->form_validation->run() == FALSE) 
    {
      $this->update($this->input->post('id_penduduk'));
      $this->update($this->input->post('nik'));
    } 
      else 
      {
        $nmfile = nama_seo($this->input->post('nik'));
        $id['id_penduduk'] = $this->input->post('id_penduduk'); 
        
        /* Jika file upload diisi */
        if ($_FILES['userfile']['error'] <> 4) 
        {
          // select column yang akan dihapus (gambar) berdasarkan id
          $this->db->select("userfile, userfile_type");
          $this->db->where($id);
          $query = $this->db->get('data_penduduk');
          $row = $query->row();        

          // menyimpan lokasi gambar dalam variable
          $dir = "assets/images/data_penduduk/".$row->userfile.$row->userfile_type;
          $dir_thumb = "assets/images/data_penduduk/".$row->userfile.'_thumb'.$row->userfile_type;

          // Jika ada foto lama, maka hapus foto kemudian upload yang baru
          if($dir)
          {
            $nmfile = nama_seo($this->input->post('nik'));
            
            // Hapus foto
            unlink($dir);
            unlink($dir_thumb);

            //load uploading file library
            $config['upload_path']      = './assets/images/data_penduduk/';
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
                $config['source_image']   = './assets/images/data_penduduk/'.$userfile['file_name'].''; 
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
                  'nik'              => $this->input->post('nik'),
                  'nik_seo'          => nama_seo($this->input->post('nik')),
                  'nama'       => $this->input->post('nama'),
                  'tempat_lahir'        => $this->input->post('tempat_lahir'),
                  'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                  'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                  'gol_darah'        => $this->input->post('gol_darah'),
                  'alamat'        => $this->input->post('alamat'),
                  'kel_desa'        => $this->input->post('kel_desa'),
                  'kecamatan'        => $this->input->post('kecamatan'),
                  'agama'        => $this->input->post('agama'),
                  'status_perkawinan'        => $this->input->post('status_perkawinan'),
                  'pekerjaan'        => $this->input->post('pekerjaan'),
                  'kewarganegaraan'        => $this->input->post('kewarganegaraan'),

                  'userfile'      => $nmfile,
                  'userfile_type' => $userfile['file_ext'],
                  'userfile_size' => $userfile['file_size'],
                  'uploader'       => $this->session->userdata('identity')
                );

                $this->Data_penduduk_model->update($this->input->post('id_penduduk'), $data);
                $this->session->set_flashdata('message', 'Edit Data Berhasil');
                redirect(site_url('admin/data_penduduk'));
              }
          }
            // Jika tidak ada foto pada record, maka upload foto baru
            else
            {
              //load uploading file library
              $config['upload_path']      = './assets/images/data_penduduk/';
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
                  $config['source_image']   = './assets/images/data_penduduk/'.$userfile['file_name'].''; 
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
                    'nik'              => $this->input->post('nik'),
                    'nik_seo'          => nama_seo($this->input->post('nik')),
                    'nama'       => $this->input->post('nama'),
                    'tempat_lahir'        => $this->input->post('tempat_lahir'),
                    'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                    'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                    'gol_darah'        => $this->input->post('gol_darah'),
                    'alamat'        => $this->input->post('alamat'),
                    'kel_desa'        => $this->input->post('kel_desa'),
                    'kecamatan'        => $this->input->post('kecamatan'),
                    'agama'        => $this->input->post('agama'),
                    'status_perkawinan'        => $this->input->post('status_perkawinan'),
                    'pekerjaan'        => $this->input->post('pekerjaan'),
                    'kewarganegaraan'        => $this->input->post('kewarganegaraan'),
                    'uploader'               => $this->session->userdata('identity'),

                    'userfile'      => $nmfile,
                    'userfile_type' => $userfile['file_ext'],
                    'userfile_size' => $userfile['file_size']
                  );

                  $this->Data_penduduk_model->update($this->input->post('id_penduduk'), $data);
                  $this->session->set_flashdata('message', 'Edit Data Berhasil');
                  redirect(site_url('admin/data_penduduk'));
                }
            }
        }
          // Jika file upload kosong
          else 
          {
            $data = array(
                'nik'              => $this->input->post('nik'),
                'nik_seo'          => nama_seo($this->input->post('nik')),
                'nama'       => $this->input->post('nama'),
                'tempat_lahir'        => $this->input->post('tempat_lahir'),
                'tanggal_lahir'        => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'        => $this->input->post('jenis_kelamin'),
                'gol_darah'        => $this->input->post('gol_darah'),
                'alamat'        => $this->input->post('alamat'),
                'kel_desa'        => $this->input->post('kel_desa'),
                'kecamatan'        => $this->input->post('kecamatan'),
                'agama'        => $this->input->post('agama'),
                'status_perkawinan'        => $this->input->post('status_perkawinan'),
                'pekerjaan'        => $this->input->post('pekerjaan'),
                'kewarganegaraan'        => $this->input->post('kewarganegaraan'),
                'uploader'               => $this->session->userdata('identity')
            );

            $this->Data_penduduk_model->update($this->input->post('id_penduduk'), $data);
            $this->session->set_flashdata('message', 'Edit Data Berhasil');
            redirect(site_url('admin/data_penduduk'));
          }
      }  
  }
  
  public function delete($id) 
  {
    $row = $this->Data_penduduk_model->get_by_id($id);

    $this->db->select("userfile, userfile_type");
    $this->db->where($row);
    $query = $this->db->get('data_penduduk');
    $row2 = $query->row();        

    // menyimpan lokasi gambar dalam variable
    $dir = "assets/images/data_penduduk/".$row2->userfile.$row2->userfile_type;
    $dir_thumb = "assets/images/data_penduduk/".$row2->userfile.'_thumb'.$row2->userfile_type;

    // Jika data ditemukan, maka hapus foto dan record nya
    if ($row) 
    {
      // Hapus foto
      unlink($dir);
      unlink($dir_thumb);

      $this->Data_penduduk_model->delete($id);
      $this->session->set_flashdata('message', 'Data berhasil dihapus');
      redirect(site_url('admin/data_penduduk'));
    } 
      // Jika data tidak ada
      else 
      {
        $this->session->set_flashdata('message', 'Data tidak ditemukan');
        redirect(site_url('admin/data_penduduk'));
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

    $this->form_validation->set_rules('nik', 'nik', 'trim|required|is_unique[data_penduduk.nik]');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('is_unique', 'Data {field} sudah ada');
    
    $this->form_validation->set_rules('id_penduduk', 'id_penduduk', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

    public function _rulesupdate() 
  {

    $this->form_validation->set_rules('nik', 'nik', 'trim|required');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');

    // set pesan form validasi error
    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('is_unique', 'Data {field} sudah ada');
    
    $this->form_validation->set_rules('id_penduduk', 'id_penduduk', 'trim');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>');
  }

}

/* End of file data_penduduk.php */
/* Location: ./application/controllers/data_penduduk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-10-17 02:19:21 */
/* http://harviacode.com */