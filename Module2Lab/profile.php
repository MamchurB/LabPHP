<?php
session_start();

require "Chart.php";
#use Chart;

if (!$_SESSION['user']) {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Банк</title>
    <link rel="stylesheet" href="chart/chart.css">
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="assets/css/main.css">
 <link  rel="stylesheet" href="assets/css/font.css">
    <script src="chart/ChartJS.min.js"></script>
</head>
<body>
    <div class="header">
  <div class="row" style="background-color:#f4511e;">
    <div class="col-lg-6" >
      <span class="logo"></span>
  </div>
    <div class="col-md-4 col-md-offset-2">
    
    </div>
  </div>
</div>

<div class="container">
<div class="row">
<div class="col-md-12">
    <!-- Профиль -->

    <form>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
        <a href="vendor/logout.php" class="logout">Вихід</a>
    </form>
    
<?php
$date = date_sub(date_create(date("Ymd")), date_interval_create_from_date_string('$i days'))->format('Ymd');
            $response = file_get_contents("https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date=$date&json");
            $response = json_decode($response, true);
?> 

<form method="post">
    <div>
        <select name="licenceOptions" class="custom-select" id="inputGroupSelect02" onChange="this.form.submit()">
            <option value = "1" selected> Немає валюти </option>
            <?php for( $i = 0; $i < 60; $i++){
    echo '<option value='.$i.'>'. $response[$i]['txt']. '</option>';
 }?> 
        </select>
        <noscript><input type="submit" value="Submit"/></noscript>
    </div>
</form>



<?php
    $ExchangeRate = array();
    $dateRate = array();
    if(isset($_POST['licenceOptions'])){
        
        for( $i = 0; $i < 7; $i++){
            $date = date_sub(date_create(date("Ymd")), date_interval_create_from_date_string("$i days"))->format('Ymd');
            $response = file_get_contents("https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?date=$date&json");
            $response = json_decode($response, true);
            $dateRate[] = $date[4].$date[5].'/'.$date[6].$date[7];
            $ExchangeRate[] = $response[$_POST['licenceOptions']]['rate'];
         }
    }
    $_SESSION['ExchangeRate'] =  $ExchangeRate;
    $_SESSION['dateRate'] = $dateRate;
?>

<div>
      <?php
      $lineChart = new Chart('line', 'exampleline');
      $lineChart->set('data', $ExchangeRate);
      $lineChart->set('legend', $dateRate);
      // We don't to use the x-axis for the legend so we specify the name of each dataset
      $lineChart->set('legendData', [$response[$_POST['licenceOptions']]['txt']]);
      $lineChart->set('displayLegend', true);
      echo $lineChart->returnFullHTML();
    ?>
        </div>
        </div></div></div></div>

<div>
    <center>
    <h4>Конвертер Валют</h4>

        <form>
    <div>
        <label>Сума</label>
        <input name = "sum" type="text" value = 1></label><br><br>
        <label>Конвертувати з</label>
        <select name="selectRate1" class="custom-select" id="inputGroupSelect02">
            <option value = "null" selected> Немає валюти </option>
            <?php for( $i = 0; $i < 60; $i++){
    echo '<option value='.$i.'>'. $response[$i]['txt']. '</option>';
 }?> 
        </select><br><br>
        <label>Конвертувати в </label>
         <select name="selectRate2" class="custom-select" id="inputGroupSelect02">
            <option value = "null" selected> Немає валюти </option>
            <?php for( $i = 0; $i < 60; $i++){
    echo '<option value='.$i.'>'. $response[$i]['txt']. '</option>';
 }?> 
        </select>
        <br><br><input type="submit" value="Converted" name = "Convert">
        <p><b>Результат</b></p>

    </div>
    </form>
    </center>
    <p>
<?php if(isset($_GET['Convert'])){
    echo "<center>". round($response[intval($_GET['selectRate1'])]['rate'] * floatval($_GET['sum'])/$response[intval($_GET['selectRate2'])]['rate'],4)."</center>";
    if(empty($dateRate)){
    $lineChart = new Chart('line', 'exampleline');
    $ExchangeRate = array(4.270, 4.270, 4.273, 4.243, 4.223, 4.243);
    $dateRate = array('20/12','19/12','18/12','17/12', '16/12', '15/12');
    $lineChart->set('data', $ExchangeRate);
    $lineChart->set('legend', $dateRate);
    $lineChart->set('legendData', [$response[$_POST['licenceOptions']]['txt']]);
    $lineChart->set('displayLegend', false);
    echo $lineChart->returnFullHTML();
    unset($_GET['Convert']);
}

    }
       ?></p>
</div>

</body>
</html>