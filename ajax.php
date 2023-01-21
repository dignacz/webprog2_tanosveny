<?php

  switch($_POST['op']) {
    case 'np':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=webprog2_tanosveny', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->query("select np.id, nev from np");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
     
      echo json_encode($eredmeny);
      break;
    case 'varos':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=webprog2_tanosveny', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select telepules.id, nev from telepules where npid = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['id'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
     
      echo json_encode($eredmeny);
      break;
    case 'tanosveny':
      $eredmeny = array("lista" => array());
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=webprog2_tanosveny', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select azon, nev from ut where telepulesid = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny["lista"][] = array("id" => $row['azon'], "nev" => $row['nev']);
        }
      }
      catch(PDOException $e) {
      }
      
      echo json_encode($eredmeny);
      break; 
    case 'info':
      $eredmeny = array("nev" => "", "hossz" => "", "allomas" => "", "ido" => "", "vezetes" => "");
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=webprog2_tanosveny', 'root', '',
                      array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
        $stmt = $dbh->prepare("select nev, hossz, allomas, ido, vezetes from ut where azon = :id");
        $stmt->execute(Array(":id" => $_POST["id"]));
        if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $eredmeny = array("nev" => $row['nev'], "hossz" => $row['hossz'], "allomas" => $row['allomas'], "ido" => $row['ido'], "vezetes" => $row['vezetes']);
              $nev = $row['nev'];
              $hossz = $row['hossz'];
              $allomas = $row['allomas'];
              $ido = $row['ido'];
              $vezetes = $row['vezetes'];
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
  }


?>