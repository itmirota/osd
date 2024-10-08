<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <div class="d-flex justify-content-end">
              <div class="p-2">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#filterAbsenToko">
                  Tambah Dokumen
                  </button>
              </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="filterAbsenToko" tabindex="-1" aria-labelledby="filterAbsenTokoLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Dokumen</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="<?=base_url('dokumenLegal/save')?>" role="form" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                            <input type="text" class="form-control" name="nama_dokumen">
                        </div>
                        <div class="mb-3">
                          <label for="nama_dokumen" class="form-label">File Dokumen</label>
                          <input type="file" name="dokumen" class="form-control" required>
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
      <div class="card-body table-responsive no-padding">
        <table id="dataTable" class="table table-hover">
          <thead>
          <tr>
              <th width="40px">No</th>
              <th>Nama Dokumen</th>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Dokumen</th>
          </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach($list_data as $ld){?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $ld->nama_dokumen ?></td>
              <td class="text-center"><?= mediumdate_indo($ld->tgl_input) ?></td>
              <td class="text-center">
                <a href="#" data-bs-toggle="modal" data-bs-target="#dokumenLegal" onclick= "showDokumen(<?= $ld->id_dokumen ?>)"><i class="fa-solid fa-file-pdf"></i></a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dokumenLegal" tabindex="-1" aria-labelledby="absenTokoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="titleAddPegawai">Dokumen Legal</h1>
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
      url:"<?php echo site_url("dokumenLegal/getDokumen")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil)
        const file = "<?= site_url("assets/dokumen_legal")?>/" + hasil.file_dokumen;
        document.getElementById("dokumen").innerHTML = '<iframe src="'+ file + '" frameborder="0" style="width:100%; height:400px;" "></iframe>';
      }
    });
  };

  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }
</script>