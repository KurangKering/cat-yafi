 <div class="row">

  <div class="col-md-12">



    <div class="box box-info">

      <form class="form-horizontal" method="POST">
        <input type="hidden" name="id" value="<?php echo $soal['id']; ?>">
        <div class="box-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pelajaran</label>

            <div class="col-sm-10">
              <select name="id_pelajaran" class="form-control">
                <?php if (isset($pelajarans)): ?>
                  <?php foreach ($pelajarans as $ind_pelajaran => $pelajaran_): ?>
                    <?php $selected = ''; ?>
                    <?php if ($soal['id_pelajaran'] === $pelajaran_['id']): ?>
                     <?php $selected = 'selected'; ?>
                    <?php endif ?>
                    <option <?php echo $selected; ?> value="<?php echo $pelajaran_['id']; ?>"><?php echo $pelajaran_['nama']; ?></option>
                  <?php endforeach ?>
                <?php endif ?>

              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Soal</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="soal"><?php echo $soal['soal'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan A</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_A"><?php echo $soal['pilihan_A'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan B</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_B"><?php echo $soal['pilihan_B'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan C</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_C"><?php echo $soal['pilihan_C'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan D</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_D"><?php echo $soal['pilihan_D'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan E</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_E"><?php echo $soal['pilihan_E'] ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Jawaban</label>
            <?php $pil = array('A', 'B', 'C', 'D', 'E'); ?>
            <div class="col-sm-10">
             <select name="jawaban" class="form-control">
              <?php foreach ($pil as $ind_p => $p): ?>
                <?php $sel = ''; ?>
                <?php if ($soal['jawaban'] === $p): ?>
                  <?php $sel = 'selected'; ?>
                <?php endif ?>
                <option <?php echo $sel; ?> value="<?php echo $p; ?>"><?php echo $p; ?></option>
              <?php endforeach ?>
             </select>
           </div>
         </div>
         <div class="form-group">
          <div class="col-sm-2">
            
          </div>
          <div class="col-sm-10">
             <label>
            <input type="radio" value="1" name="active" class="flat-red" <?php echo $soal['active'] === '1'  ? 'checked' : '';?>>
            Active
          </label>
          <label>
            <input type="radio" value="0" name="active" class="flat-red" <?php echo $soal['active'] === '0'  ? 'checked' : '';?>>
            Inactive
          </label>
          
          </div>
         
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="button" onclick="location.href='<?php echo site_url('admin/kelola_soal'); ?>';" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-info pull-right">Sign in</button>
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
  $(function() {
    CKEDITOR.replace('soal');
    CKEDITOR.replace('pilihan_A');
    CKEDITOR.replace('pilihan_B');
    CKEDITOR.replace('pilihan_C');
    CKEDITOR.replace('pilihan_D');
    CKEDITOR.replace('pilihan_E');

       //Flat red color scheme for iCheck
       $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      })
     });
   </script>