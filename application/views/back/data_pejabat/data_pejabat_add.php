<?php $this->load->view('back/head'); ?>
<?php $this->load->view('back/header'); ?>
<?php $this->load->view('back/leftbar'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $title ?></h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                  <?php echo form_input($nama);?>
                </div>
                <div class="col-xs-6"><label>Jabatan</label>
                  <?php echo form_dropdown('', $get_combo_kategori_jabatan, '', $jabatan); ?>
                </div>
              </div><br>
              <div class="row">
                <div class="col-xs-6"><label>Tempat Lahir</label>
                  <?php echo form_input($tempat_lahir);?>
                </div>

                <div class="col-xs-6"><label>Tanggal Lahir</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php echo form_input($tanggal_lahir);?>
                </div>
                </div>

              </div><br>
              <div class="form-group"><label>Periode Jabatan</label>
                <?php echo form_input($periode_jabatan); ?>
              </div>
              <div class="form-group"><label>Alamat</label>
                <?php echo form_input($alamat);?>
              </div>
              <div class="form-group"><label>Alamat Kantor</label>
                <?php echo form_input($alamat_kantor);?>
              </div><br>
              <div class="form-group"><label>Tugas dan Wewenang</label>
                <?php echo form_textarea($tugas_wewenang);?>
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
                <?php echo form_textarea($kewajiban);?>
              </div>
              <div class="form-group"><label>Gambar</label>
                <input type="file" class="form-control" name="userfile" id="userfile" onchange="tampilkanPreview(this,'preview')"/> 
                <p>Maksimal besar ukuran gambar 2Mb.</p>
                <br><p><b>Preview Gambar</b></p><br> 
                <img id="preview" src="" alt="" width="350px"/>
              </div>
            </div>
          </div>
          <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-success"><?php echo $button_submit ?></button>
              <button type="reset" name="reset" class="btn btn-danger"><?php echo $button_reset ?></button>
            </div>
        </div>
        <!-- right column -->
      <?php echo form_close(); ?>
    </div>
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

<!-- CKeditor -->
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
<!-- end CKeditor -->

<!-- Datepicker -->
<script src="<?php echo base_url() ?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/datepicker/locales/bootstrap-datepicker.id.min.js"charset="UTF-8"></script>

<script>
  $(function () {
    $('#tanggal_lahir').datepicker({
      format: "yyyy-mm-dd",
      language: 'id',
      startView: 2,
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
