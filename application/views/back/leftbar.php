<!-- Kolom Sebelah Kiri -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image"><img src="<?php echo base_url()?>assets/images/admin.png" class="img-circle" alt="User Image"/></div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('nama'); ?></p>
        <p>( <?php echo $this->session->userdata('usertype'); ?> )</p>
      </div>
    </div>

    <ul class="sidebar-menu">
      <li class="header">MENU UTAMA</li>
      <li class="treeview">
        <a href="<?php echo base_url('admin/dashboard') ?>">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-newspaper-o'></i><span> Data Berita </span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/berita/create') ?>'><i class='fa fa-circle-o'></i> Tambah Berita </a></li>
          <li><a href='<?php echo base_url('admin/berita') ?>'><i class='fa fa-circle-o'></i> Data Berita </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-cubes'></i><span> Featured Berita</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/featured/create') ?>'><i class='fa fa-circle-o'></i> Tambah Featured </a></li>
          <li><a href='<?php echo base_url('admin/featured') ?>'><i class='fa fa-circle-o'></i> Data Featured </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-tags'></i><span> Kategori Berita</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/kategori/create') ?>'><i class='fa fa-circle-o'></i> Tambah Kategori </a></li>
          <li><a href='<?php echo base_url('admin/kategori') ?>'><i class='fa fa-circle-o'></i> Data Kategori </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-star'></i><span> Visi & Misi</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/vimi') ?>'><i class='fa fa-circle-o'></i> Data visi & Misi </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-tags'></i><span> Kategori Jabatan</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/kategori_jabatan/create') ?>'><i class='fa fa-circle-o'></i> Tambah Kategori Jabatan</a></li>
          <li><a href='<?php echo base_url('admin/kategori_jabatan') ?>'><i class='fa fa-circle-o'></i> Data Kategori Jabatan</a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-user'></i><span> Data Pejabat</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/data_pejabat/create') ?>'><i class='fa fa-circle-o'></i> Tambah Data Pejabat </a></li>
          <li><a href='<?php echo base_url('admin/data_pejabat') ?>'><i class='fa fa-circle-o'></i> Data Pejabat </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-dedent'></i><span> Data Desa</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/data_desa/create') ?>'><i class='fa fa-circle-o'></i> Tambah Data Desa </a></li>
          <li><a href='<?php echo base_url('admin/data_desa') ?>'><i class='fa fa-circle-o'></i> Data Desa </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-user'></i><span> Kepala Desa</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/kepala_desa/create') ?>'><i class='fa fa-circle-o'></i> Tambah Kepala Desa </a></li>
          <li><a href='<?php echo base_url('admin/kepala_desa') ?>'><i class='fa fa-circle-o'></i> Data Kepala Desa </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-institution'></i><span> Detail Desa</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/detail_desa/create') ?>'><i class='fa fa-circle-o'></i> Tambah Detail Desa </a></li>
          <li><a href='<?php echo base_url('admin/detail_desa') ?>'><i class='fa fa-circle-o'></i> Data Detail Desa </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-tags'></i><span> Kategori Sekolah</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/kategori_sekolah/create') ?>'><i class='fa fa-circle-o'></i> Tambah Kategori Sekolah </a></li>
          <li><a href='<?php echo base_url('admin/kategori_sekolah') ?>'><i class='fa fa-circle-o'></i> Data Kategori Sekolah </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-server'></i><span> Data Sekolah</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/data_sekolah/create') ?>'><i class='fa fa-circle-o'></i> Tambah Data Sekolah </a></li>
          <li><a href='<?php echo base_url('admin/data_sekolah') ?>'><i class='fa fa-circle-o'></i> Data Sekolah </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-hospital-o'></i><span> Data Kesehatan</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/data_kesehatan/create') ?>'><i class='fa fa-circle-o'></i> Tambah Data Kesehatan </a></li>
          <li><a href='<?php echo base_url('admin/data_kesehatan') ?>'><i class='fa fa-circle-o'></i> Data Kesehatan </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-user'></i><span> Data Penduduk</span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
        <li><a href='<?php echo base_url('admin/data_penduduk/create') ?>'><i class='fa fa-circle-o'></i> Tambah Data Penduduk </a></li>
          <li><a href='<?php echo base_url('admin/data_penduduk') ?>'><i class='fa fa-circle-o'></i> Data penduduk </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-tags'></i><span> Item Menu Data </span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/itemmenu_data/create') ?>'><i class='fa fa-circle-o'></i> Tambah Itemdata </a></li>
          <li><a href='<?php echo base_url('admin/itemmenu_data') ?>'><i class='fa fa-circle-o'></i> Data Itemdata </a></li>
        </ul>
      </li>
      <li class='treeview'>
        <a href='#'><i class='fa fa-comments'></i><span> Komentar </span><i class='fa fa-angle-left pull-right'></i></a>
        <ul class='treeview-menu'>
          <li><a href='<?php echo base_url('admin/komentar/pending') ?>'><i class='fa fa-circle-o'></i> Komentar Pending </a></li>
          <li><a href='<?php echo base_url('admin/komentar') ?>'><i class='fa fa-circle-o'></i> Data Komentar </a></li>
        </ul>
      </li>
      <li class="header">SETTING</li>
      <li class='treeview'>
        <a href='<?php $user_id = $this->session->userdata('user_id'); echo base_url('admin/auth/edit_user/'.$user_id.'') ?>'>
          <i class='fa fa-edit'></i><span> Edit Profil </span>
        </a>
      </li>

      <?php if ($this->ion_auth->is_superadmin()): ?>
        <li class='treeview'>
          <a href='#'><i class='fa fa-male'></i><span> User </span><i class='fa fa-angle-left pull-right'></i></a>
          <ul class='treeview-menu'>
            <li><a href='<?php echo base_url() ?>admin/auth/create_user'><i class='fa fa-circle-o'></i> Tambah User</a></li>
            <li><a href='<?php echo base_url() ?>admin/auth/user'><i class='fa fa-circle-o'></i> Data User</a></li>
          </ul>
        </li>
        <li class='treeview'>
          <a href='#'><i class='fa fa-users'></i><span> Group </span><i class='fa fa-angle-left pull-right'></i></a>
          <ul class='treeview-menu'>
            <li><a href='<?php echo base_url() ?>admin/auth/create_group'><i class='fa fa-circle-o'></i> Tambah Group</a></li>
            <li><a href='<?php echo base_url() ?>admin/auth/users_group'><i class='fa fa-circle-o'></i> Data Group</a></li>
          </ul>
        </li>
      <?php endif ?>
      <li> <a href='<?php echo base_url() ?>admin/auth/logout'> <i class="fa fa-sign-out"></i> <span>Logout</span> </a> </li>
    </ul>

  </section>
</aside>
