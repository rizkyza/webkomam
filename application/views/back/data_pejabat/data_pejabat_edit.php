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
                <div class="col-xs-6"><label>Nama</label>
                  <?php echo form_input($nama, $data_pejabat->nama);?>
                </div>
                <div class="col-xs-6"><label>Jabatan</label>
                  <?php echo form_dropdown('',$get_combo_kategori_jabatan,$data_pejabat->jabatan,$kategori_jabatan_css);?>
                </div>
              </div><br>
              <div class="row">
                <div class="col-xs-6"><label>Tempat Lahir</label>
                  <?php echo form_input($tempat_lahir, $data_pejabat->tempat_lahir);?>
                </div>
                <div class="col-xs-6"><label>Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <?php echo form_input($tanggal_lahir, $data_pejabat->tanggal_lahir);?>
                  </div>
                </div>
              </div><br>
              <div class="form-group"><label>Periode Jabatan</label>
                <?php echo form_input($periode_jabatan, $data_pejabat->periode_jabatan);?>
              </div>
              <div class="form-group"><label>Alamat</label>
                <?php echo form_input($alamat, $data_pejabat->alamat);?>
              </div>
              <div class="form-group"><label>Alamat Kantor</label>
                <?php echo form_input($alamat_kantor, $data_pejabat->alamat_kantor);?>
              </div><br>
              <div class="form-group"><label>Tugas dan Wewenang</label>
                <?php echo form_textarea($tugas_wewenang, $data_pejabat->tugas_wewenang);?>
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
              
              <div class="form-group"><label>Kewajiban dalam Tugas dan Wewenang</label>
                <?php echo form_textarea($kewajiban, $data_pejabat->kewajiban);?>
              </div><br>
              <div class="form-group"><label>Gambar Sebelumnya</label><br>
                <img src="<?php echo base_url('assets/images/data_pejabat/'.$data_pejabat->userfile.$data_pejabat->userfile_type.'') ?>" width="200px"/>
              </div>
              <div class="form-group"><label>Gambar Baru</label>
                <input type="file" class="form-control" name="userfile" id="userfile" onchange="tampilkanPreview(this,'preview')"/>
                <p>Maksimal besar ukuran gambar 2Mb.</p>
                <br><p><b>Preview Gambar</b></p><br>
                <img id="preview" src="" alt="" width="350px"/>
              </div>
            </div>
          </div>
          <?php echo form_input($id_pejabat,$data_pejabat->id_pejabat);?>
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
    CKEDITOR.replace('tugas_wewenang');
    CKEDITOR.replace('kewajiban');
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