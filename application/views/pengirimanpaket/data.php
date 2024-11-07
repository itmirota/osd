<div class="row">

  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPengirimanPaket"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <div class="d-flex flex-wrap justify-content-between">
          <div class="p-2">
            <h3 class="card-title">Data paket</h3>
          </div>
          <div class="p-2">
            <strong class="me-2">Saldo Rp. <?= $total_saldo ?></strong>
            <strong class="me-2">Sisa Saldo Rp. <?= $sisa_saldo ?></strong>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th class="text-end">Tanggal Pengiriman</th>
            <?php
            if($role != ROLE_ADMIN)
            {
            ?>
            <th class="text-end">Nama Pengirim</th>
            <?php } ?>
            <th class="text-end">Nama Penerima</th>
            <th class="text-end">Alamat Penerima</th>
            <th class="text-end">Deskripsi Paket</th>
            <th>Ekspedisi</th>
            <th class="text-end">No Resi</th>
            <th class="text-end">Biaya Kirim</th>
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
            <td><?php echo mediumdate_indo($data->tgl_kirim) ?></td>
            <?php
            if($role != ROLE_ADMIN)
            {
            ?>
            <td><?php echo $data->nama_pegawai ?></td>
            <?php } ?>
            <td><?php echo $data->nama_penerima ?></td>
            <td><?php echo $data->alamat_penerima ?></td>
            <td><?php echo $data->deskripsi_paket ?></td>
            <td><?php echo $data->ekspedisi ?></td>
            <td><?php echo $data->no_resi ?></td>
            <td width="100px"><?php echo $data->biaya_kirim ?></td>
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

<!-- Modal -->
<div class="modal fade" id="addPengirimanPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('pengirimanpaket/save')?>" role="form" id="addPengirimanPaket" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="tgl_kirim" class="form-label">tanggal pengiriman</label>
              <input type="date" name="tgl_kirim" class="form-control tabel-PR" required/>
            </div> 
            <div class="col-md-12">
              <label for="deskripsi_paket" class="form-label">Deskripsi Paket</label>
              <textarea  class="form-control tabel-PR" name="deskripsi_paket" cols="30" rows="5" required></textarea>
            </div> 
            <div class="col-md-12">
              <label for="nama_penerima" class="form-label">Nama Penerima</label>
              <input type="text" name="nama_penerima" placeholder="Nama penerima" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="ekspedisi" class="form-label">Nama Ekspedisi</label>
              <input type="text" name="ekspedisi" placeholder="Nama Ekspedisi" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="alamat_penerima" class="form-label">Alamat Penerima</label>
              <textarea  class="form-control tabel-PR" name="alamat_penerima" cols="30" rows="5" required></textarea>
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
      <form action="<?=base_url('barang/update')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama barang</label>
              <input type="hidden" name="id_barang" id="id_barang"/>
              <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama barang" class="form-control tabel-PR" required />
            </div>    
            <div class="col-md-12">
              <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
              <input type="date" name="tgl_pembelian" id="tgl_pembelian" placeholder="kondisi_barang" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Lokasi Barang</label>
              <select name="divisi_id" id="divisi_id" class="form-select tabel-PR">
                <?php foreach($divisi as $d){?>
                <option value=<?= $d->id_divisi ?>><?= $d->nama_divisi ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-6">
              <label for="stok_barang" class="form-label">Stok barang normal</label>
              <input type="text" name="stok_normal" id="stok_normal" class="form-control tabel-PR" required />
              </div>
              <div class="col-md-6">
              <label for="stok_barang" class="form-label">Stok barang rusak</label>
              <input type="text" name="stok_rusak" id="stok_rusak" class="form-control tabel-PR" required />
              </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="keterangan_barang" class="form-label">Keterangan</label>
              <select name="keterangan_barang" id="keterangan_barang"  class="form-select tabel-PR" required>
                <option value="1">asset</option>
                <option value="2">dipinjamkan</option>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="spesifikasi_barang" class="form-label">Spesifikasi Barang</label>
              <textarea  class="form-control tabel-PR" name="spesifikasi_barang" id="spesifikasi_edit" cols="30" rows="5"></textarea>
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

<!-- Spesifikasi-->
<div class="modal fade" id="spesifikasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Detail Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 row">
          <label for="spesifikasi" class="col-sm-6 col-form-label">Spesifikasi</label>
          <div class="col-sm-4">
            <input type="text" readonly class="form-control-plaintext" id="spesifikasi_barang">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="tgl_pembelian" class="col-sm-6 col-form-label">Tanggal Pembelian</label>
          <div class="col-sm-4">
            <input type="text" readonly class="form-control-plaintext" id="tanggal">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="Barcode" class="col-sm-6 col-form-label">Barcode</label>
          <div class="col-sm-4">
            <img id="barcode_barang" width="200" alt="barcode" srcset="" class="form-control-plaintext tabel-PR">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function editData($id){
    $.ajax({
      url:"<?php echo site_url("barang/detailbarang")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil.keterangan_barang);
        document.getElementById("id_barang").value = hasil.id_barang;
        document.getElementById("nama_barang").value = hasil.nama_barang;
        document.getElementById("divisi_id").value = hasil.divisi_id;
        document.getElementById("tgl_pembelian").value = hasil.tgl_pembelian;
        document.getElementById("stok_normal").value = hasil.stok_barang_normal;
        document.getElementById("stok_rusak").value = hasil.stok_barang_rusak;
        document.getElementById("keterangan_barang").value = hasil.keterangan_barang;
        document.getElementById("spesifikasi_edit").value = hasil.spesifikasi_barang;
      }
    });
  }

  function detailBarang($id){
    $.ajax({
      url:"<?php echo site_url("barang/detailbarang")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

        let d = new Date(hasil.tgl_pembelian);
        let month = months[d.getMonth()];
        let date = d.getDate();
        let year = d.getFullYear();

        document.getElementById("tanggal").value = date+' '+month+' '+year;
        document.getElementById("spesifikasi_barang").value = hasil.spesifikasi_barang;
        const urlgambar = "<?= site_url("assets/images/qrcode/barang/")?>"+hasil.qrcode_barang;

        $("#barcode_barang").attr('src',urlgambar);
      }
    });
  }
</script>