<style>

.img-menu{
  min-width:50px; 
  max-width:150px; 
  width:100%; 
  padding:1rem;
  border-radius:25%;
  background: rgb(255,255,255);
  background: radial-gradient(circle, rgba(255,255,255,1) 19%, rgba(235,235,235,1) 71%);
}

.img-menu:hover{
  background: rgb(13,103,187,0.1);
}

</style>

<!-- Menu -->
<div class="d-flex flex-row justify-content-center m-5">
  <div class="col-3 m-4">
    <a href="<?= base_url('kebersihan/formulir') ?>">
      <div class="d-flex flex-column">
        <div class="d-flex justify-content-center mb-2">
          <img class="img-menu" src="<?= base_url('assets/images/cleaning.png')?>">
        </div>
        <div class="d-flex justify-content-center font-dark">
          Laporan Kebersihan
        </div>
      </div>
    </a>
  </div>
</div>
<!-- Menu -->
 