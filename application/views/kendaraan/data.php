
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data kendaraan roda 4</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>No. Polisi</th>
            <th>Merek</th>
            <th>Jenis</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Kepemilikan</th>
            <th>barcode</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_POOL)
            {
            ?>
            <th class="text-center">#</th>
            <?php } ?>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($mobil))
          {
            foreach($mobil as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nomor_polisi ?></td>
            <td><?php echo $data->merek_kendaraan ?></td>
            <td><?php echo $data->jenis_penggunaan ?></td>
            <td><?php echo $data->warna_kendaraan ?></td>
            <td><?php echo $data->tahun ?></td>
            <td><?php echo $data->kepemilikan ?></td>
            <td>
              <a href="#" class="pop">
                <img src="<?= base_url('assets/images/qrcode/kendaraan/'.$data->qrcode_kendaraan)?>" width="50px" style="border-radius:10px">
              </a>
            </td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_POOL)
            {
            ?>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailData" onclick="detailData(<?= $data->id_kendaraan?>)">Detail Kendaraan</a></li>
                <li><a class="dropdown-item" href="<?= base_url('kendaraan/perawatan/'.$data->id_kendaraan) ?>">Detail Perawatan</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_kendaraan?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="<?= base_url('deletekendaraan/'.$data->id_kendaraan) ?>" >Hapus Data</a></li>
              </ul>
            </div>
            </td>
            <?php } ?>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>
        
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data kendaraan roda 2</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataMontor" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>No. Polisi</th>
            <th>Merek</th>
            <th>Jenis</th>
            <th>Warna</th>
            <th>Tahun</th>
            <th>Kepemilikan</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_POOL)
            {
            ?>
            <th class="text-center">#</th>
            <?php } ?>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($montor))
          {
            foreach($montor as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nomor_polisi ?></td>
            <td><?php echo $data->merek_kendaraan ?></td>
            <td><?php echo $data->jenis_penggunaan ?></td>
            <td><?php echo $data->warna_kendaraan ?></td>
            <td><?php echo $data->tahun ?></td>
            <td><?php echo $data->kepemilikan ?></td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_POOL)
            {
            ?>
            <td class="text-center">
            <div class="btn-group">
              <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
              </a>

              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailData" onclick="detailData(<?= $data->id_kendaraan?>)">Detail Kendaraan</a></li>
                <li><a class="dropdown-item" href="<?= base_url('kendaraan/perawatan/'.$data->id_kendaraan) ?>">Detail Perawatan</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_kendaraan?>)">Edit Data</a></li>
                <li><a class="dropdown-item" href="<?= base_url('deletekendaraan/'.$data->id_kendaraan) ?>" >Hapus Data</a></li>
              </ul>
            </div>
            </td>
            <?php } ?>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>
        
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="<?=base_url('kendaraan/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="col-md-12">
                  <label for="jenis_kendaraan" class="form-label">Jenis kendaraan</label>
                  <select name="jenis_kendaraan" class="form-select tabel-PR" required>
                    <option readonly>pilih jenis kendaraan</option>
                    <option value="montor">Kendaraan Roda 2</option>
                    <option value="mobil">Kendaraan Roda 4</option>
                  </select>
                </div> 

                <div class="col-md-12">
                  <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                  <input type="text" name="nomor_polisi" placeholder="Nomor Polisi" class="form-control tabel-PR" required />
                </div>

                <div class="col-md-12">
                  <label for="merek_kendaraan" class="form-label">Merek Kendaraan</label>
                  <input type="text" name="merek_kendaraan" placeholder="Merek Kendaraan" class="form-control tabel-PR" required />
                </div>

                <div class="col-md-12">
                  <label for="jenis_penggunaan" class="form-label">Jenis kendaraan</label>
                  <select name="jenis_penggunaan" class="form-select tabel-PR" required>
                    <option readonly>pilih jenis Penggunaan</option>
                    <option value="angkutan">Kendaraan Angkutan</option>
                    <option value="operasional">Kendaraan Operasional</option>
                  </select>
                </div> 

                <div class="col-md-12">
                  <label for="kapasitas_kendaraan" class="form-label">Kapasitas Kendaraan</label>
                  <input type="text" name="kapasitas_kendaraan" placeholder="contoh: 1000CC" class="form-control tabel-PR" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <label for="warna_kendaraan" class="form-label">Warna Kendaraan</label>
                  <input type="text" name="warna_kendaraan" placeholder="Warna Kendaraan" class="form-control tabel-PR"/>
                </div>

                <div class="col-md-12">
                  <label for="tahun" class="form-label">Tahun Perakitan</label>
                  <input type="text" name="tahun" placeholder="Tahun pembelian" class="form-control tabel-PR"/>
                </div>

                <div class="col-md-12">
                  <label for="no_rangka" class="form-label">No Rangka</label>
                  <input type="text" name="no_rangka" placeholder="isikan nomor rangka disini" class="form-control tabel-PR"/>
                </div>

                <div class="col-md-12">
                  <label for="no_mesin" class="form-label">No Mesin</label>
                  <input type="text" name="no_mesin" placeholder="isikan nomor mesin disini" class="form-control tabel-PR"/>
                </div>
    
                <div class="col-md-12">
                  <label for="kepemilikan" class="form-label">Kepemilikan</label>
                  <input type="text" name="kepemilikan" class="form-control tabel-PR" placeholder="contoh: PT. Mirota KSM" required />
                </div> 
              </div>
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

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('kendaraan/update')?>" role="form" id="editkendaraan" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <label for="jenis_kendaraan" class="form-label">Jenis kendaraan</label>
                <input type="hidden" name="id_kendaraan" id="id_kendaraan" class="form-control tabel-PR" required />
                <select name="jenis_kendaraan" id="jenis_kendaraan" class="form-select tabel-PR" required>
                  <option value="montor">Kendaraan Roda 2</option>
                  <option value="mobil">Kendaraan Roda 4</option>
                </select>
              </div> 

              <div class="col-md-12">
                <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
                <input type="text" name="nomor_polisi" id="nomor_polisi" placeholder="Nomor Polisi" class="form-control tabel-PR" required />
              </div>

              <div class="col-md-12">
                <label for="merek_kendaraan" class="form-label">Merek Kendaraan</label>
                <input type="text" name="merek_kendaraan" id="merek_kendaraan" placeholder="Merek Kendaraan" class="form-control tabel-PR" required />
              </div>

              <div class="col-md-12">
                <label for="jenis_penggunaan" class="form-label">Jenis kendaraan</label>
                <select name="jenis_penggunaan" id="jenis_penggunaan" class="form-select tabel-PR" required>
                  <option readonly>pilih jenis Penggunaan</option>
                  <option value="angkutan">Kendaraan Angkutan</option>
                  <option value="operasional">Kendaraan Operasional</option>
                </select>
              </div> 

              <div class="col-md-12">
                <label for="kapasitas_kendaraan" class="form-label">Kapasitas Kendaraan</label>
                <input type="text" name="kapasitas_kendaraan" id="kapasitas_kendaraan" placeholder="contoh: 1000CC" class="form-control tabel-PR"/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <label for="warna_kendaraan" class="form-label">Warna Kendaraan</label>
                <input type="text" name="warna_kendaraan" id="warna_kendaraan" placeholder="Warna Kendaraan" class="form-control tabel-PR"/>
              </div>

              <div class="col-md-12">
                <label for="tahun" class="form-label">Tahun Perakitan</label>
                <input type="text" name="tahun" id="tahun" placeholder="Tahun pembelian" class="form-control tabel-PR"/>
              </div>

              <div class="col-md-12">
                <label for="no_rangka" class="form-label">No Rangka</label>
                <input type="text" name="no_rangka" id="no_rangka" placeholder="isikan nomor rangka disini" class="form-control tabel-PR"/>
              </div>

              <div class="col-md-12">
                <label for="no_mesin" class="form-label">No Mesin</label>
                <input type="text" name="no_mesin" id="no_mesin" placeholder="isikan nomor mesin disini" class="form-control tabel-PR"/>
              </div>
  
              <div class="col-md-12">
                <label for="kepemilikan" class="form-label">Kepemilikan</label>
                <input type="text" name="kepemilikan" id="kepemilikan" class="form-control tabel-PR" placeholder="contoh: PT. Mirota KSM" required />
              </div> 
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

<!-- Modal Detail-->
<div class="modal fade" id="detailData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kendaraan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <div class="col-md-12">
                <label for="info_jenis_kendaraan" class="form-label">Jenis kendaraan</label>
                <select id="info_jenis_kendaraan" class="form-select select-plaintext tabel-PR" disabled >
                  <option value="montor">Kendaraan Roda 2</option>
                  <option value="mobil">Kendaraan Roda 4</option>
                </select>
              </div> 

              <div class="col-md-12">
                <label for="info_nomor_polisi" class="form-label">Nomor Polisi</label>
                <input type="text" id="info_nomor_polisi" class="form-control-plaintext tabel-PR" readonly />
              </div>

              <div class="col-md-12">
                <label for="info_merek_kendaraan" class="form-label">Merek Kendaraan</label>
                <input type="text" id="info_merek_kendaraan" class="form-control-plaintext tabel-PR" readonly />
              </div>

              <div class="col-md-12">
                <label for="info_jenis_penggunaan" class="form-label">Jenis kendaraan</label>
                <select id="info_jenis_penggunaan" class="form-select select-plaintext tabel-PR" disabled>
                  <option value="angkutan">Kendaraan Angkutan</option>
                  <option value="operasional">Kendaraan Operasional</option>
                </select>
              </div> 

              <div class="col-md-12">
                <label for="info_kapasitas_kendaraan" class="form-label">Kapasitas Kendaraan</label>
                <input type="text" id="info_kapasitas_kendaraan" class="form-control-plaintext tabel-PR" readonly />
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-12">
                <label for="info_warna_kendaraan" class="form-label">Warna Kendaraan</label>
                <input type="text" id="info_warna_kendaraan" class="form-control-plaintext tabel-PR" readonly />
              </div>

              <div class="col-md-12">
                <label for="info_tahun" class="form-label">Tahun Perakitan</label>
                <input type="text" id="info_tahun" class="form-control-plaintext tabel-PR" readonly />
              </div>

              <div class="col-md-12">
                <label for="info_no_rangka" class="form-label">No Rangka</label>
                <input type="text" id="info_no_rangka" class="form-control-plaintext tabel-PR" readonly />
              </div>

              <div class="col-md-12">
                <label for="info_no_mesin" class="form-label">No Mesin</label>
                <input type="text" id="info_no_mesin" class="form-control-plaintext tabel-PR" readonly />
              </div>
  
              <div class="col-md-12">
                <label for="info_kepemilikan" class="form-label">Kepemilikan</label>
                <input type="text" id="info_kepemilikan" class="form-control-plaintext tabel-PR" readonly />
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">              
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" class="imagepreview" style="width: 100%;" >
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
  $(function() {
    $('.pop').on('click', function() {
        $('.imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal('show');   
    });		
  });

  function detailData($id){
    $.ajax({
      url:"<?php echo site_url("kendaraan/detailkendaraan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("info_jenis_kendaraan").value = hasil.jenis_kendaraan;
        document.getElementById("info_nomor_polisi").value = hasil.nomor_polisi;
        document.getElementById("info_merek_kendaraan").value = hasil.merek_kendaraan;
        document.getElementById("info_jenis_penggunaan").value = hasil.jenis_penggunaan;
        document.getElementById("info_kapasitas_kendaraan").value = hasil.kapasitas_kendaraan;
        document.getElementById("info_warna_kendaraan").value = hasil.warna_kendaraan;
        document.getElementById("info_tahun").value = hasil.tahun;
        document.getElementById("info_no_rangka").value = hasil.no_rangka;
        document.getElementById("info_no_mesin").value = hasil.no_mesin;
        document.getElementById("info_kepemilikan").value = hasil.kepemilikan;
      }
    });
  }

  function editData($id){
    $.ajax({
      url:"<?php echo site_url("kendaraan/detailkendaraan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("id_kendaraan").value = hasil.id_kendaraan;
        document.getElementById("jenis_kendaraan").value = hasil.jenis_kendaraan;
        document.getElementById("nomor_polisi").value = hasil.nomor_polisi;
        document.getElementById("merek_kendaraan").value = hasil.merek_kendaraan;
        document.getElementById("jenis_penggunaan").value = hasil.jenis_penggunaan;
        document.getElementById("kapasitas_kendaraan").value = hasil.kapasitas_kendaraan;
        document.getElementById("warna_kendaraan").value = hasil.warna_kendaraan;
        document.getElementById("tahun").value = hasil.tahun;
        document.getElementById("no_rangka").value = hasil.no_rangka;
        document.getElementById("no_mesin").value = hasil.no_mesin;
        document.getElementById("kepemilikan").value = hasil.kepemilikan;
      }
    });
  }
</script>