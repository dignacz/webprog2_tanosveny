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
$menu = []; 
$next = [0];
if(isset($_SESSION['jogosultsag'])) {
  $userRole = $_SESSION['jogosultsag']; // Get user role from session variable
} else {
  $userRole = 'latogato'; // default role
}
while (true) {
  $stmt = $pdo->prepare(sprintf(
    "SELECT * FROM `menu_items` WHERE `parent_id` IN (%s)",
    implode(",", $next)
  ));
  $stmt->execute();
  $next = [];
  while ($r = $stmt->fetch()) {
    if (!isset($menu[$r["parent_id"]])) { $menu[$r["parent_id"]] = []; }
    if($userRole == 'admin' || $userRole == $r["jogosultsag"] || ($r["jogosultsag"] == 'latogato' && $userRole == 'reguser')){
        if ($r["parent_id"] != 0) {
            if (!isset($menu[$r["parent_id"]]['submenu'])) {
                $menu[$r["parent_id"]]['submenu'] = [];
            }
            $menu[$r["parent_id"]]['submenu'][$r["item_id"]] = $r;
        } else {
            $menu[$r["parent_id"]][$r["item_id"]] = $r;
        }
        $next[] = $r["item_id"];
    }
  }
  if (count($next) == 0) { break; }
}




/*// (C) DISPLAY MENU ITEMS
// ITERATE OVER ARRAY TO DISPLAY MENU
function display_menu($menu, $parent_id = 0, $level = 0) {
    if (isset($menu[$parent_id])) {
        echo "<ul>";
        foreach ($menu[$parent_id] as $item) {
            echo "<li>";
            echo "<a href='" . $item["item_link"] . "'>" . $item["item_text"] . "</a>";
            display_menu($menu, $item["item_id"], $level + 1);
            echo "</li>";
        }
        echo "</ul>";
    }
}
display_menu($menu);*/

// (D) CLOSE DATABASE CONNECTION
$stmt = null;
$pdo = null;


?>