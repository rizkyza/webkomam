<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function index(){
		$this->load->model('Berita_model');
  	    $this->load->model('Kategori_model');
  	    $this->load->model('Vimi_model');
  	    $this->load->model('Kategori_jabatan_model');
  	    $this->load->model('Data_pejabat_model');
  	    $this->load->model('Komentar_model');
  	    $this->load->model('Data_desa_model');
  	    $this->load->model('Kepala_desa_model');
  	    $this->load->model('Detail_desa_model');
  	    $this->load->model('Kategori_sekolah_model');
  	    $this->load->model('Data_penduduk_model');
  	    $this->load->model('Data_kesehatan_model');
  	    $this->load->model('Featured_model');
  	    $this->load->model('Ion_auth_model');

    /* cek status login */
		if (!$this->ion_auth->logged_in()){
			// apabila belum login maka diarahkan ke halaman login
			redirect('admin/auth/login', 'refresh');
		}
		elseif($this->ion_auth->is_user()){
			// apabila belum login maka diarahkan ke halaman login
			redirect('admin/auth/login', 'refresh');
		}
		else{
			$this->data = array(
	      'title' 							=> 'Dashboard',
	      'button' 							=> 'Tambah',
		    'total_berita' 					=> $this->Berita_model->total_rows(),
		    'total_user' 					=> $this->Ion_auth_model->total_rows(),
		    'total_komen' 					=> $this->Komentar_model->get_total_row_kategori(),
		    'total_komen_pending' 			=> $this->Komentar_model->get_total_row_kategori_pending(),
		    'total_featured' 				=> $this->Featured_model->total_rows(),
		    'total_kategori' 				=> $this->Kategori_model->total_rows(),
		    'total_data_desa' 				=> $this->Data_desa_model->total_rows(),
		    'total_kepala_desa' 			=> $this->Kepala_desa_model->total_rows(),
		    'total_detail_desa' 			=> $this->Detail_desa_model->total_rows(),
		    'total_kategori_sekolah' 		=> $this->Kategori_sekolah_model->total_rows(),
		    'total_data_penduduk'	 		=> $this->Data_penduduk_model->total_rows(),
		    'total_data_penduduk'	 		=> $this->Data_kesehatan_model->total_rows(),
		    'total_vimi' 					=> $this->Vimi_model->total_rows(),
		    'total_kategori_jabatan' 		=> $this->Kategori_jabatan_model->total_rows(),
		    'total_data_pejabat' 			=> $this->Data_pejabat_model->total_rows()
			);

			$this->load->view('back/dashboard',$this->data);
		}
	}
	
}
