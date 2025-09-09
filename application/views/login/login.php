<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h2 class="font-dark">Selamat Datang!</h2>
            <p class="font-dark">
            Apa kabar di hari <b><?= hari_indo(DATE('l')) ?></b> ini? sehat selalu, semangat terus yaa..
            </p>
          </div>

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
              <div class="d-grid gap-2 mt-3">
                <a href="<?=$this->userlogin->oauth2_google()['urlOauth2']?>" class="btn btn-sm btn-outline-dark">
                  <svg width="15px" height="15px" viewBox="-0.5 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Google-color</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Color-" transform="translate(-401.000000, -860.000000)"> <g id="Google" transform="translate(401.000000, 860.000000)"> <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"> </path> <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"> </path> <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"> </path> <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"> </path> </g> </g> </g> </g></svg> Sign in with Google
                </a>
                <a href="#" onclick="loginForm()" class="btn btn-sm btn-outline-dark">
                  <svg width="15px" height="15px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="user-circle-2" transform="translate(-2 -2)"> <path id="secondary" fill="#2ca9bc" d="M12,3A9,9,0,0,0,5.55,18.27a7,7,0,0,1,4.28-3.92h0a4,4,0,1,1,4.34,0h0a7,7,0,0,1,4.28,3.92A9,9,0,0,0,12,3Z"></path> <path id="primary" d="M16,11a4,4,0,1,1-4-4A4,4,0,0,1,16,11Zm-1.83,3.35a3.95,3.95,0,0,1-4.34,0,7,7,0,0,0-4.28,3.92,9,9,0,0,0,12.81.09l.09-.09a7,7,0,0,0-4.28-3.92ZM21,12h0a9,9,0,0,0-9-9h0a9,9,0,0,0-9,9H3a9,9,0,0,0,9,9h0a9,9,0,0,0,9-9Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.38"></path> </g> </g></svg> Sign in with Account
                </a>
              </div>

              <div class="m-sm-3" id="formLogin">
                <form action="<?php echo base_url(); ?>loginMe" method="post">            
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control form-control-sm" type="text" name="username" placeholder="Masukkan Username disini" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control form-control-sm" type="password" name="password" placeholder="Masukkan password disini" />
                  </div>
                  <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-sm btn-primary">Sign in</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="text-center mb-3 font-dark">
            Login sebagai <a href="<?php base_url(); ?>login/admin"><strong style="color:black">Admin</strong></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  function loginForm(){
	  // $("#formLogin").show();

  const x = document.getElementById("formLogin");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
  }
</script>