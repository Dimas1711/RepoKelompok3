<div class="container-fluid">
          <form method="post">
          <div class="well well-lg">
              <div class="container">
                  <h2>Data Permintaan Verifikasi Panti</h2>
                  <span>Halaman yang berisi list verifikasi panti</span>
              </div>
          </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
              </div>

              <div class="card-body">
              <div class="col-md-3 mt-3">
                  <select name="" id="status" class="form-control">
                      <option value="3">Show All</option>
                      <option value="0">Pending</option>
                      <option value="1">Aktif</option>
                      <option value="2">Cancel</option>
                    </select>
              </div>
                <div class="table-responsive">
                  <table class="table table-bordered mt-3" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style="width: 5px">No</th>
                        <th>Nama Panti</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th style="width: 96px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                  <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog"
                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk menghapus?</h5>
                          <button class="close" type="button" data-dismiss="modal"
                                  aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">Pilih "Hapus" untuk menghapus, pilih "Batal" untuk kembali ke Panel Admin.</div>
                        <div class="modal-footer">
                          <button class="btn btn-info" type="button" data-dismiss="modal">Batal</button>
                          <a id="delete_link" class="btn btn-danger" href="">Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

            </div>
          </form>
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
          url: "<?= base_url('admin/get_status_verifpanti')?>",
          data: "status=" + status,
          success: function(data)
          {
            $('#dataTable tbody').html(data);
          } 
        });
      }
</script>