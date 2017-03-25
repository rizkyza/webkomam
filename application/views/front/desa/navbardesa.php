<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="<?php echo base_url()?>">
                    <h1><div class="service-box">
                        <div class="service-icon">
                        <i class="fa fa-fw fa-star"></i>
                        </div>
                    </h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-left navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url()?>#intro">Home</a></li>
        <li><a href="<?php echo base_url()?>#about">Profil</a></li>
        <li><a href="<?php echo base_url()?>#vimi">Visi dan Misi</a></li>
        <li><a href="<?php echo base_url()?>#struktural">Struktural</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Desa <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <?php
                  foreach ($desa as $val ){ ?>
                    <li><a href="<?php echo base_url("desa/read/$val->nama_desa_seo ")?>"> <?php echo $val->nama_desa ?></a></li>
                <?php } ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <?php
                  foreach ($data_itemmenu_data as $val ){ ?>
                    <li><a href="#"> <?php echo $val->itemmenu ?></a></li>
                <?php } ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fasilitas <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Data 1</a></li>
            <li><a href="#">Data 2</a></li>
            <li><a href="#">Data 3</a></li>
            <li><a href="#">Data 4</a></li>
            <li><a href="#">Data 5</a></li>
          </ul>
        </li>
        <li><a href="<?php echo base_url()?>#news">Berita</a></li>
    <li><a href="<?php echo base_url()?>#galeri">Galeri</a></li>
    <li><a href="<?php echo base_url()?>#cari">Cari</a></li>
    <li><a href="<?php echo base_url()?>#contact">Kontak</a></li>

        <!--<form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
<?php
if (isset($_SESSION['username'])) {
	$nama = $this->session->userdata('nama');
	echo '
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hallo, '.$nama.' <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li>
              <div class="form-group">
                <div class="col-lg-12">Akses keluar dari akun anda. <a href="'.base_url('user/logout').'"><button class="btn btn-skin pull-left" type="submit"><i class="fa fa-sign-out"></i> Logout</button></a></div>
              </div>
            </li>
          </ul>';
} else {
	?>
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login <span class="caret"></span></a>
																<ul class="dropdown-menu" role="menu">
	<?php echo form_open('user/login')?>
	<li>
														<div class="form-group">
														<div class="col-md-12">
	<?php echo form_input(array('name' => 'username', 'class' => 'form-control', 'placeholder' => 'username'));?>
	</div>
														</div>
															<div class="form-group">
																<div class="col-md-12">
	<?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'password'));?>
	</div>
															</div>
															<div class="form-group">
															  <div class="col-md-12">
															      <button class="btn btn-primary pull-left" type="submit"><i class="fa fa-search"></i> Login</button></a>
															  </div>
															</div>
															</li>
	<?php echo form_close()?>
														    <li>
														    <div class="form-group">
															<div class="col-md-12">
															<a href="<?php echo base_url('user/register')?>">
														        <button class="btn btn-success pull-left" type="submit"><i class="fa fa-pencil"></i> Daftar</button>
														    </a>
															</div>
															</div>
															</li>
															   </ul><?php }?>
    </li>
    </ul>

    </div>
  </div>
</nav>
