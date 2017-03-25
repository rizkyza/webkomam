<?php
$this->load->view('front/desa/headerdesa', $this->data);
$this->load->view('front/desa/navbardesa', $this->data);
 ?>

	  	<!-- Section: intro-->
	    <section id="intro" class="intro">
	    <div class="slogan">
				<h2><span class="text_color">KABUPATEN PASER</span> </h2>
				<h4>KECAMATAN MUARA KOMAM</h4>
			</div>
			<div class="page-scroll">
				<a href="#contact" class="btn btn-circle">
					<i class="fa fa-angle-double-down animated"></i>
				</a>
			</div>
		</section>
		<!-- /Section: intro -->

		<!-- Section: profil pejabat daerah-->
	    <section id="sambutan" class="home-section text-center bg-gray">
			<div class="heading-about">
				<div class="container">
				<div class="row">
	            <div class="col-md-12">
					<div class="wow fadeInLeft" data-wow-delay="0.2s">
	                <div class="service-box">
							<div class="service-icon">
	                            <i class="fa fa-fw fa-user"></i>
						</div>
						</div>
						<div class="service-desc">
							<!--<embed src="./assets/ouv/desa.svg" width="80" height="80" type="image/svg+xml"/> -->
							<h5>Sambutan Camat</h5>
							<p><i>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias sit asperiores quae delectus dolor inventore, aliquid minima quod consequuntur dignissimos sint eveniet repudiandae odit ad, vitae a, incidunt ea eligendi."</i></p>
							<p><b>Syaifuddin Zuhri,S.sos</b></p>
						</div>
	                </div>
					</div>
	            </div>
	        </div>

			</div>
			</div>
	    </section>


		<!-- Section: galeri -->
	    <section id="galeri" class="home-section text-center">

			<div class="heading-about">
				<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="wow bounceInDown" data-wow-delay="0.4s">
						<div class="section-heading">
						<h2>Galeri Kami</h2>
						<i class="fa fa-2x fa-angle-down"></i>

						</div>
						</div>
					</div>
				</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
						<ol class="breadcrumb">
						  <li><a href="<?php echo base_url()?>">Home</a></li>
						  <li><a href="#">Desa</a></li>
						  <li class="active"><?php echo $desa->nama_desa ?></li>
						</ol>

						<div class="row">
							<div class="col-md-8">
								<div class="bs-callout bs-callout-primary"> <h4><i class="fa fa-pencil"></i> <?php echo $desa->nama_desa?></h4> </div>
								<div class="row">
								  <div class="col-md-12">
								    <div class="thumbnail">
					<?php
					if (empty($desa->userfile)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' width='400' height='200'>";} else {echo " <img src='".base_url()."assets/images/desa/".$desa->userfile.$desa->userfile_type."' alt='$desa->userfile' title='$desa->userfile'> ";}
					?>

								      <p><?php echo $desa->penjelasan_desa?></p>
								    </div>
								  </div>
								</div>

								<hr>

							</div>
						</div>


	    	</div>
			</div>
		</section>
		<!-- /Section: galeri -->

		<?php
		$this->load->view('front/desa/footerdesa', $this->data);
		?>
