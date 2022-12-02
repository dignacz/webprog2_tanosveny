<?php

 ?>  

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src = "js/jquery.min.js"></script>
<script type="text/javascript" src = "js/ajax.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
<h1>Tanösvény információk:</h1>
    <div id = 'informaciosdiv'>
      <div id = 'tanosvenyinfo'>
        <span class="cimke">Tanösvény neve:</span><span id="nev" class="adat"></span><br>
		<br>
	    <br>
        <span class="cimke">Útvonal hossza (km):</span><span id="hossz" class="adat"></span><br>
        <br>
        <br>
        <span class="cimke">Útvonal lévő állomások száma:</span><span id="allomas" class="adat"></span><br>
        <br>
        <br>
        <span class="cimke">Útvonal bejáráshoz tervezett idő (óra):</span><span id="ido" class="adat"></span><br>
        <br>
        <br>
        <span class="cimke">Van idegenvezetés?:</span><span id="vezetes" class="adat"></span><br>
        <br>
      </div>
      <label for='npcimke'>Nemzeti Park:</label>
      <select id = 'npselect'></select>
      <br><br>
      <label for = 'varoscimke'>Település:</label>
      <select id = 'varosselect'></select>
      <br><br>
      <label for = 'varoscimke'>Tanösvény:</label>
      <select id = 'tanosvenyselect'></select>
    </div>

    <form method="post">  
      <input type="submit" name="create_pdf" class="btn btn-danger" value="PDF Exportálása" />  
    </form>  
</div>
</div>
</body>
</html>

<?php

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