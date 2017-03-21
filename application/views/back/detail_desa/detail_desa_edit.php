<?php $this->load->view('back/head'); ?>
<?php $this->load->view('back/header'); ?>
<?php $this->load->view('back/leftbar'); ?>      

<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $title ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><?php echo $module ?></li>
      <li class="active"><a href="<?php echo current_url() ?>"><?php echo $title ?></a></li>
    </ol>
  </section>
  <section class='content'>
    <div class='row'>    
      <?php echo form_open_multipart($action);?>
        <div class="col-md-12"> <?php echo validation_errors() ?> </div> 
        <!-- kolom kiri -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <div class="row">
                <div class="col-xs-6"><label>Nama Desa</label>
                <?php echo form_dropdown('',$get_combo_data_desa,$detail_desa->nama_desa,$data_desa_css);?>
                </div>
                <div class="col-xs-6"><label>Nama Kepala Desa</label>
                  <?php echo form_input($nama_kepala_desa, $detail_desa->nama_kepala_desa);?>
                </div>
              </div><br>
              <div class="form-group"><label>Penjelasan Desa</label>
                <?php echo form_textarea($penjelasan_desa, $detail_desa->penjelasan_desa);?>
              </div>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          <!-- left column -->
        
        <!-- right column -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <div class="row">
              </div>
              <div class="form-group"><label>Gambar Desa Sebelumnya</label><br>
                <img src="<?php echo base_url('assets/images/desa/'.$detail_desa->userfile.$detail_desa->userfile_type.'') ?>" width="200px"/>
              </div>
              <div class="form-group"><label>Gambar Desa Baru</label>
                <input type="file" class="form-control" name="userfile" id="userfile" onchange="tampilkanPreview(this,'preview')"/>
                <p>Maksimal besar ukuran gambar 2Mb.</p>
                <br><p><b>Preview Gambar Desa</b></p><br>
                <img id="preview" src="" alt="" width="350px"/>
              </div>
            </div>
          </div>
          <?php echo form_input($id_detail_desa,$detail_desa->id_detail_desa);?>
          <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
              <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
            </div>
        </div>
        <!-- right column -->
      <?php echo form_close(); ?>
    </div>
  </section>
</div>

<!-- Select2 -->
<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2({


      });
    });
</script>
<!-- end Select2 -->

<!-- CK Editor -->
<script src="<?php echo base_url() ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('penjelasan_desa');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
<!-- end ckeditor -->

<!-- Datepicker -->
    <script src="<?php echo base_url() ?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>

<script>
  $(function () {
    $('#tanggal_lahir').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
});
</script>
<!-- End Datepicker -->

<!-- upload gambar -->
<script type="text/javascript">
function tampilkanPreview(userfile,idpreview)
{ //membuat objek gambar
  var gb = userfile.files;
  //loop untuk merender gambar
  for (var i = 0; i < gb.length; i++)
  { //bikin variabel
    var gbPreview = gb[i];
    var imageType = /image.*/;
    var preview=document.getElementById(idpreview);            
    var reader = new FileReader();
    if (gbPreview.type.match(imageType)) 
    { //jika tipe data sesuai
      preview.file = gbPreview;
      reader.onload = (function(element) 
      {
        return function(e) 
        {
          element.src = e.target.result;
        };
      })(preview);
      //membaca data URL gambar
      reader.readAsDataURL(gbPreview);
    }
      else
      { //jika tipe data tidak sesuai
        alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
      }
  }    
}
</script>
<!-- end upload gambar -->

<?php $this->load->view('back/footer'); ?>      