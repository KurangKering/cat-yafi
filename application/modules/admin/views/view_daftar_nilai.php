 <div class="row">

   <div class="col-md-12">
    <div class="box">
      <div class="box-header">

        <div class="box-title">
          <a id="link-cetak" class="btn btn-primary">Print</a>

        </div>
        <div class="box-tools">
          <div class="row">
            <div class="col-xs-5">
              <select class="form-control" name="tahun">
                <option  value="all">--semua tahun--</option>
                <?php foreach ($tahuns as $ind_tahuns => $tahun_): ?>
                  <?php $sellll = ''; ?>
                  <?php if ($tahun_ == (isset($tahun) ? $tahun : '' )): ?>
                    <?php $sellll = 'selected'; ?>
                  <?php endif ?>

                  <option <?php echo $sellll; ?> value="<?php echo $tahun_; ?>"><?php echo $tahun_; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <?php $gel = array('1', '2', '3') ?>
            <div class="col-xs-5">
              <select class="form-control" name="gelombang">
                <option  value="all">--semua gelombang--</option>
                <?php foreach ($gel as $k_g => $g): ?>
                  <?php $sel = ''; ?>
                  <?php if ($g == (isset($gelombang) ? $gelombang : '' )): ?>
                    <?php $sel = 'selected'; ?>
                  <?php endif ?>
                  <option <?php echo $sel; ?> value="<?php echo $g ?>"><?php echo $g; ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-xs-2">
              <button class="btn btn-primary" id="btn-go">Go!</button>
            </div>
          </div>
        </div>



      </div>
      <div>

      </div>

      <div class="box-body">
        <table class="table" nowrap id="table-daftar-nilai">

          <thead>
            <tr>
              <th class="text-center" style="width: 5%">#</th>
              <th style="width: 65%">Nama Peserta</th>

              <th style="width: 65%">No Peserta</th>
              <th style="width: 65%">Tahun/Gelombang</th>
              <th style="width: 10%" class="text-center">Nilai</th>
            </tr>
          </thead>

          <tbody></tbody>


        </table>
        <div class="box-footer clearfix">
          <?php //echo $this->pagination->create_links(); ?>

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
</div>
<div id="form-form">
    </div>
<div class="clearfix">

</div>

<script type="text/javascript">
  var tableDaftarNilai = '';
  var tahun = "<?php echo $tahun ?>";
  var gelombang = "<?php echo $gelombang ?>";
  $(function() {
    tableDaftarNilai = $('#table-daftar-nilai').DataTable({ 
      "bAutoWidth": false ,
      "processing": true, 
      "serverSide": true, 
      "order": [], 

      "ajax": {
        "url": '<?php echo site_url('admin/json_get_daftar_nilai'); ?>',
        "type": "POST",
        "data": {
          "json" : true,
          "tahun" : tahun,
          "gelombang" : gelombang
        }
      },
      "columns": [
      {"data": "number", "orderable" : false},
      {"data": "nama"},
      {"data": "no_peserta"},

      {"data": "tahun_gelombang"},
      {"data": "nilai"},
      ],
      'columnDefs': [
      {
        "targets": 0,
        "className": "text-center",
        "width" : "5%",
        "orderable" : false,
      },
      {
        "targets": 1,
        "width" : "50%"
      },
      {
        "targets": 2,
        "width" : "15%"
      },
      {
        "targets": 3,
        "className": "text-center",
        "width" : "20%",
        "orderable" : false
      }
      ,
      {
        "targets": 4,
        "className": "text-center",
        "width" : "15%"
      }
      ]
      ,

      rowCallback: function(row, data, iDisplayIndex) {

        var index = iDisplayIndex + 1;
        $('td:eq(0)', row).html(index);
      },

    });


    $('#btn-go').click(function()
    {
      var linkTahun = $("select[name='tahun'").val();
      var linkGelombang = $("select[name='gelombang'").val();
      window.location.href = "<?php echo site_url('admin/daftar_nilai/') ?>" + linkTahun + '/' + linkGelombang;
    })

    $('#link-cetak').click(function(e) {
      e.preventDefault();


      var   newForm = jQuery('<form>', {
        'action' : '<?php echo site_url() . 'admin/cetak_daftar_nilai' ?>',
        'target' : '_blank',
        'method' : 'post'
      }).append(jQuery('<input>', {
        'name' : 'tahun',
        'value' : tahun,
        'type' : 'hidden'
      }))
      .append(jQuery('<input>', {
        'name' : 'gelombang',
        'value' : gelombang,
        'type' : 'hidden'
      }))
      newForm.appendTo($('#form-form'));
      newForm.submit();

    });
    
  });
</script>