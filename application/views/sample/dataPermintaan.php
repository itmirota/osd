<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addData"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th class="text-end">Tanggal Permintaan</th>
            <th class="text-end">Nama Sample</th>
            <th class="text-end">Deskripsi Sample</th>
            <th class="text-end">Kategori Penggunaan</th>
            <th class="text-end">Kategori Bahan</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $ld):
          ?>
            <tr>
              <td><?= $no++?></td>
              <td><?= mediumdate_indo($ld->tgl_permintaan)?></td>
              <td class="text-center"><?= $ld->nama_sample?></td>
              <td class="text-center"><?= $ld->deskripsi_sample?></td>
              <td class="text-center"><?= $ld->kategori_penggunaan?></td>
              <td class="text-center"><?= $ld->kategori_bahan?></td>
              <td class="text-center"><?= $ld->jumlah_sample.' '.$ld->satuan_sample?></td>
              <td class="text-center">
                <?php if ($ld->status_permintaan == 0){?>
                  <span class="badge text-bg-success">Open</span>
                <?php }else{?>
                  <span class="badge text-bg-danger">Close</span>
                <?php } ?>
              </td>
              <td class="text-center">
                <a href="<?= base_url('uji-sample/'.$ld->id_sample_permintaan)?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
              </td>
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

<!-- Modal Add Data Sample-->
<div class="modal fade" id="addData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('sample/savePermintaan')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Form Input Sample</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <label for="nama_sample" class="form-label">Nama Sample:</label>
          <input type="text" name="nama_sample" class="form-control" placeholder="masukkan nama sample disini">
        </div>
        <div class="col-md-12">
          <label for="deskripsi_sample" class="form-label">Deskripsi:</label>
          <textarea name="deskripsi_sample" class="form-control tabel-PR" required rows="3"></textarea>
        </div>
        <div class="col-md-12">
          <div class="row">
          <div class="col-md-6">
            <label for="jumlah_sample" class="form-label">Jumlah:</label>
            <input type="text" name="jumlah_sample" class="form-control" placeholder="masukkan jumlah disini">
          </div>
          <div class="col-md-6">
            <label for="satuan_sample" class="form-label">Satuan:</label>
            <select name="satuan_sample" class="form-select tabel-PR" required>
              <option>----- pilih satuan ---</option>
              <option value="gr">Gram</option>
              <option value="mtr">Meter</option>
              <option value="lbr">Lembar</option>
            </select>
          </div>
          </div>
        </div>
        <div class="col-md-12">
          <label for="kategori_penggunaan" class="form-label">Penggunaan:</label>
          <select name="kategori_penggunaan" class="form-select tabel-PR" required>
            <option>----- pilih penggunaan ---</option>
            <option value="reformulasi">Reformulasi</option>
            <option value="develop">Develop</option>
            <option value="maklon">Maklon</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="kategori_bahan" class="form-label">Kategori:</label>
          <select name="kategori_bahan" class="form-select tabel-PR" placeholder="masukkan kategori disini" required>
            <option>----- pilih kategori ---</option>
            <option value="bahan baku">Bahan Baku</option>
            <option value="bahan tambahan">Bahan Tambahan</option>
            <option value="bahan kemas">Bahan Kemas</option>
            <option value="bahan Maklon">Bahan Maklon</option>
          </select>
        </div>
        <div class="d-flex justify-content-end mt-4">
          <div class="p-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add Data Sample-->
<div class="modal fade" id="addVendor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('sample/saveVendor')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Form Input Supplier Sample</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <label for="tgl_masuk" class="form-label">Tanggal Masuk:</label>
          <input type="date" name="tgl_masuk" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="nama_supplier" class="form-label">Nama Supplier:</label>
          <input type="hidden" name="id_sample_permintaan" id="id_sample_permintaan" class="form-control">
          <input type="text" name="nama_supplier" class="form-control" placeholder="masukkan nama supplier disini">
        </div>
        <div class="col-md-12">
          <label for="harga" class="form-label">Harga:</label>
          <input type="text" name="harga" class="form-control" placeholder="masukkan total harga disini">
        </div>
        <div class="col-md-12">
          <label for="dokumen" class="form-label">dokumen (COA, Halal, Spec) :</label>
          <input type="file" name="dokumen" id="dokumen" class="form-control">
        </div>
        <div class="d-flex justify-content-end mt-4">
          <div class="p-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  const ModalCek = document.getElementById('addVendor')
  if (ModalCek) {
    ModalCek.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      // If necessary, you could initiate an Ajax request here
      // and then do the updating in a callback.

      // Update the modal's content.
      document.getElementById("id_sample_permintaan").value = id;
    })
  }

  function showDokumenSample($id){
    $.ajax({
      url:"<?php echo site_url("RegistrasiSampleMasuk/getDokumenSample")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const file = "<?= site_url("assets/dokumen_sample")?>/" + hasil.dokumen_sample;
        document.getElementById("dokumen_sample").innerHTML = '<iframe src="'+ file + '" width="800" height="500"></iframe>';
      }
    });
  };

  function showDetailCek($id){
    $.ajax({
      url:"<?php echo site_url("RegistrasiSampleMasuk/getHasilCek")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("tgl_cek").value = hasil.tgl_cek;
        document.getElementById("keterangan").value = hasil.keterangan;

        const file = "<?= site_url("assets/dokumen_sample")?>/" + hasil.dokumen_cek;
        document.getElementById("dokumen_cek").innerHTML = '<iframe src="'+ file + '" width="800" height="500"></iframe>';
      }
    });
  };

  function showDetailUji($id){
    $.ajax({
      url:"<?php echo site_url("RegistrasiSampleMasuk/getHasilUji")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("tgl_selesai_uji").value = hasil.tgl_selesai_uji;
        document.getElementById("kesimpulan").value = hasil.kesimpulan;      
      }
    });
  };
</script>
