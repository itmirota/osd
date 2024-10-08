
<div class="row">
  <div class="col-xs-12 mb-4 d-flex justify-content-end">
    <div class="form-group me-2">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i class="fa fa-plus"></i> Add New</button>
        <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew" ><i class="fa fa-plus"></i> Tambah Role</a> -->
    </div>
    <div class="form-group">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exportUser">
        Export Excel
        </button>
                <!-- Modal -->
                <div class="modal fade" id="exportUser" tabindex="-1" aria-labelledby="filterAbsenTokoLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="<?=base_url('user/excel_user')?>" role="form" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="divisi" class="form-label">Departement</label>
                      <select class="form-select" id="departement_id" onchange="getDivisiByDept()" required>
                        <option>--- pilih departement ---</option>
                        <?php foreach($departement as $data){?>
                        <option value=<?= $data->id_departement ?>><?= $data->nama_departement ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="divisi" class="form-label">Divisi</label>
                      <select id="divisi" name="divisi" class="form-select" required>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Input</button>
                  </div>
                  </form>
              </div>
          </div>
        </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Users List</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>Divisi</th>
            <th>Role</th>
            <th class="text-center">Actions</th>
          </tr>
         </thead>
        <tbody>
          <?php
          if(!empty($userRecords))
          {
            $no = 1;
              foreach($userRecords as $record)
              {
          ?>
          <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $record->name ?></td>
            <td><?php echo $record->username ?></td>
            <td><?= $record->divisi_id == 0 ? 'semua divisi' : $record->nama_divisi ?></td>
            <td><?php echo $record->role ?></td>
            <td class="text-center">
                <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOld/'.$record->userId; ?>"><i class="fa fa-pencil"></i></a>
                <a class="btn btn-sm btn-danger" href="<?php echo base_url().'user/delete/'.$record->userId; ?>"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          <?php
          $no++;
              }
          }
          ?>
          </tbody>
        </table>
        
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>

  <!-- Modal -->
  <div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-6">                                
                      <div class="form-group">
                          <label for="fname">Full Name</label>
                          <input type="text" class="form-control required" id="fname" name="fname" maxlength="128" placeholder="masukkan nama lengkap">
                      </div>
                      
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="username">username</label>
                          <input type="text" class="form-control required" id="username"  name="username" maxlength="128" placeholder="masukkan username">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control required" id="password"  name="password" maxlength="10" placeholder="masukkan password">
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="cpassword">Confirm Password</label>
                          <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="10" placeholder="konfirmasi ulang passwordmu">
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="role">Role</label>
                      <select class="form-select required" id="role" name="role">
                          <option>Select Role</option>
                          <?php
                          if(!empty($roles))
                          {
                            foreach ($roles as $rl)
                            {
                              ?>
                              <option value="<?php echo $rl->roleId ?>"><?php echo $rl->role ?></option>
                              <?php
                            }
                          }
                          ?>
                      </select>
                  </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control required" id="email"  name="email" placeholder="masukkan email">
                    </div>
                </div>   
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="divisi_id">Divisi</label>
                        <select class="form-select required" id="divisi_id" name="divisi_id">
                            <option value="0">semua divisi</option>
                            <?php
                            if(!empty($divisi))
                            {
                              foreach ($divisi as $d)
                              {
                                ?>
                                <option value="<?php echo $d->id_divisi ?>"><?php echo $d->nama_divisi ?></option>
                                <?php
                              }
                            }
                            ?>
                        </select>
                    </div>
                </div>    
              </div>
          </div><!-- /.box-body -->

          <div class="modal-footer d-flex justify-content-end">
              <input type="submit" class="btn btn-success" value="Submit" />
          </div>
      </form>
      </div>
    </div>
  </div>
</div>

<script>
function getDivisiByDept(){
  let departement = $("#departement_id").val();
  $.ajax({
    type : "POST",
    dataType : "JSON",
    url:"<?php echo site_url("divisi/getDivisiByDept")?>/"+departement,
    success : function(data){

      let html = ' ';
      let i;

      html += 
          '<option>---pilih divisi---</option>';
      for ( i=0; i < data.length ; i++){
          html += 
          '<option value="'+ data[i].id_divisi +'">'+ data[i].nama_divisi +'</option>';
      }

      $("#divisi").html(html);
    }
  });
}
</script>
