<div class="container-fluid">
<div class="well well-lg">
    <div class="container">
        <h2>List Verifikasi Donasi</h2>
        <span>Halaman yang berisi list panti yang butuh donasi</span>
    </div>
</div>
<div class="card shadow mb-4">
              <div class="card-header py-3">
                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
</div>
    <div class="card-body">
      <!-- <div class="col-md-3">
      <select name="" id="status" class="form-control">
          <option value="3">Show All</option>
          <option value="0">Pending</option>
          <option value="1">Aktif</option>
          <option value="2">Cancel</option>
        </select>
      </div> -->
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Panti</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>foto</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($kasus as $row) {
                ?>
                  <tr>
                      <td><?= $no++?></td>
                      <td><?= $row['nama_panti']?></td>
                      <td><?= $row['judul']?></td>
                      <td><?= $row['kategori']?></td>
                      <td>
                      <?php if ($row['status'] == 0) {
                        echo '<div class="badge badge-primary badge-pill">Pending</div>';
                      }
                      ?>
                      </td>
                      <td><img src="<?=base_url('uploads/panti/') . $row['gambar']?>" alt="gambar" width="100"></td>
                      <td>
                      <a href="<?php echo base_url("admin/verif_kasus_detail/" .$row['id_kasus']);?>"
                          class="btn btn-sm btn-primary btn-circle">
                          <i class="fas fa-plus"></i>
                        </a>
                      </td>
                  </tr>
                      <?php }?> 
                </tbody>
            </table>
            <?= $this->pagination->create_links();?>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>

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
          url: "<?= base_url('admin/get_status_donasi')?>",
          data: "status=" + status,
          success: function(data)
          {
            $('#tabel_verif tbody').html(data);
          } 
        });
      }
</script> -->




