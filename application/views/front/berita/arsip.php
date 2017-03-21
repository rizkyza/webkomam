<?php $this->load->view('front/home/header');?>

<?php $this->load->view('front/navbar');?>
<div class="container">
	<ol class="breadcrumb">
	  <li><a href="<?php echo base_url()?>">Home</a></li>
	  <li><a href="#">Berita</a></li>
	  <li class="active">Arsip</li>
	</ol>

	<div class="row">
		<div class="col-md-8">
<?php echo $this->session->userdata('message') <> ''?$this->session->userdata('message'):'';?>
<?php $this->form_validation->set_message('cek_captcha', '%s yang anda input salah!');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger alert">', '</div>'); ?>
<div class="bs-callout bs-callout-primary"> <h4><i class="fa fa-book"></i> Arsip Berita</h4> </div>

			<div class="row">
<?php
foreach ($arsip as $berita_arsip) {
	$caption = character_limiter($berita_arsip->isi_berita, 150);
	?>
	<div class="col-sm-6 col-md-6">
						    <div class="thumbnail">
	<?php
	if (empty($berita_arsip->userfile)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' width='400' height='200'>";} else {echo " <img src='".base_url()."assets/images/berita/".$berita_arsip->userfile.'_thumb'.$berita_arsip->userfile_type."'> ";}
	?>
						      <div align="right">
							      <span class="label label-success"><i class="fa fa-tag"></i> <?php echo $berita_arsip->kategori?></span>
							      <span class="label label-warning"><i class="fa fa-user"></i> <?php echo $berita_arsip->author?></span>
							      <span class="label label-info"><i class="fa fa-clock-o"></i> <?php echo $berita_arsip->time_upload?></span>
								  </div>
						      <div class="caption">
						        <h4><a href="<?php echo base_url("berita/read/$berita_arsip->judul_seo ")?>"><?php echo $berita_arsip->judul_berita?></a></h4>
	<?php echo $caption?>
						      </div>
						      <p align="right">
						        <a href="<?php echo base_url("berita/read/$berita_arsip->judul_seo ")?>">
						          <button type="button" class="btn-sm btn-primary">
						            Selengkapnya <i class="fa fa-arrow-circle-right"></i>
						          </button>
						        </a>
						      </p>
						    </div>
						  </div>
	<?php }?>

			</div>

			<div align="center"><?php echo $this->pagination->create_links()?></div>

			<hr>
		</div>

<?php $this->load->view('front/sidebar');?>

<?php $this->load->view('front/footer');?>