<div class="well well-lg">
    <div class="container">
        <h2>Daftar User</h2>
        <span>Halaman yang berisi list para donatur</span>
    </div>
</div>
<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered mt-3" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1;
                    foreach ($user as $row) {
                        ?>
                          <tr>
                              <td><?= $no++?></td> 
                              <td><?= $row->nama_user;?></td>
                              <td><?= $row->email?></td>
                              <td><?= $row->no_telp?></td>
                              
                              <!-- <td>
                                <a href="<?php echo base_url("ListUser/detail/".$c['id_user']);?>"
                                     class="btn btn-sm btn-primary btn-circle">
                                    <i class="fas fa-plus"></i>
                                </a>
                                
                                <a href="#"
                                     onclick="confirm_modal('<?= 'listuser/delete/'.$c['id_user'] ?>')"
                                     class="btn btn-sm btn-danger btn-circle"
                                     data-toggle="modal" data-target="#hapusModal">
                                    <i class="fa fa-trash"></i>
                                  </a>
                                </td> -->
        <!-- 
                                <td>
                              <td>
                              <a href="<?php echo site_url("ListUser/detail/". $row->id_user);?>"class="btn btn-info">Detail</a>
                            <a href="<?php echo site_url("index.php/listuser/delete/". $row->id_user);?>" class="btn btn-danger">Hapus</a>
                              </td> -->
        
        
        
                                <td>
                              <a href="<?php echo base_url("ListUser/detail/".$row->id_user);?>" class="btn btn-sm btn-primary btn-circle">
                                    <i class="fas fa-plus"></i></a>
        
                                <a href="#"
                                     onclick="confirm_modal('<?= 'ListUser/delete/'.$row->id_user ?>')"
                                     class="btn btn-sm btn-danger btn-circle"
                                     data-toggle="modal" data-target="#hapusModal">
                                    <i class="fa fa-trash"></i>
                                </a>
        
                            <!-- <a href="<?php echo site_url("listuser/delete/".$row->id_user);?>" class="btn btn-sm btn-danger btn-circle"
                                     data-toggle="modal" data-target="#hapusModal">
                                    <i class="fa fa-trash"></i></a> -->
                            <a href="<?php echo site_url("ListUser/delete/". $row->id_user);?>" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus ini?')">Hapus</a>
                              </td>
        
                          </tr>
                              <?php }?>
                        </tbody>
                    </table>
        
                    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        
                <script type="text/javascript">
                        function confirm_modal(delete_url) {
                            $('#hapusModal').modal('show', {
                                backdrop: 'static'
                            });
                            document.getElementById('delete_link').setAttribute('href', delete_url);
                        }
                    </script>
        
        
            </div>