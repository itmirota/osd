<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Getting Started with Chart JS with www.chartjs3.com</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
      }
      .chartMenu {
        width: 100vw;
        height: 40px;
        background: #1A1A1A;
        color: rgba(54, 162, 235, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
      }
    </style>
  </head>
  <body>
    <div class="chartMenu">
      <p>WWW.CHARTJS3.COM (Chart JS <span id="chartVersion"></span>)</p>
    </div>
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
    $.ajax({
    type : "GET",
    dataType : "JSON",
    url :  "<?= base_url(); ?>user/getChart",
    success : result => {
        let penambahan = result.penambahanKaryawan;
        let pengurangan = result.penguranganKaryawan;
        // setup 
        const data = {
        //   labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
            // label: 'Weekly Sales',
            data: penambahan,
            backgroundColor: [
            'rgba(255, 26, 104, 0.2)',
            ],
            borderColor: [
            'rgba(255, 26, 104, 1)',
            ],
            borderWidth: 1
        },
        {
            // label: 'Weekly Cost',
            data: pengurangan,
            backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
            'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
        };

        // config 
        const config = {
        type: 'line',
        data,
        options: {
            scales: {
            x: {
                type:'time',
                unit:'month'
            },
            y: {
                beginAtZero: true
            }
            }
        }
        };

        // render init block
        const myChart = new Chart(
        document.getElementById('myChart'),
        config
        );

        // Instantly assign Chart.js version
        const chartVersion = document.getElementById('chartVersion');
        chartVersion.innerText = Chart.version;
        }
    });
    
    </script>

  </body>
</html>