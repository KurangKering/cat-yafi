 <div class="col-md-8 col-md-offset-2">



  <div class="box">
    <div class="box-header">


      <div class="box-tools">



      </div>
    </div>
    <!-- /.box-header -->

  <form class="form-horizontal" method="POST">
    <input type="hidden" name="id" value="<?php echo $pelajaran['id']; ?>">
    <div class="box-body">
      <div class="form-group">
        <label for="nama" class="col-sm-4 control-label">Nama Pelajaran Lama</label>

        <div class="col-sm-8">
          <input type="text"  class="form-control" readonly="" value="<?php echo $pelajaran['nama']; ?>" >
        </div>
      </div>
      <div class="form-group">
        <label for="nama" class="col-sm-4 control-label">Nama Pelajaran Baru</label>

        <div class="col-sm-8">
          <input type="text"  class="form-control" value="<?php echo set_value('nama'); ?>" name="nama" id="nama">
        </div>
      </div>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="button" onclick="location.href='<?php echo site_url('admin/kelola_pelajaran');?>';" class="btn btn-default">Batal</button>
      <button type="submit" class="btn btn-info pull-right">Ubah</button>
    </div>

    <!-- /.box-footer -->
  </form>
  <!-- /.box-body -->
</div>
<?php if (!empty($errors)) { ?>
 <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <?php foreach ($errors as $ind_error => $error_): ?>
    <span><?php echo $error_ ?></span><br>
  <?php endforeach ?>
</div>
<?php } ?>
</div>
          <!-- /.box -->