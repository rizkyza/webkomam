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
  <section class="content">
    <div class="box box-primary">
      <div class="box-body table-responsive padding">
        <a href="<?php echo base_url('admin/data_penduduk/create') ?>">
          <button class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Kepala Desa Baru</button>
        </a>

        <h4 align="center"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></h4>

        <hr/>
        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="text-align: center">No.</th>
              <th style="text-align: center">Img</th>
              <th style="text-align: center">N I K</th>
              <th style="text-align: center">Nama</th>
              <th style="text-align: center">Jenis Kelamin</th>
              <th style="text-align: center">Kel / Desa</th>
              <th style="text-align: center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $start = 0; foreach ($data_penduduk_data as $data_penduduk):?>
            <tr>
              <td style="text-align:center"><?php echo ++$start ?></td>
              <td style="text-align:center">
                <?php 
                if(empty($data_penduduk->userfile)) {echo "<img src='".base_url()."assets/images/no_image_thumb.png' width='100'>";}  
                else { echo " <img src='".base_url()."assets/images/data_penduduk/".$data_penduduk->userfile.'_thumb'.$data_penduduk->userfile_type."' width='100'> ";}
                ?>
              </td>
              <td style="text-align:center"><?php echo $data_penduduk->nik ?></td>
              <td style="text-align:center"><?php echo $data_penduduk->nama ?></td>
              <td style="text-align:center"><?php echo $data_penduduk->jenis_kelamin ?></td>
              <td style="text-align:center"><?php echo $data_penduduk->kel_desa ?></td>
              <td style="text-align:center">
              <?php 
              echo anchor(site_url('admin/data_penduduk/update/'.$data_penduduk->id_penduduk),'<i class="glyphicon glyphicon-pencil"></i>','title="Edit", class="btn btn-sm btn-warning"'); echo ' ';
              echo anchor(site_url('admin/data_penduduk/delete/'.$data_penduduk->id_penduduk),'<i class="glyphicon glyphicon-trash"></i>','title="Hapus", class="btn btn-sm btn-danger", onclick="javasciprt: return confirm(\'Apakah Anda yakin ?\')"');  
              ?>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div> 

<!-- DATA TABLES SCRIPT -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
<script type="text/javascript">
function confirmDialog() {
 return confirm('Apakah anda yakin?')
}
  $('#datatable').dataTable({
    "bPaginate": true,
    "bLengthChange": true,
    "bFilter": true,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "aaSorting": [[0,'desc']],
    "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]]
  });
</script>

<?php $this->load->view('back/footer'); ?>      