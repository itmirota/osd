
<div class="row">
  <?php if(empty($this->uri->segment(2))){?>
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKeterlambatan"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <?php }else{ ?> 
    <div class="d-flex justify-content-between mb-4">
      <a href="<?= base_url('Datadepartement')?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKeterlambatan"><i class="fa fa-plus"></i> Tambah Data</button>
    </div>
  <?php } ?>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Keterlambatan</h3>
      </div><!-- /.box-header -->
      <div class="card-body">
        <div class="table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th class="text-center">Periode</th>  
            <th class="text-center">Nama Pegawai</th>  
            <th class="text-center">Jumlah</th>  
            <th class="text-center">#</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
              foreach($list_data as $data)
              {
          ?>
          <tr>
            <td><?= $no++ ?></td>
            <td class="text-center"><?= bulan(substr($data->periode, 5, 2)).' '.substr($data->periode, 0, 4) ?></td>
            <td class="text-center"><?= $data->nama_pegawai ?></td>
            <td class="text-center"><?= $data->jml_keterlambatan ?></td>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_keterlambatan?>)">Edit Data</a></li> -->
                <li><a class="dropdown-item" href="<?= base_url('deleteketerlambatan/'.$data->id_keterlambatan) ?>">Hapus Data</a></li>
              </ul>
            </div>
            </td>
          </tr>
          <?php
              }
          }
          ?>
          </tbody>
        </table>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addKeterlambatan" tabindex="-1" aria-labelledby="addKeterlambatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('keterlambatan/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="periode" class="form-label">Periode</label>
              <input type="month" name="periode" placeholder="Periode" class="form-control tabel-PR" required />
            </div> 
            <div class="col-md-12">
              <label for="pegawai_id" class="form-label">Nama Pegawai</label>
              <select class="form-select" style="width:100%" id="pegawai_id" name="pegawai_id">
                <option readonly>-- nama pegawai --</option>
                <?php foreach ($pegawai as $p){ ?>
                <option value="<?= $p->id_pegawai?>"><?=$p->nama_pegawai?></option>
                <?php } ?>
              </select>
            </div>   
            <div class="col-md-12">
              <label for="jml_keterlambatan" class="form-label">Jumlah Terlambat</label>
              <input type="text" name="jml_keterlambatan" placeholder="Jumlah Terlambat" class="form-control tabel-PR" required />
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


<script>

  function editData($id){
    $.ajax({
      url:"<?php echo site_url("divisi/detaildivisi")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const divisi = hasil.divisi;
        document.getElementById("id_divisi").value = divisi.id_divisi;
        document.getElementById("departement_id").value = divisi.departement_id;
        document.getElementById("nama_divisi").value = divisi.nama_divisi;
        document.getElementById("kadiv_id").value = divisi.kadiv_id;
        document.getElementById("manager_id").value = divisi.manager_id;
      }
    });
  }
</script>