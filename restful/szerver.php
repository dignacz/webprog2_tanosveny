<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=webprog2_tanosveny', 'root', '',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM restful";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>Becenév</th><th>Hobbi</th><th>Hova utaznál</th><th>Mit Dolgozol</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				/*
				echo $incoming;
				print_r($data);
				print_r($_POST);
				*/
				$sql = "insert into restful values (0, :bn, :ho, :hu, :md)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":bn"=>$data["bn"], ":ho"=>$data["ho"], ":hu"=>$data["hu"], ":md"=>$data["md"]));
				//$count = $sth->execute(Array(":bn"=>$_POST["bn"], ":un"=>$_POST["un"], ":bn"=>$_POST["bn"], ":jel"=>$_POST["jel"]));				
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." beszúrt sor: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['bn'] != "") {$modositando .= ", becenev = :bn"; $params[":bn"] = $data["bn"];}
				if($data['ho'] != "") {$modositando .= ", hobbi = :ho"; $params[":ho"] = $data["ho"];}
				if($data['hu'] != "") {$modositando .= ", hova_utaznal = :hu"; $params[":hu"] = $data["hu"];}
				if($data['md'] != "") {$modositando .= ", mit_dolgozol = :md"; $params[":md"] = $data["md"];}
				$sql = "update restful set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from restful where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>