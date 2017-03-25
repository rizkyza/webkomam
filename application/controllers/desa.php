<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller {

	function __construct() {
		parent::__construct();
		/* memanggil model untuk ditampilkan pada masing2 modul */
		$this->load->model('Detail_desa_model');
		$this->load->model('Data_sekolah_model');
		$this->load->model('Data_kesehatan_model');
		$this->load->model('data_desa_model');
		$this->load->model('itemmenu_data_model');
		$this->load->model('detail_desa_model');

		/* memanggil function dari masing2 model yang akan digunakan */
		$this->data['get_all_sekolah']   = $this->Data_sekolah_model->get_all();
		$this->data['get_all_kesehatan'] = $this->Data_kesehatan_model->get_all();
		$this->data['data_desas'] = $this->data_desa_model->get_all();
		$this->data['data_itemmenu_data'] = $this->itemmenu_data_model->get_all();
		$this->data['detail_desas'] = $this->detail_desa_model->get_all();




	}

	public function read($id) {
		/* menyiapkan data yang akan disertakan/ ditampilkan pada view */
		$this->data['title'] = "Website Muara Komam";

			/* memanggil function dari masing2 model yang akan digunakan */
			$this->data['desa']         = $this->Detail_desa_model->get_by_id($id);

			/* memanggil view yang telah disiapkan dan passing data dari model ke view*/
			$this->load->view('front/desa/body', $this->data);
	}

}
