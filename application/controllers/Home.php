<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {

		/* memanggil model untuk ditampilkan pada masing2 modul*/
		$this->load->model('Berita_model');
		$this->load->model('Featured_model');
		$this->load->model('Kategori_model');
		$this->load->model('vimi_model');
		$this->load->model('data_desa_model');
		$this->load->model('detail_desa_model');
		$this->load->model('itemmenu_data_model');

		/* menyiapkan data yang akan disertakan/ ditampilkan pada view */
		$this->data['page']  = 'Home';
		$this->data['title'] = 'Website Muara Komam';

		/* memanggil function dari masing2 model yang akan digunakan */
		$this->data['data_vimi'] = $this->vimi_model->get_all();
		$this->data['data_itemmenu_data'] = $this->itemmenu_data_model->get_all();
		$this->data['detail_desas'] = $this->detail_desa_model->get_all();

		/* memanggil view yang telah disiapkan dan passing data dari model ke view*/
		$this->load->view('front/home/headerhome');
		$this->load->view('front/navbarhome', $this->data);


		$this->load->view('front/bodyhome', $this->data);
	}

}
