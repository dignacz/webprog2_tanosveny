<div class="container">
  <div class="row">

<?php

 function create_table($array, $table = true)
{
    $out = '';
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            if (!isset($tableHeader)) {
                $tableHeader =
                    '<th>' .
                    implode('</th><th>', array_keys($value)) .
                    '</th>';
            }
            array_keys($value);
            $out .= '<tr>';
            $out .= create_table($value, false);
            $out .= '</tr>';
        } else {
            $out .= "<td> $value </td>";
        }
    }

    if ($table) {
        echo '<div class="tabla"><table>' . $tableHeader . $out . '</table></div>';
    } else {
        return $out;
    }
} 

function get_rest()
{
	$url = "https://gorest.co.in/public/v1/users?access-token=d2f43f529fb4148f1318b693f3318531d7f45b9d6290d94d68d8ddfe4aec11d1";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$tabla = curl_exec($ch);
	curl_close($ch);
	$_POST['tabla'] = json_decode($tabla, JSON_PRETTY_PRINT);
	return $_POST['tabla'];
}

function post_rest()
{
	$url = "https://gorest.co.in/public/v1/users?access-token=d2f43f529fb4148f1318b693f3318531d7f45b9d6290d94d68d8ddfe4aec11d1";
	$adatok = array(
		"name" => "Karen Watts",
		"email" => "bryce97@ntwteknoloji.com",
		"gender" => "female",
		"status" => "active"
	);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($adatok));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$post = curl_exec($ch);
		curl_close($ch);
		echo '<h2>A bejegyzett adatok: ' . $post . '</h2>';
}

function kiir_rest()
{
	$url = "https://gorest.co.in/public/v1/users/3276?access-token=d2f43f529fb4148f1318b693f3318531d7f45b9d6290d94d68d8ddfe4aec11d1";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$kiir = curl_exec($ch);
	curl_close($ch);
	echo '<h2>A bejegyzett adatok: ' . $kiir . '</h2>';
}
	
function put_rest() {
    $url = "https://gorest.co.in/public/v1/users/3276";
    $access_token = "d2f43f529fb4148f1318b693f3318531d7f45b9d6290d94d68d8ddfe4aec11d1";
    $data = array("name" => "Zaina Mcmillan");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        "Authorization: Bearer $access_token"
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}


function delete_rest()
{
	$url = "https://gorest.co.in/public/v1/users/3272?access-token=d2f43f529fb4148f1318b693f3318531d7f45b9d6290d94d68d8ddfe4aec11d1";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$del = curl_exec($ch);
	curl_close($ch);
	echo '<h2>Az adatok törlődtek!</h2>';
}

if(isset($_POST['lekerdezes'])) { 
	get_rest(); 
	create_table($_POST['tabla']['data']);
}
if(isset($_POST['beiras'])) { 
	post_rest();
	//kiir_rest();
}
if(isset($_POST['atiras'])) { 
	put_rest(); 
	kiir_rest();
}
if(isset($_POST['torles'])) { 
	delete_rest(); 
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>
    <body>
        <div class="hatter hatter-1 hatter-1-s">
            <div class="uzenet uzenet-1 uzenet-1-s">
    		    <h2 class="h2-1 h2-1-s">API Web Client</h2>
				<form class="buttons buttons-1 buttons-1-s " method="post">
    		    	<input type="submit" class="btn btn-primary" name="lekerdezes" value="GET" />
					<input type="submit" class="btn btn-success" name="beiras" value="POST" />
					<input type="submit" class="btn btn-warning" name="atiras" value="PUT" />
					<input type="submit" class="btn btn-danger" name="torles" value="DELETE" />
				</form>
			</div>
		</div>
	</body>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>	
<br><br>
<br><br>	
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>	
<br><br>
<br><br>	
<br><br>
<br><br>	
<br><br>
<br><br>	
</html>
</div>
</div>