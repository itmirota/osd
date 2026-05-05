<div class="container">
  <h3>Persetujuan Cuti</h3>
  <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Tindakan
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="<?= base_url($page_approval.'?d='.urlencode(base64_encode($cuti->id_cuti)).'&ap='.urlencode(base64_encode($approval->id_pegawai)).'&st=Y') ?>">Approve</a></li>
    <li><a class="dropdown-item" href="<?= base_url($page_approval.'?d='.urlencode(base64_encode($cuti->id_cuti)).'&ap='.urlencode(base64_encode($approval->id_pegawai)).'&st=T') ?>">Tolak</a></li>
    <?php if($role == ROLE_HRGA){?>
    <li><a href="#" class="decline dropdown-item" data-id="<?= $cuti->id_cuti ?>">Decline</a></li>
    <?php } ?>
  </ul>
  <div class="row">
    <div class="col-md-8">
      <div class="card my-4">
        <div class="card-body">
          <h4 class="my-2"><i class="fa fa-solid fa-circle-info"></i> Informasi Approval</h4>
          <div class="mb-3 row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Approval</label>
            <div class="col-sm-6">
              <input type="text" readonly class="form-control-plaintext" id="nama" value="<?= $approval->nama_pegawai?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="nama" class="col-sm-4 col-form-label">Jabatan</label>
            <div class="col-sm-6">
              <input type="text" readonly class="form-control-plaintext" id="nama" value="<?= $approval->nama_jabatan?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="nama" class="col-sm-4 col-form-label">Bagian/Divisi</label>
            <div class="col-sm-6">
              <input type="text" readonly class="form-control-plaintext" id="nama" value="<?=$approval->nama_bagian.'/'.$approval->nama_divisi?>">
            </div>
          </div>
        </div>
      </div>
      <div class="card my-4">
        <div class="card-body">
          <h4 class="my-2"><i class="fa fa-solid fa-circle-info"></i> Permohonan Cuti</h4>
                    <div class="mb-3 row">
            <label for="nama" class="col-sm-4 col-form-label">Nama Pemohon</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="nama" value="<?= $cuti->nama_pegawai?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="nama" class="col-sm-4 col-form-label">Bagian/Divisi</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="nama" value="<?=$cuti->nama_bagian.'/'.$cuti->nama_divisi?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Jabatan" class="col-sm-4 col-form-label">Jabatan</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="Jabatan" value="<?= $cuti->nama_jabatan ?>">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="Jenis" class="col-sm-4 col-form-label">Jenis</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="Jenis" value="<?= $cuti->jenis_cuti ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="diajukan" class="col-sm-4 col-form-label">Diajukan Pada</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="diajukan" value="<?= mediumdate_indo($cuti->tgl_pengajuan) ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="tgl_cuti" class="col-sm-4 col-form-label">Tanggal Cuti</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="tgl_cuti" value="<?= mediumdate_indo($cuti->tgl_mulai).' - '.mediumdate_indo($cuti->tgl_akhir) ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="durasi" class="col-sm-4 col-form-label">Lama Cuti</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="durasi" value="<?= $cuti->selisih+1 ?>">
            </div>
          </div>

          <div class="mb-3 row">
            <label for="alasan" class="col-sm-4 col-form-label">Alasan</label>
            <div class="col-sm-8">
              <input type="text" readonly class="form-control-plaintext" id="alasan" value="<?= $cuti->keperluan?>">
            </div>
          </div>
        </div>
      </div>
      <?php if(isset($cuti->bukti_cuti)){?>
      <div class="card my-4">
        <div class="card-body">
          <h4 class="my-2"><i class="fa fa-solid fa-file"></i> Bukti Cuti</h4>
          <?php $file = substr($cuti->bukti_cuti,-3); ?>
          <?php if($file == 'pdf'){?>
            <iframe src="<?= base_url('assets/bukti_cuti/'.$cuti->bukti_cuti) ?>" width="100%" height="600px"></iframe>
          <?php }else{?>
            <img id="myImg" src="<?= base_url('assets/bukti_cuti/'.$cuti->bukti_cuti) ?>" width="100%" height="400px" alt="Pemandangan Gunung">
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="col-md-4">
      <div class="card my-4">
        <div class="card-body">
          <h4 class="my-2"><i class="fa-solid fa-clock-rotate-left"></i> History Approval</h4>
            <?php foreach ($list_approval as $la){ ?> 
            <div class="alert alert-<?= ($la->status_approval == 'Y' ? 'success' : 'danger')?>" role="alert">
              <span><b><?= $la->nama_pegawai ?></b></span><br>
              <span style="font-size:12px"><?= ($la->status_approval == 'Y' ? 'approve' : ($la->status_approval == 'T' ? 'ditolak' : 'dibatalkan')).' - '.mediumdate_indo($la->tgl_approval) ?></span>
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener('click', function (e) {
  if (e.target.classList.contains('decline')) {

    e.preventDefault(); // 🔥 penting banget

    const button = e.target;
    const id = button.dataset.id;

    Swal.fire({
      title: 'Alasan Decline',
      input: 'textarea',
      inputPlaceholder: 'Masukkan keterangan...',
      showCancelButton: true,
      confirmButtonText: 'Submit',
      cancelButtonText: 'Batal',
      inputValidator: (value) => {
        if (!value) {
          return 'Keterangan wajib diisi!';
        }
      }
    }).then(async (result) => {

      if (result.isConfirmed) {

        const keterangan = result.value;

        button.disabled = true;
        button.innerText = 'Processing...';

        try {
          const response = await fetch('declineCuti', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              id: id,
              keterangan: keterangan
            })
          });

          const res = await response.json();

          if (res.status == 'success') {

				    location.reload();
          } 

        } catch (error) {
          button.disabled = false;
          button.innerText = 'Decline';

          Swal.fire('Error', 'Terjadi kesalahan', 'error');
        }

      }

    });
  }
});
</script>
<script>
  // Get the modal
  let modal = document.getElementById("myModal");

  // Get the image and insert it inside the modal - use its "alt" text as a caption
  let img = document.getElementById("myImg");
  let modalImg = document.getElementById("img01");
  let captionText = document.getElementById("caption");
  img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
  }

  // Get the <span> element that closes the modal
  let span = document.getElementsByClassName("close")[0];

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() { 
    modal.style.display = "none";
  }
</script>