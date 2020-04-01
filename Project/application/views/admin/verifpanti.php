<div class="container-fluid">
          <form method="post">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800"> Data Permintaan Verifikasi Panti</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
              

                <div class="col mt-3">
                  <?php echo $this->session->flashdata('pesan')?>
                </div>
              </div>

              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style="width: 5px">No</th>
                        <th>Nama Panti</th>
                        <!-- <th style="width: 150px">Logo</th> -->
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th style="width: 96px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
               
                      <tr>
                        <td></td>
                        <td></td>
                        <!-- <td><img src="<?= base_url('uploads/') . $p->LOGO; ?>" alt="" style="width:140px"></td> -->
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <a href="<?php echo site_url("admin/komunitas/detail/");?>"
                             class="btn btn-sm btn-primary btn-circle">
                            <i class="fas fa-plus"></i>
                          </a>
                          <a href="<?php echo site_url('admin/komunitas/ubahdata/')?>"
                             class="btn btn-sm btn-info btn-circle">
                            <i class="fa fa-pencil-alt"></i>
                          </a>
                          <a href="#"
                             onclick="confirm_modal('<?php echo 'komunitas/hapus/' ?>')"
                             class="btn btn-sm btn-danger btn-circle"
                             data-toggle="modal" data-target="#hapusModal">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog"
                       aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakinuntuk menghapus?</h5>
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