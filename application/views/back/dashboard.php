<?php $this->load->view('back/head'); ?>
<?php $this->load->view('back/header'); ?>
<?php $this->load->view('back/leftbar'); ?>

<div class="content-wrapper">
  <div class="box-body">
    <div class="callout callout-success "><i class='fa fa-bullhorn'></i> Selamat Datang, <b><?php echo $this->session->userdata('nama') ?></b>
    </div>
  </div>

  <section class='content'>
  <div class="box box-solid bg-blue-gradient">
            <div class="box-header">
              <i class="fa fa-tasks"></i>

              <h3 class="box-title">Shortcut Panel</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                <button type="button" class="btn btn-success bg-blue btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                </div>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body no-padding">
              <!--The calendar -->
              <div id="calendar" style="width: 100%"></div>

            <!-- /.box-body -->
            <div class="box-footer text-black">


    <div class='row'>
      <div class='col-lg-6 col-xs-6'>
        <div class='small-box bg-yellow'>
          <div class='inner'><h3> <?php echo $total_berita ?> </h3><p>Berita</p></div>
          <div class='icon'><i class='fa fa-newspaper-o'></i></div>
          <a href='<?php echo base_url('admin/berita') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
        <div class='small-box bg-red'>
          <div class='inner'><h3> <?php echo $total_featured ?> </h3><p>Featured</p></div>
          <div class='icon'><i class='fa fa-cubes'></i></div>
          <a href='<?php echo base_url('admin/featured') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
        <div class='small-box bg-blue'>
          <div class='inner'><h3> <?php echo $total_kategori ?> </h3><p>Kategori</p></div>
          <div class='icon'><i class='fa fa-tags'></i></div>
          <a href='<?php echo base_url('admin/kategori') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
        <div class='small-box bg-green'>
          <div class='inner'><h3> <?php echo $total_vimi ?> </h3><p>Visi dan Misi</p></div>
          <div class='icon'><i class='fa fa-star'></i></div>
          <a href='<?php echo base_url('admin/Vimi') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
      </div>

      <div class='col-lg-6 col-xs-6'>
        <div class='small-box bg-purple'>
          <div class='inner'><h3> <?php echo $total_komen ?> </h3><p>Total Komentar</p></div>
          <div class='icon'><i class='fa fa-comments'></i></div>
          <a href='<?php echo base_url('admin/komentar') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
        <div class='small-box bg-aqua'>
          <div class='inner'><h3> <?php echo $total_komen_pending ?> </h3><p>Komentar Baru</p></div>
          <div class='icon'><i class='fa fa-comment'></i></div>
          <a href='<?php echo base_url('admin/komentar/pending') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
        <div class='small-box bg-gray'>
          <div class='inner'><h3> <?php echo $total_user ?> </h3><p>User</p></div>
          <div class='icon'><i class='fa fa-male'></i></div>
          <a href='<?php echo base_url('admin/auth/user') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
        <div class='small-box bg-orange'>
          <div class='inner'><h3> <?php echo $total_data_pejabat ?> </h3><p>Data Pejabat</p></div>
          <div class='icon'><i class='fa fa-user'></i></div>
          <a href='<?php echo base_url('admin/data_pejabat') ?>' class='small-box-footer'>Selengkapnya <i class='fa fa-arrow-circle-right'></i></a>
        </div>
      </div>
    </div>
    </div>
          </div>
          <!-- /.box -->
  </section>
</div>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<?php $this->load->view('back/footer'); ?>
