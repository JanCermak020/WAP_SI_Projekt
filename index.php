<?php
  require 'mysql.php';
  $conn= new Mysql;
  $conn->connect("localhost",'root',"",'armouredboard');
  error_reporting(0);
    $zaklad="3ite";
    $zaklad2="test";
    if($_GET["vehicle"]!=null){
      $zaklad=$_GET["vehicle"];}
    if($_GET["vehicle2"]!=null){
    $zaklad2=$_GET["vehicle2"];
    }
    $vehicle=$conn->select("SELECT * FROM vehicle WHERE model='".$zaklad."';");
    $vehicle2=$conn->select("SELECT * FROM vehicle WHERE model='".$zaklad2."';")

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Information about variants of Swedish CV90">
  <meta name="keywords" content="CV90, IFV, Swedish IFV, CV90 Tree">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tank Comparision</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <div class="container">
    <div class="left-section">
      <h1><?php print($vehicle[0]["model"]) ?></h1>
      <div class="popup-list">
        <form id="form" action="index.php" method="get">

          <?php
          print("<select name='vehicle' id='vehicle'>");
          for($i=0;$i<count($conn->select('SELECT * FROM vehicle;'));$i++){
            echo("<option value=".$conn->select('SELECT * FROM vehicle;')[$i]["model"].">".$conn->select('SELECT * FROM vehicle;')[$i]["model"]."</option>");}
            print("</select>");
          for ($i =0;$i<count($conn->select("SELECT * FROM vehicle_has_manufacturer WHERE vehicle_idVehicle='".$vehicle[0]["idVehicle"]."';"));$i++){
            $idManufacturer=$conn->select("SELECT * FROM vehicle_has_manufacturer WHERE vehicle_idVehicle='".$vehicle[0]["idVehicle"]."';")[$i]["manufacturer_idmanufacturer"];
            $Manufacturer.=($conn->select("SELECT * FROM manufacturer WHERE idManufacturer=$idManufacturer")[0]["name"].",");
          }
          for($i =0;$i<count($conn->select("SELECT * FROM vehicle_has_manufacturer WHERE vehicle_idVehicle='".$vehicle2[0]["idVehicle"]."';"));$i++){
            $idManufacturer2=$conn->select("SELECT * FROM vehicle_has_manufacturer WHERE vehicle_idVehicle='".$vehicle2[0]["idVehicle"]."';")[$i]["manufacturer_idmanufacturer"];
            $Manufacturer2.=($conn->select("SELECT * FROM manufacturer WHERE idManufacturer=$idManufacturer2")[0]["name"].",");}
          ?>
          <br><br>
          <input type="submit" value="Submit">
          </form>
      </div>
      <div class="section">
        <p><b>Manufacturer:</b><?php  print($Manufacturer) ?> </p>
        <p><b>MainWeapon:</b><?php print($vehicle[0]["mainWeapon"]) ?></p>
        <p><b>SecondaryWeapon:</b> <?php print($vehicle[0]["secondaryWeapon"]) ?></p>
        <p><b>Power-Pack:</b> <?php print($vehicle[0]["powerPack"]) ?></p>
        <p><b>TopSpeed:</b> <?php print($vehicle[0]["topSpeed"]) ?></p>
        <p><b>Weight:</b> <?php print($vehicle[0]["weight"]) ?></p>
        <p><b>Height:</b> <?php print($vehicle[0]["height"]) ?></p>
        <p><b>Length:</b> <?php print($vehicle[0]["lenght"]) ?></p>
        <p><b>Width:</b> <?php print($vehicle[0]["width"]) ?></p>
        <p><b>Crew:</b> <?php print($vehicle[0]["crew"]) ?></p>
        <p><b>InUse:</b> <?php if($vehicle[0]["inUse"]==1){print("ano");}else{print("ne");} ?></p>
        <p><b>Description:</b> <?php print($vehicle[0]["description"]) ?></p>
      </div>
    </div>
    <div class="right-section">
      <h1><?php print($vehicle2[0]["model"]) ?></h1>
        <form id="form2"  action="index.php" method="get">
            <?php
            print("<select name='vehicle2' id='vehicle2'>");
            for($i=0;$i<count($conn->select('SELECT * FROM vehicle;'));$i++){
              echo("<option value=".$conn->select('SELECT * FROM vehicle;')[$i]["model"].">".$conn->select('SELECT * FROM vehicle;')[$i]["model"]."</option>");
            }
            print("</select>");
          ?>
          <br><br>
          <input type="submit" value="Submit">
        </form>
      <div class="section">
        <p><b>Manufacturer:</b><?php print($Manufacturer2) ?> </p>
        <p><b>MainWeapon:</b><?php print($vehicle2[0]["mainWeapon"]) ?></p>
        <p><b>SecondaryWeapon:</b> <?php print($vehicle2[0]["secondaryWeapon"]) ?></p>
        <p><b>Power-Pack:</b> <?php print($vehicle2[0]["powerPack"]) ?></p>
        <p><b>TopSpeed:</b> <?php print($vehicle2[0]["topSpeed"]) ?></p>
        <p><b>Weight:</b> <?php print($vehicle2[0]["weight"]) ?></p>
        <p><b>Height:</b> <?php print($vehicle2[0]["height"]) ?></p>
        <p><b>Length:</b> <?php print($vehicle2[0]["lenght"]) ?></p>
        <p><b>Width:</b> <?php print($vehicle2[0]["width"]) ?></p>
        <p><b>Crew:</b> <?php print($vehicle2[0]["crew"]) ?></p>
        <p><b>InUse:</b> <?php if($vehicle2[0]["inUse"]==1){print("ano");}else{print("ne");} ?></p>
        <p><b>Description:</b> <?php print($vehicle2[0]["description"]) ?></p>
      </div>
  </div>
  <div class="bottom-row scrollable-table">
    <table class="table">
      <tr>
        <th>Model</th>
        <th>Manufacturer:</th>
        <th>MainWeapon:</th>
        <th>SecondaryWeapon:</th>
        <th>Power-Pack:</th>
        <th>TopSpeed:</th>
        <th>Weight:</th>
        <th>Height:</th>
        <th>Length:</th>
        <th>Width:</th>
        <th>Crew:</th>
        <th>InUse:</th>
        <th>Description:</th>
      </tr>
      <tr>
        <td><?php print($vehicle[0]["model"])?></td>
        <td><?php print($Manufacturer)?></td>
        <td><?php print($vehicle[0]["mainWeapon"])?></td>
        <td><?php print($vehicle[0]["secondaryWeapon"])?></td>
        <td><?php print($vehicle[0]["powerPack"])?></td>
        <td><?php print($vehicle[0]["topSpeed"])?></td>
        <td><?php print($vehicle[0]["weight"])?></td>
        <td><?php print($vehicle[0]["height"])?></td>
        <td><?php print($vehicle[0]["lenght"])?></td>
        <td><?php print($vehicle[0]["width"])?></td>
        <td><?php print($vehicle[0]["crew"])?></td>
        <td><?php if($vehicle[0]["inUse"]==1){print("ano");}else{print("ne");} ?></td>
        <td><?php print($vehicle[0]["description"])?></td>
      </tr>
      <tr>
        <td><?php print($vehicle2[0]["model"])?></td>
        <td><?php print($Manufacturer2)?></td>
        <td><?php print($vehicle2[0]["mainWeapon"])?></td>
        <td><?php print($vehicle2[0]["secondaryWeapon"])?></td>
        <td><?php print($vehicle2[0]["powerPack"])?></td>
        <td><?php print($vehicle2[0]["topSpeed"])?></td>
        <td><?php print($vehicle2[0]["weight"])?></td>
        <td><?php print($vehicle2[0]["height"])?></td>
        <td><?php print($vehicle2[0]["lenght"])?></td>
        <td><?php print($vehicle2[0]["width"])?></td>
        <td><?php print($vehicle2[0]["crew"])?></td>
        <td><?php if($vehicle2[0]["inUse"]==1){print("ano");}else{print("ne");} ?></td>
        <td><?php print($vehicle2[0]["description"])?></td>
      </tr>
    </table>    
  </div>
</body>
</html>
