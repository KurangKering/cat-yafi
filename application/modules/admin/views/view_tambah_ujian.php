 <div class="row">

  <div class="col-md-8 col-md-offset-2">


 <?php if (!empty($errors)) { ?>
   <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php foreach ($errors as $ind_error => $error_): ?>
      <span><?php echo $error_ ?></span><br>
    <?php endforeach ?>
  </div>
<?php } ?>
    <div class="box box-info">

      <form class="form-horizontal" method="POST">
        <input type="hidden" name="soal_soal" value="<?php echo $id_soals; ?>">
        <div class="box-body">

          <div class="form-group">
            <label for="inputPassword3" class="col-sm-4 control-label">Tahun</label>

            <div class="col-sm-4">
             <input type="text" name="tahun" value="<?php echo set_value('tahun') ?>" class="form-control">
           </div>
           


         </div>
         <div class="form-group">
          <?php $arr = array('1' => 'I', '2' => 'II', '3' => 'III'); ?>
          <label for="inputPassword3" class="col-sm-4 control-label">Gelombang</label>
          <div class="col-sm-4">
           <select class="form-control" name="gelombang">
            <?php foreach ($arr as $k => $v): ?>
              <?php $selected = ''; ?>
            <?php if ($k == set_value('gelombang')) {
              $selected = 'selected';
            } ?>
              <option <?php echo $selected ?> value="<?php echo $k ?>"><?php echo $v; ?></option>
            <?php endforeach ?>
            
           </select>
         </div>



       </div>
       <div class="form-group">

         <label for="inputPassword3" class="col-sm-4 control-label">Durasi Ujian (menit)</label>
         <div class="col-sm-4">
           <input type="number" name="durasi" value="<?php echo set_value('durasi') ?>" class="form-control">
         </div>


       </div>
       <div class="form-group">

         <label for="inputPassword3" class="col-sm-4 control-label">Jumlah Soal</label>
         <div class="col-sm-4">
           <input type="text"  readonly name="jumlah_soal" value="<?php echo $jumlah_soal; ?>" class="form-control">
         </div>




       </div>

     </div>
     <!-- /.box-body -->
     <div class="box-footer">
      <button type="button" onclick="location.href='<?php echo site_url('admin/kelola_ujian'); ?>';" class="btn btn-default">Cancel</button>
      <button type="submit" class="btn btn-info pull-right">Mulai</button>
    </div>
    <!-- /.box-footer -->
  </form>
</form>
</div>


</div>
<div class="clearfix">

</div>

</div>

<script type="text/javascript">
  
   </script>