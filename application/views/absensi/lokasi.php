<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
      <a href="<?= base_url('laporanAbsensi')?>"><i class="fa fa-arrow-left"></i> kembali</a>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div id="map" style="width: 100%; height: 50vh;"></div>
          </div>
        </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<script>
  const map = L.map('map').setView([<?= $latitude ?>, <?= $longitude ?>], 18).invalidateSize();
      
  const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  const marker = L.marker([<?= $latitude ?>, <?= $longitude ?>]).addTo(map);

  const circle = L.circle([<?= $latitude ?>, <?= $longitude ?>], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 50
  }).addTo(map);
</script>
