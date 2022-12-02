
<?php 
try {
  $pdo = new PDO('mysql:host=localhost;dbname=webprog2_tanosveny', 'root', '');
  // Set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
  die("ERROR: Could not connect. " . $e->getMessage());
  mysqli_set_charset($pdo,'utf8');
}


/* function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
} */

// Attempt select query execution
try{
    $sql= "SELECT `np`.`nev` as `npnev`, count(`ut`.`nev`) as `mennyiseg` from `ut` Inner JOIN `telepules` on `ut`.`telepulesid`=`telepules`.`id` inner join `np` on `telepules`.`npid`=`np`.`id` group by `npnev`";   
    $result = $pdo->query($sql);
    if($result->rowCount() > 0) {
       $mennyiseg = array();
       $npnev = array(); 

      while($row = $result->fetch()) {
        $mennyiseg[]=$row["mennyiseg"];
        $npnev[]=$row["npnev"];
      }
  
    unset($result);
    } else {
      echo "No records matching your query were found.";
    }
  } catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }

 /* echo print_r(json_encode($mennyiseg));
  echo print_r(json_encode($npnev)); */
   
  // Close connection
  unset($pdo);
?>
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
        color: rgba(255, 26, 104, 1);
      }
      .chartMenu p {
        padding: 10px;
        font-size: 20px;
      }
      .chartCard {
        width: 100vw;
        height: calc(100vh - 40px);
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .chartBox {
        width: 700px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(255, 26, 104, 1);
        background: white;
      }
    </style>

<div class="container">
  <div class="row">
  <p><strong>Tanösvények száma / Nemzeti Park</strong></p>
    <div class="chartCard">
      <div class="chartBox">
        <canvas id="myChart"></canvas>
      </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    
    // setup 
    const mennyiseg = <?php echo json_encode($mennyiseg); ?>
    const npnev = <?php echo json_encode($npnev); ?>
    const data = {
      labels: npnev,
      datasets: [{
        label: 'Tanösvények száma',
        data: mennyiseg,
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        scales: {
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
    </script>
  </div>
</div>
