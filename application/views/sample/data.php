<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-body table-responsive no-padding">
        <div class="row">
          <div class="d-flex justify-content-between">
              <div class="p-2">
                <a href="<?=base_url('permintaan-sample')?>" class="btn btn-secondary me-2"><i class="fa fa-arrow-left"></i> Kembali</a>
              </div>
              <div class="p-2">
                <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addVendor"><i class="fa fa-plus"></i> Tambah Data</button>  
              </div>
          </div>
        </div>
        <div class="flex-fill p-2">
          <div class="mb-1 row">
            <label for="no_polisi" class="col-sm-4 col-form-label">Nama Sample</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" value=": <?= $data_sample->nama_sample?>">
            </div>
          </div>
          <div class="mb-1 row">
            <label for="no_polisi" class="col-sm-4 col-form-label">Kategori</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" value=": <?= $data_sample->kategori_penggunaan?>">
            </div>
          </div>
          <div class="mb-1 row">
            <label for="no_polisi" class="col-sm-4 col-form-label">Kategori Bahan</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" value=": <?= $data_sample->kategori_bahan?>">
            </div>
          </div>
          <div class="mb-1 row">
            <label for="no_polisi" class="col-sm-4 col-form-label">Jumlah</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" value=": <?= $data_sample->jumlah_sample?> <?= $data_sample->satuan_sample?>">
            </div>
          </div>
          <div class="mb-1 row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Deskripsi</label>
            <div class="col-sm-8">
              <textarea readonly class="form-control-plaintext">: <?= $data_sample->nama_sample?></textarea>
            </div>
          </div>
        </div>
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th class="text-end">Tanggal Masuk</th>
            <th class="text-end">Nama Supplier</th>
            <th class="text-end">Harga</th>
            <th class="text-center">Dokumen</th>
            <th class="text-center">Status</th>
            <th class="text-center" width="100px">Hasil Lab</th>
            <th class="text-center" width="100px">Hasil Uji</th>
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
              <td><?= mediumdate_indo($ld->tgl_masuk)?></td>
              <td class="text-center"><?= $ld->nama_supplier?></td>
              <td class="text-center">Rp. <?= $ld->harga?></td>
              <td class="text-center">
                <a href="#" data-bs-toggle="modal" data-bs-target="#dokumenSample" onclick="showDokumenSample(<?= $ld->id_sample_vendor?>)"><i class="fa fa-eye"></i></a>
              </td>
              <td class="text-center">
                <?php if( $divisi_id == 5){?>
                <div class="dropdown">
                  <?php switch ($ld->status) {
                    case (1):?>
                      <a class="btn btn-sm btn-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Uji Stabilitas
                      </a>
                    <?php break; ?>

                    <?php case (2):?>
                      <a class="btn btn-sm btn-info dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menunggu
                      </a>
                    <?php break; ?>

                    <?php case (3):?>
                      <a class="btn btn-sm btn-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengecekan Lab
                      </a>
                    <?php break; ?>

                    <?php case (4):?>
                      <a class="btn btn-sm btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Trial
                      </a>
                    <?php break; ?>
                    
                    <?php default: ?>
                      <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        perlu proses
                      </a>
                    <?php break; ?>
                  <?php } ?>

                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('sample-masuk/'.$ld->id_sample_vendor.'/1')?>">uji stabilitas</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('sample-masuk/'.$ld->id_sample_vendor.'/2')?>">menunggu</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('sample-masuk/'.$ld->id_sample_vendor.'/3')?>">pengecekan lab</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('sample-masuk/'.$ld->id_sample_vendor.'/4')?>">trial</a></li>
                  </ul>
                </div>
                <?php }else{?>
                  <?php switch ($ld->status) {
                    case (1):?>
                      <span class="badge text-bg-primary">Uji Stabilitas</span> 
                    <?php break; ?>

                    <?php case (2):?>
                      <span class="badge text-bg-info">Menunggu</span> 
                    <?php break; ?>

                    <?php case (3):?>
                      <span class="badge text-bg-warning">Pengecekan Lab</span> 

                    <?php break; ?>

                    <?php case (4):?>
                      <span class="badge text-bg-success">Trial</span> 
                    <?php break; ?>
                    
                    <?php default: ?>
                      <span class="badge text-bg-secondary">perlu proses</span> 
                    <?php break; ?>
                  <?php } ?>
                <?php } ?>
              </td>
              <td class="text-center">
                <?php if(isset($ld->hasil_cek)){?>
                  <?php 
                    switch ($ld->hasil_cek) {
                    case (1):?>
                      <span class="badge text-bg-success">Sesuai</span> 
                    <?php  break; 
                    default:?>
                      <span class="badge text-bg-danger">Tidak Sesuai</span>
                  <?php } ?>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#detailCek" onclick="showDetailCek(<?= $ld->id_sample_vendor?>)"><i class="fa fa-eye"></i></a>
                <?php }else{?>
                  <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addHasilCek" data-bs-id="<?= $ld->id_sample_vendor ?>"><i class="fa fa-plus"></i> Input Hasil</button>
                <?php }?>
              </td>
              <td class="text-center">
                <?php if(isset($ld->hasil_uji)){?>
                  <span class="badge text-bg-success">Sesuai</span>
                  <a href="#" data-bs-toggle="modal" data-bs-target="#detailUji" onclick="showDetailUji(<?= $ld->id_sample_vendor?>)"><i class="fa fa-eye"></i></a>
                <?php }else{?>
                  <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addHasilUji"  data-bs-id="<?= $ld->id_sample_vendor ?>"><i class="fa fa-plus"></i> Input Hasil</button>
                <?php }?>
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
          <input type="hidden" name="id_sample_permintaan" value="<?=$data_sample->id_sample_permintaan?>" class="form-control">
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

<!-- Modal Detail Hasil Cek-->
<div class="modal fade" id="dokumenSample" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Detail Pengecekan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="keterangan" class="form-label">Dokumen:</label>
            </div>
             <div id="dokumen_sample">

             <!-- <iframe src="<?= base_url('assets/dokumen_sample/DOKUMEN_TEST.pdf')?>" width="800" height="500"></iframe> -->
             </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Hasil Cek-->
<div class="modal fade" id="addHasilCek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('sample/updateHasilCek')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Form Pengecekan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <label for="tgl_cek" class="form-label">Tanggal:</label>
          <input type="hidden" name="id_sample_vendor" id="id_sample_vendorCek" class="form-control">
          <input type="date" name="tgl_cek" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="hasil_cek" class="form-label">Hasil Cek:</label>
          <select name="hasil_cek" class="form-select tabel-PR" required>
            <option>----- pilih kategori ---</option>
            <option value="1">Sesuai</option>
            <option value="2">Tidak Sesuai</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="keterangan" class="form-label">Catatan:</label>
          <textarea name="keterangan" class="form-control tabel-PR" required rows="3"></textarea>
        </div>
        <div class="col-md-12">
          <label for="dokumen_cek" class="form-label">dokumen :</label>
          <input type="file" name="dokumen_cek" class="form-control">
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

<!-- Modal Detail Hasil Cek-->
<div class="modal fade" id="detailCek" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form action="<?=base_url('sample/updateHasilCek')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Detail Pengecekan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="mb-3">
              <label for="tgl_cek" class="form-label">Tanggal:</label>
              <input type="hidden" name="id_sample_vendor" id="id_sample_vendorCek" class="form-control">
              <input type="text" id="tgl_cek" class="form-control-plaintext">
            </div>
            <div class="mb-3">
              <label for="keterangan" class="form-label">Catatan:</label>
              <textarea id="keterangan" class="form-control-plaintext tabel-PR" required rows="3"></textarea>
            </div>
          </div>
          <div class="col-md-9">
            <div class="mb-3">
              <label for="keterangan" class="form-label">Dokumen:</label>
            </div>
             <div id="dokumen_cek">

             <!-- <iframe src="<?= base_url('assets/dokumen_sample/DOKUMEN_TEST.pdf')?>" width="800" height="500"></iframe> -->
             </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add Hasil Uji-->
<div class="modal fade" id="addHasilUji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('sample/updateHasilUji')?>" role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Form Hasil Uji</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <label for="tgl_selesai_uji" class="form-label">Tanggal:</label>
          <input type="hidden" name="id_sample_vendor" id="id_sample_vendorUji" class="form-control">
          <input type="date" name="tgl_selesai_uji" class="form-control">
        </div>
        <div class="col-md-12">
          <label for="hasil_uji" class="form-label">Hasil Uji:</label>
          <select name="hasil_uji" class="form-select tabel-PR" required>
            <option>----- pilih kategori ---</option>
            <option value="1">Sesuai</option>
            <option value="2">Tidak Sesuai</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="kesimpulan" class="form-label">Kesimpulan:</label>
          <textarea name="kesimpulan" class="form-control tabel-PR" required rows="3"></textarea>
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

<!-- Modal Detail Hasil Cek-->
<div class="modal fade" id="detailUji" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Detail Uji</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="mb-3">
              <label for="tgl_selesai_uji" class="form-label">Tanggal:</label>
              <input type="text" id="tgl_selesai_uji" class="form-control-plaintext">
            </div>
            <div class="mb-3">
              <label for="kesimpulan" class="form-label">Kesimpulan:</label>
              <textarea id="kesimpulan" class="form-control-plaintext tabel-PR" required rows="3"></textarea>
            </div>
          </div>
       </div>
    </div>
  </div>
</div>

<script>
  const ModalCek = document.getElementById('addHasilCek')
  if (ModalCek) {
    ModalCek.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      // If necessary, you could initiate an Ajax request here
      // and then do the updating in a callback.

      // Update the modal's content.
      document.getElementById("id_sample_vendorCek").value = id;
    })
  }

  const ModalUji = document.getElementById('addHasilUji')
  if (ModalUji) {
    ModalUji.addEventListener('show.bs.modal', event => {
      // Button that triggered the modal
      const button = event.relatedTarget
      // Extract info from data-bs-* attributes
      const id = button.getAttribute('data-bs-id')
      // If necessary, you could initiate an Ajax request here
      // and then do the updating in a callback.

      // Update the modal's content.
      document.getElementById("id_sample_vendorUji").value = id;
    })
  }

  function showDokumenSample($id){
    $.ajax({
      url:"<?php echo site_url("sample/getDokumenSample")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil)
        const file = "<?= site_url("assets/dokumen_sample")?>/" + hasil.dokumen_sample;
        document.getElementById("dokumen_sample").innerHTML = '<iframe src="'+ file + '" width="800" height="500"></iframe>';
      }
    });
  };

  function showDetailCek($id){
    $.ajax({
      url:"<?php echo site_url("sample/getHasilCek")?>/" + $id,
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
      url:"<?php echo site_url("sample/getHasilUji")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("tgl_selesai_uji").value = hasil.tgl_selesai_uji;
        document.getElementById("kesimpulan").value = hasil.kesimpulan;      
      }
    });
  };
</script>
