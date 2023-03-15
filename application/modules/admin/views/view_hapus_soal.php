 <div class="row">

  <div class="col-md-12">



    <div class="box box-info">

      <form class="form-horizontal" method="POST">
        <div class="box-body">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Pelajaran</label>

            <div class="col-sm-10">
              
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Soal</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="soal"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan A</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_A"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan B</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_B"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan C</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_C"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan D</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_D"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">pilihan E</label>

            <div class="col-sm-10">
              <textarea class="form-control" name="pilihan_E"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Jawaban</label>

            <div class="col-sm-10">
             <select name="jawaban" class="form-control">
               <option value="A">A</option>
               <option value="B">B</option>
               <option value="C">C</option>
               <option value="D">D</option>
               <option value="E">E</option>
             </select>
           </div>
         </div>
         <div class="form-group">
          <div class="col-sm-2">
            
          </div>
          <div class="col-sm-10">
             <label>
            <input type="radio" value="1" name="active" class="flat-red" checked>
            Active
          </label>
          <label>
            <input type="radio" value="0" name="active" class="flat-red">
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