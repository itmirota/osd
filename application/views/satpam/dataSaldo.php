<div class="row">

  <?php
  if($role == ROLE_SUPERADMIN | $role == ROLE_HRGA)
  {
  ?>
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSaldo"><i class="fa fa-plus"></i> Tambah Saldo</button>
  </div>
  <?php } ?>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <div class="d-flex flex-wrap justify-content-between">
          <div class="p-2">
            <h3 class="card-title">Data Saldo</h3>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Saldo</th>
            <th>Sisa Saldo</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo mediumdate_indo(date('Y-m-d', strtotime($data->datecreated))) ?></td>
            <td><?php echo $data->saldo ?></td>
            <td><?php echo $data->sisa_saldo ?></td>
          </tr>
          <?php
            endforeach;
          } ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div>
  </div>
</div>

<!-- Modal Add Saldo -->
<div class="modal fade" id="addSaldo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('SaldoSatpam/saveSaldo')?>" role="form" id="addSaldo" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="datecreated" class="form-label">tanggal pemberian</label>
              <input type="date" name="datecreated" class="form-control tabel-PR" required/>
            </div> 
            <div class="col-md-12">
              <label for="saldo" class="form-label">Jumlah Saldo</label>
              <input type="text" class="form-control tabel-PR" name="saldo" required/>
            </div>       
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>