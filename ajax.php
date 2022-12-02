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
        }
      }
      catch(PDOException $e) {
      }
      echo json_encode($eredmeny);
      break;
  }

  if(isset($_POST["create_pdf"]))  
  {  
       require_once('TCPDF/tcpdf.php');  
       $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
       $obj_pdf->SetCreator(PDF_CREATOR);  
       $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
       $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
       $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
       $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
       $obj_pdf->SetDefaultMonospacedFont('helvetica');  
       $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
       $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
       $obj_pdf->setPrintHeader(false);  
       $obj_pdf->setPrintFooter(false);  
       $obj_pdf->SetAutoPageBreak(TRUE, 10);  
       $obj_pdf->SetFont('helvetica', '', 12);  
       $obj_pdf->AddPage();   
       $content = '';
       $obj_pdf->writeHTML($content);  
       $obj_pdf->Output('sample.pdf', 'I');  
  }  

?>