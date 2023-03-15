 <div class="col-md-12">
  <div class="box">
    <div class="box-header">

      <div class="box-title">
        <a href="<?php echo site_url('admin/tambah_pelajaran'); ?>" class="btn btn-primary">Tambah Pelajaran</a>

      </div>
      <div class="box-tools">



      </div>
    </div>
    <!-- /.box-header -->

  </style>
  <div class="box-body no-padding">
    <table class="table" nowrap>

      <thead>
        <tr>
          <th class="text-center" style="width: 5%">#</th>
          <th style="width: 65%">Nama Pelajaran</th>
          <th style="width: 10%" class="text-center">Jumlah Soal</th>
          <th  style="width: 15%" class="text-center" >Action</th>
        </tr>
      </thead>

      <tbody>
      	<?php if ($pelajarans != ''): ?>
      		
        <?php $num = $this->uri->segment(3) != false ? $this->uri->segment(3) + 1: '1'; ?>
        <?php foreach ($pelajarans as $ind_pelajaran => $pelajaran_): ?>
          <tr>
            <td class="text-center"><?php echo $num++; ?></td>
            <td><?php echo $pelajaran_['nama'] ?></td>
            <td class="text-center"><?php echo isset ($pelajaran_['soals']) ? $pelajaran_['soals'][0]->counted_rows : '0'; ?></td>
            <td class="text-center"><a href="<?php echo site_url('admin/ubah_pelajaran/' . $pelajaran_['id']);?>" class="btn btn-warning btn-sm">Ubah</a> <a href="<?php echo site_url('admin/hapus_pelajaran/' . $pelajaran_['id']);?>"  class="btn btn-danger btn-sm">Hapus</a></td>
          </tr>
        <?php endforeach ?>
      
      	<?php endif ?>
      </tbody>


    </table>
    <div class="box-footer clearfix">
      <?php echo $this->pagination->create_links(); ?>

      <!-- <ul class="pagination pagination-sm no-margin pull-right">
        <li><a href="#">&laquo;</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">&raquo;</a></li>
      </ul> -->
    </div>
  </div>
</div>
</div>
<div class="clearfix">
  
</div>