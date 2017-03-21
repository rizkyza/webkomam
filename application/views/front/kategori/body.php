<?php $this->load->view('front/home/header'); ?>

<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<ol class="breadcrumb">
	  <li><a href="<?php echo base_url() ?>">Home</a></li>
	  <li><a href="#">Kategori</a></li>
	  <li class="active"><?php echo ucfirst($this->uri->segment(3)); ?></li>
	</ol>
	<div class="row">
		<div class="col-md-8">
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
			<?php $this->load->view('front/home/featured')?>
			
			<div class="bs-callout bs-callout-primary"> 
				<h4><i class="fa fa-tags"></i> 
					Kategori: 
					<?php echo $this->uri->segment(3); ?>
				</h4> 
			</div>

			<div class="row">
			  <?php
			  if($kategori->result() == NULL)
				{
					echo "<p align='center'>Belum ada data</p>";
				}
				else
				{
				  foreach ($kategori->result() as $hasil)
				  {
				    $caption = character_limiter($hasil->isi_berita,150);
			  ?>
			  <div class="col-sm-6 col-md-6">
			    <div class="thumbnail">
			      <?php 
			      if(empty($hasil->userfile)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' width='400' height='200'>";}  
			      else { echo " <img src='".base_url()."assets/images/berita/".$hasil->userfile.'_thumb'.$hasil->userfile_type."'> ";}
			      ?>
			      <div align="right">
				      <span class="label label-success"><i class="fa fa-tag"></i> <?php echo $hasil->kategori ?></span>
				      <span class="label label-warning"><i class="fa fa-user"></i> <?php echo $hasil->author ?></span>
				      <span class="label label-info"><i class="fa fa-clock-o"></i> <?php echo $hasil->time_upload ?></span>
			      </div>
			      <div class="caption">
			        <h4><a href="<?php echo base_url("berita/read/$hasil->judul_seo ") ?>"><?php echo $hasil->judul_berita ?></a></h4>
			        <?php echo $caption ?> 
			      </div>
			      <p align="right">
			        <a href="<?php echo base_url("berita/read/$hasil->judul_seo ") ?>">
			          <button type="button" class="btn-sm btn-primary">
			            Selengkapnya <i class="fa fa-arrow-circle-right"></i>
			          </button>
			        </a>
			      </p>
			    </div>
			  </div>
			  <?php }} ?>

			</div>

			<hr>
		</div>

		<?php $this->load->view('front/sidebar'); ?>

<?php $this->load->view('front/footer'); ?>