 <div class="row">

  <div class="col-md-12">

    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-xs-2">
            <a href="<?php echo site_url('admin/tambah_soal'); ?>" class="btn btn-primary">Tambah Soal</a>
          </div>

          <div class="col-xs-4">

            <input type="text" name="kunci" class="form-control" placeholder="Masukkan Kata Kunci Disini">


          </div>
          
          <div class="col-xs-3">
            <select class="form-control" name="id_pel">
              <option  value="all">--semua pelajaran--</option>
              <?php foreach ($pelajarans as $ind_pelajaran => $pelajaran_): ?>
                <option value="<?php echo $pelajaran_['id']; ?>"><?php echo $pelajaran_['nama']; ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="col-xs-2">
            <select class="form-control" name="status">
              <option  value="all">--semua status--</option>
              <option  value="1">active</option>
              <option  value="0">inactive</option>
            </select>
          </div>
          <div class="col-xs-1">
            <button class="btn btn-primary" id="btn-go">Go!</button>
          </div>
        </div>
      </div>
    </div>

    <div class="box">
      <div class="box-header">






      </div>
      <!-- /.box-header -->

      <div class="box-body no-padding">


        <table class="table" nowrap>

          <thead>
            <tr>
              <th class="text-center" style="width: 5%">#</th>
              <th class="text-center" style="width: 50%">Soal</th>
              <th style="width: 20%">Pelajaran</th>
              <th style="width: 5%" class="text-center">Status</th>
              <th  style="width: 15%" class="text-center" >Action</th>
            </tr>
          </thead>

          <tbody>
            <?php if ($soals !== false): ?>

              <?php $num = isset($_GET['offset']) && $_GET['offset'] != false ? $_GET['offset'] + 1: '1'; ?>
              <?php foreach ($soals as $ind_soal => $soal_): ?>
                <tr>
                  <td class="text-center"><?php echo $num++; ?></td>
                  <td><?php echo $soal_['soal'] ; ?></td>
                  <td><?php echo ($soal_['pelajaran']->nama)   ?></td>
                  <td class="text-center"><?php echo ($soal_['active']) === '1' ? 'active' : 'inactive';   ?></td>
                  <td class="text-center"><a href="<?php echo site_url('admin/ubah_soal/' . $soal_['id']);?>" class="btn btn-warning btn-sm">Ubah</a> </td>
                </tr>
              <?php endforeach ?>


            <?php endif ?>
          </tbody>


        </table>
        <div class="box-footer clearfix">
          <div class="pull-left">
            <span> Total Soal : <?php echo isset($totalSoal) && $totalSoal != FALSE ? $totalSoal : 0 ;?></span>,
            <span> Active : <?php echo isset($soalsActive) && $soalsActive != FALSE ? $soalsActive : 0 ;?></span>,
            <span> Inactive : <?php echo isset($soalsInActive) && $soalsInActive != FALSE ? $soalsInActive : 0 ;?></span>

          </div>
          <?php echo $this->pagination->create_links(); ?>


        </div>
      </div>

    </div>

  </div>
  <div class="clearfix">

  </div>

</div>

<script type="text/javascript">
 var id_pel = "<?php echo isset($id_pel) ? $id_pel : ''; ?>";
 var status = "<?php echo isset($status) ? $status : ''; ?>";
 var keyword = "<?php echo isset($keyword) ? $keyword : ''; ?>";
 $("select[name='id_pel'").val(id_pel).change();
 $("select[name='status'").val(status).change();
 $("input[name='kunci'").val(keyword).change();
 $(function() {
  $('#btn-go').click(function() {
    var pelajaran = $("select[name='id_pel']").val();
    var status = $("select[name='status']").val();
    var kunci = $("input[name='kunci']").val();
    if ( kunci != '') 
    {
      kunci = "&kunci=" + kunci;
    }

    window.location.href = "<?php echo site_url('admin/kelola_soal'); ?>" + "?id_pel=" + pelajaran + "&status=" + status + kunci;
  });



});
</script>