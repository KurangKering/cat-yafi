 <div class="col-md-12">
  <div class="box">
    <div class="box-header">

      <div class="box-title">
        <a href="<?php echo site_url('admin/tambah_ujian'); ?>" class="btn btn-primary">Tambah Ujian Baru</a>

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
          <th style="width: 10%">Tahun/Gelombang</th>
          <th style="width: 10%" class="text-center">Durasi Ujian</th>
          <th  style="width: 15%" class="text-center" >Jumlah Peserta</th>
          <th  style="width: 15%" class="text-center" >Token</th>
        </tr>
      </thead>

      <tbody>
        <?php $num = $this->uri->segment(3) != false ? $this->uri->segment(3) + 1: '1'; ?>
        <?php if (isset($ujians)): ?>
           <?php foreach ($ujians as $ind_ujian => $ujian_): ?>
          <tr>
            <td class="text-center"><?php echo $num++; ?></td>
            <td class="text-center"><a href="<?php echo site_url('admin/daftar_nilai/' . $ujian_['tahun'] . '/' . $ujian_['gelombang']);?>" class=""><?php echo $ujian_['tahun'] . '/' . $ujian_['gelombang'] ?> </a></td>
            <td class="text-center"><?php echo $ujian_['durasi'] !== FALSE ? $ujian_['durasi'] . ' Menit' : '0' ?></td>
            <td class="text-center"><?php echo $ujian_['jumlah_peserta'] !== FALSE ? $ujian_['jumlah_peserta'] . ' Orang' : '0'?></td>
            <td class="text-center"><?php echo $ujian_['token'] ?></td>
           
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