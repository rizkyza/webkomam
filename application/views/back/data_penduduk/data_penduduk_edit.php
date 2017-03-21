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
              <div class="row"></div>
                <div class="form-group"><label>N I K</label>
                  <?php echo form_input($nik, $data_penduduk->nik);?>
                </div>
                <div class="form-group"><label>Nama</label>
                  <?php echo form_input($nama, $data_penduduk->nama);?>
                </div>
                <div class="form-group"><label>Tempat Lahir</label>
                  <?php echo form_input($tempat_lahir, $data_penduduk->tempat_lahir);?>
                </div>
              <div class="form-group"><label>Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php echo form_input($tanggal_lahir, $data_penduduk->tanggal_lahir);?>
                  </div>
              </div>
              <div class="form-group"><label>Jenis Kelamin</label>
                  <?php echo form_dropdown('',$options_jenis_kelamin,$data_penduduk->jenis_kelamin,$jenis_kelamin);?>
                </div>
                <div class="form-group"><label>Golongan Darah</label>
                  <?php echo form_dropdown('',$options_gol_darah,$data_penduduk->gol_darah,$gol_darah);?>
                </div>
                <div class="form-group"><label>Alamat</label>
                <?php echo form_textarea($alamat, $data_penduduk->alamat);?>
              </div>
                <div class="form-group"><label>Kelurahan / Desa</label>
                <?php echo form_dropdown('',$get_combo_data_desa,$data_penduduk->kel_desa,$data_desa_css);?>
                </div>
                <div class="form-group"><label>Kecamatan</label>
                <?php echo form_input($kecamatan, $data_penduduk->kecamatan);?>
              </div>
              <div class="form-group"><label>Agama</label>
                <?php echo form_dropdown('',$options_agama,$data_penduduk->agama,$agama);?>
              </div>
              <div class="form-group"><label>Status</label>
                <?php echo form_dropdown('',$options_status,$data_penduduk->status_perkawinan,$status_perkawinan);?>
              </div>
              <div class="form-group"><label>Pekerjaan</label>
                <?php echo form_dropdown('',$options_pekerjaan,$data_penduduk->pekerjaan,$pekerjaan);?>
              </div>
              <div class="form-group"><label>Kewarganegaraan</label>
                <?php echo form_input($kewarganegaraan, $data_penduduk->kewarganegaraan);?>
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
              <div class="form-group"><label>Foto Sebelumnya</label><br>
                <img src="<?php echo base_url('assets/images/data_penduduk/'.$data_penduduk->userfile.$data_penduduk->userfile_type.'') ?>" width="200px"/>
              </div>
              <div class="form-group"><label>Foto Baru</label>
                <input type="file" class="form-control" name="userfile" id="userfile" onchange="tampilkanPreview(this,'preview')"/>
                <p>Maksimal besar ukuran gambar 2Mb.</p>
                <br><p><b>Preview Foto</b><br>
                <img id="preview" src="" alt="" width="350px"/>
              </div>
            </div>
          </div>
          <?php echo form_input($id_penduduk,$data_penduduk->id_penduduk);?>
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
    CKEDITOR.replace('alamat');
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