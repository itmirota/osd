<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row">
      <div class="text-center mt-4 alert alert-primary" role="alert">
        <h2 class="font-dark">Anda Mengakses <strong>Admin Panel</strong> !</h2>
        <p class="font-dark m-0">
        halaman khusus untuk admin,
        </p>
        <p class="font-dark m-0">
        jika anda bukan admin silahkan kembali ke halaman <a href="<?= base_url(); ?>"><strong style="color:black">User</strong></a>
        </p>
      </div>
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table">
        <div class="d-table-cell align-middle">
          <?php $this->load->helper('form'); ?>
            <div class="row m-4">
              <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">', ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); ?>
              </div>
            </div>
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if ($error) {
            ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php echo $error; ?>
              </div>
            <?php }
            $success = $this->session->flashdata('success');
            if ($success) {
            ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php echo $success; ?>
              </div>
            <?php } ?>

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-center">
                <img src="<?= base_url('assets/images/osd.png')?>" style="max-width:300px; width:100%">
              </div>
              <div class="m-sm-3">
                <form action="<?= base_url('admin-login'); ?>" method="post">
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control form-control-sm" type="text" name="username" placeholder="Masukkan Username disini" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-sm" type="password" name="password" placeholder="Masukkan password disini" />
                  </div>
                  <div class="d-grid gap-2 mt-3">
                    <button type="sibmit" class="btn btn-sm btn-primary">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="text-center mb-3 font-dark">
            Login sebagai <a href="<?= base_url(); ?>"><strong style="color:black">User</strong></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>