<div class="row">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#AddNewSupplier"><i class="fa fa-plus"></i> Tambah Data</button>
      </div>
      
      <!-- AddNewSupplier -->
      <div class="modal fade" id="AddNewSupplier" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Baru</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?=base_url('simpan-supplier')?>" role="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <form action="<?=base_url('simpan-supplier')?>" role="form" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_vendor" class="form-label">Nama Supplier/Vendor</label>
                  <input type="text" class="form-control" name="nama_vendor" aria-describedby="nama_vendorHelp">
                  <div id="nama_vendorHelp" class="form-text">isi dengan format Nama perusahaan, PT contoh : Paragon Corp, PT.</div>
                </div>
                <div class="mb-3">
                  <label for="no_rekening" class="form-label">Data Rekening</label>
                  <input type="text" class="form-control" name="no_rekening" aria-describedby="no_rekeningHelp">
                  <div id="no_rekeningHelp" class="form-text">isi dengan format nama Bank, No. Rekening, Atas Nama.</div>
                </div>
                <div class="mb-3">
                  <label for="no_npwp" class="form-label">Nomor NPWP</label>
                  <input type="text" class="form-control" name="no_npwp" aria-describedby="no_npwpHelp">
                </div>
                <div class="mb-3">
                  <label for="no_rekening" class="form-label">Status Pajak</label>
                  <select class="form-select" name="status_pajak" aria-label="Default select example">
                    <option selected>pilih </option>
                    <option value="PKP">PKP</option>
                    <option value="Non PKP">Non PKP</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="dokumen" class="form-label">Dokumen Terkait</label>
                  <input class="form-control form-control-sm" name="dokumen" type="file">
                  <div id="no_rekeningHelp" class="form-text">upload dalam 1 pdf vendor form, disertai dengan NPWP serta SPPKP jika ada.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Input</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div class="row">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Vendor/Supplier</th>
            <th>Data Rekening</th>
            <th>No NPWP</th>
            <th>Status Pajak</th>
            <th>Dokumen</th>
            <th>Status</th>
            <th width="100px">Aksi</th>
          </tr>
          </thead>

          <?php $no = 1;?>
          <?php foreach ($list_data as $ld){?>
          <tr>
            <td><?= $no ?></td>
            <td><?=$ld->nama_input?></td>
            <td><?=$ld->no_rekening?></td>
            <td><?=$ld->no_npwp?></td>
            <td><?=$ld->status_pajak?></td>
            <td><a href="#" id="showDokumen" data-bs-toggle="modal" data-bs-target="#absenToko" onclick= "showDokumen(<?= $ld->id_supplier ?>)"><i class="fa fa-solid fa-eye"></i> lihat</a></td>
            <td>
              <p class="m-0">dibuat oleh: <span style="font-size:10px; font-weight:bold"><?=$ld->nama_input?></span></p>
              <p class="m-0">tanggal: <span style="font-size:10px; font-weight:bold"><?= mediumdate_indo($ld->tanggal_input).' | '.DATE('H:i',strtotime($ld->waktu_input)). ' WIB';?></span></p>
              
              <?php if(isset($ld->userprocess_id)) {?>
              <p class="m-0">diproses oleh: <span style="font-size:10px; font-weight:bold"><?= isset($ld->userprocess_id) ? $ld->nama_proses : "-"?></span></p>
              <p class="m-0">tanggal: <span style="font-size:10px; font-weight:bold"><?=isset($ld->tanggal_proses) ? mediumdate_indo($ld->tanggal_proses).' | '.DATE('H:i',strtotime($ld->waktu_proses)). ' WIB' : "-"?></span></p>
              <?php } ?>
            </td>
            <td>
              <div class="d-grid gap-2 d-md-block">
                <?php if(is_null($ld->userprocess_id)) {?>
                <button class="btn btn-sm btn-primary process" data-id="<?=$ld->id_supplier?>" type="button"><i class="fa fa-solid fa-check"></i></button>
                <?php } ?>
                
                <a href="<?= "http://wa.me/".$ld->kontak_pegawai ?>" target="_blank">
                  <svg width="35px" height="35px" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M16 31C23.732 31 30 24.732 30 17C30 9.26801 23.732 3 16 3C8.26801 3 2 9.26801 2 17C2 19.5109 2.661 21.8674 3.81847 23.905L2 31L9.31486 29.3038C11.3014 30.3854 13.5789 31 16 31ZM16 28.8462C22.5425 28.8462 27.8462 23.5425 27.8462 17C27.8462 10.4576 22.5425 5.15385 16 5.15385C9.45755 5.15385 4.15385 10.4576 4.15385 17C4.15385 19.5261 4.9445 21.8675 6.29184 23.7902L5.23077 27.7692L9.27993 26.7569C11.1894 28.0746 13.5046 28.8462 16 28.8462Z" fill="#BFC8D0"></path> <path d="M28 16C28 22.6274 22.6274 28 16 28C13.4722 28 11.1269 27.2184 9.19266 25.8837L5.09091 26.9091L6.16576 22.8784C4.80092 20.9307 4 18.5589 4 16C4 9.37258 9.37258 4 16 4C22.6274 4 28 9.37258 28 16Z" fill="url(#paint0_linear_87_7264)"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 18.5109 2.661 20.8674 3.81847 22.905L2 30L9.31486 28.3038C11.3014 29.3854 13.5789 30 16 30ZM16 27.8462C22.5425 27.8462 27.8462 22.5425 27.8462 16C27.8462 9.45755 22.5425 4.15385 16 4.15385C9.45755 4.15385 4.15385 9.45755 4.15385 16C4.15385 18.5261 4.9445 20.8675 6.29184 22.7902L5.23077 26.7692L9.27993 25.7569C11.1894 27.0746 13.5046 27.8462 16 27.8462Z" fill="white"></path> <path d="M12.5 9.49989C12.1672 8.83131 11.6565 8.8905 11.1407 8.8905C10.2188 8.8905 8.78125 9.99478 8.78125 12.05C8.78125 13.7343 9.52345 15.578 12.0244 18.3361C14.438 20.9979 17.6094 22.3748 20.2422 22.3279C22.875 22.2811 23.4167 20.0154 23.4167 19.2503C23.4167 18.9112 23.2062 18.742 23.0613 18.696C22.1641 18.2654 20.5093 17.4631 20.1328 17.3124C19.7563 17.1617 19.5597 17.3656 19.4375 17.4765C19.0961 17.8018 18.4193 18.7608 18.1875 18.9765C17.9558 19.1922 17.6103 19.083 17.4665 19.0015C16.9374 18.7892 15.5029 18.1511 14.3595 17.0426C12.9453 15.6718 12.8623 15.2001 12.5959 14.7803C12.3828 14.4444 12.5392 14.2384 12.6172 14.1483C12.9219 13.7968 13.3426 13.254 13.5313 12.9843C13.7199 12.7145 13.5702 12.305 13.4803 12.05C13.0938 10.953 12.7663 10.0347 12.5 9.49989Z" fill="white"></path> <defs> <linearGradient id="paint0_linear_87_7264" x1="26.5" y1="7" x2="4" y2="28" gradientUnits="userSpaceOnUse"> <stop stop-color="#5BD066"></stop> <stop offset="1" stop-color="#27B43E"></stop> </linearGradient> </defs> </g></svg>
                </a>
              </div> 
            </td>
          </tr>
          <?php $no++ ?>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail Hasil Cek-->
<div class="modal fade" id="absenToko" tabindex="-1" aria-labelledby="absenTokoLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="titleAddPegawai">Dokumen Pendukung</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-md-12">
                <div id="dokumen">
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
  function showDokumen($id){
    $.ajax({
      url:"<?php echo site_url("DataAccurate/getDokumenSupplier")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil)
        
        const file = "<?= site_url("assets/dokumen_supplier")?>/" + hasil.dokumen;
        
        document.getElementById("dokumen").innerHTML = '<iframe src="'+ file + '" frameborder="0" style="width:100%; height:400px;" "></iframe>';
      }
    });
  };

  document.querySelectorAll('.process').forEach(button => {
    button.addEventListener('click', async function () {
      const id = this.dataset.id;

      button.disabled = true;

          try {
      const response = await fetch('updateProcessSupplier', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id : id }) // 🔥 payload
      });

      const result = await response.json();

      // 🔹 HANDLE RESPONSE
      if (result.status === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: result.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.href = "<?= base_url('data-supplier'); ?>";
          });
      } else {
        alert(result.message);
      }

    } catch (error) {
      alert('Terjadi kesalahan');
      console.error(error);
    }
    });
  });
</script>