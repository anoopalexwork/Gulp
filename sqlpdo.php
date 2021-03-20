<?php
  //$apikey= "bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA";
  //$qfid = $_GET["qfid"];

//$qlist = file_get_contents('https://api.nal.usda.gov/fdc/v1/food/522359?api_key=bDAddPeLmhGpRo1ZEvUe3C8YfNDRXk1WRsAjcqgA');
  //$qlist= file_get_contents('https://api.nal.usda.gov/fdc/v1/food/'.$qfid.'?api_key='.$apikey);




  $dsn = "mysql:host=localhost;dbname=gulp";
  $user = "root";
  $passwd = "sanct123";

  $pdo = new PDO($dsn, $user, $passwd);
  $stm = $pdo->query("SELECT * FROM Nutrition");
  echo "Selected<BR>";
  $records = $stm->fetchAll(PDO::FETCH_ASSOC);
  if (!$records) {echo "Fetch failed!"; return false;}
  else {echo "Got recs<BR>";}
  foreach ($records as $row){
    printf("{$row['fid']} {$row['name']}<BR>"); 
    //echo $row['fid']."|".$row['name']."<BR>";
  }

  ?>
