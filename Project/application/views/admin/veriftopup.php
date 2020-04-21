<div class="container-fluid">
<div class="well well-lg">
    <div class="container">
        <h2>List Verifikasi Top up para Donatur</h2>
        <span>Halaman yang berisi list verifikasi top up dompet untuk para Donatur</span>
    </div>
</div>
<div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
</div>
    <div class="card-body">
      <div class="col-md-3">
      <select name="" id="status" class="form-control">
          <option value="3">Show All</option>
          <option value="0">Pending</option>
          <option value="1">Aktif</option>
          <option value="2">Cancel</option>
        </select>
      </div>
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="tabel_verif">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>foto</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

<script type="text/javascript">
      $(document).ready(function() {
        status();
          $('#status').change(function() {
              status();
          });
      });

      function status()
      {
        var status = $("#status").val();
        $.ajax({
          url: "<?= base_url('admin/get_status_topup')?>",
          data: "status=" + status,
          success: function(data)
          {
            $('#tabel_verif tbody').html(data);
            // console.log(data);
            //$("#table_verif tbody").html('<tr><td colspan="4" align="center">tidak ada data</td></tr>')
          } 
        });
      }
</script>




