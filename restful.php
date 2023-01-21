<?php
$url = "http://localhost/webprog2_tanosveny/restful/szerver.php";
$result = "";
if(isset($_POST['id']))
{
  // Felesleges szóközök eldobása
  $_POST['id'] = trim($_POST['id']);
  $_POST['bn'] = trim($_POST['bn']);
  $_POST['ho'] = trim($_POST['ho']);
  $_POST['hu'] = trim($_POST['hu']);
  $_POST['md'] = trim($_POST['md']);
  
  // Ha nincs id és megadtak minden adatot (becenév, hobbi, hova utaznál, mit dolgozol), akkor beszúrás
  if($_POST['id'] == "" && $_POST['bn'] != "" && $_POST['ho'] != "" && $_POST['hu'] != "" && $_POST['md'] != "")
  {
      $data = Array("bn" => $_POST["bn"], "ho" => $_POST["ho"], "hu" => $_POST["hu"], "md" => $_POST["md"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha nincs id de nem adtak meg minden adatot
  elseif($_POST['id'] == "")
  {
    $result = "Hiba: Hiányos adatok!";
  }
  
  // Ha van id, amely >= 1, és megadták legalább az egyik adatot (becenév, hobbi, hova utaznál, mit dolgozol), akkor módosítás
  elseif($_POST['id'] >= 1 && ($_POST['bn'] != "" || $_POST['ho'] != "" || $_POST['hu'] != "" || $_POST['md'] != ""))
  {
      $data = Array("id" => $_POST["id"], "bn" => $_POST["bn"], "ho" => $_POST["ho"], "hu" => $_POST["hu"], "md" => $_POST["md"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, amely >=1, de nem adtak meg legalább az egyik adatot
  elseif($_POST['id'] >= 1)
  {
      $data = Array("id" => $_POST["id"]);
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch);
      curl_close($ch);
  }
  
  // Ha van id, de rossz az id, akkor a hiba kiírása
  else
  {
    echo "Hiba: Rossz azonosító (Id): ".$_POST['id']."<br>";
  }
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$tabla = curl_exec($ch);
curl_close($ch);

?>
<div class="container">
  <div class="row">

  <?php
if($userRole == 'admin' || $userRole == 'reguser'){
    // admin and reguser can access all pages
    $pageContent = $result .
    '<h1>VIP túrázók:</h1>' .
    $tabla .
    '<br>
    <h2>Módosítás / Beszúrás</h2>
    <form method="post">
    Id: <input type="text" name="id"><br><br>
    Becenév: <input type="text" name="bn" maxlength="45"> Hobbi: <input type="text" name="ho" maxlength="45"><br><br>
    Hova utaznál: <input type="text" name="hu" maxlength="12"> Mit dolgozol: <input type="text" name="md"><br><br>
    <input type="submit" value = "Küldés">
    </form>';

  } else {
    $pageContent = "<p>Nincs jogosultságod az oldal megtekintéséhez!</p>";
} 

echo $pageContent;

 ?>  
    </div>
</div>


