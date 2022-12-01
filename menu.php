<?php
// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!
$dbHost = "localhost";
$dbName = "webprog2_tanosveny";
$dbChar = "utf8";
$dbUser = "root";
$dbPass = "";
$pdo = new PDO(
  "mysql:host=$dbHost;dbname=$dbName;charset=$dbChar",
  $dbUser, $dbPass, [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

// (B) DRILL DOWN GET MENU ITEMS
// ARRANGE BY [PARENT ID] => [MENU ITEMS]
$menu = []; $next = [0];
while (true) {
  $stmt = $pdo->prepare(sprintf(
    "SELECT * FROM `menu_items` WHERE `parent_id` IN (%s)",
    implode(",", $next)
  ));
  $stmt->execute();
  $next = [];
  while ($r = $stmt->fetch()) {
    if (!isset($menu[$r["parent_id"]])) { $menu[$r["parent_id"]] = []; }
    $menu[$r["parent_id"]][$r["item_id"]] = $r;
    $next[] = $r["item_id"];
  }
  if (count($next) == 0) { break; }
}

// (C) CLOSE DATABASE CONNECTION
$stmt = null;
$pdo = null;