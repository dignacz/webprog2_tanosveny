<?php

class UserRole {
  private $userRole;

  public function __construct() {
    if(isset($_SESSION['jogosultsag'])) {
      $this->userRole = $_SESSION['jogosultsag']; 
    } else {
      $this->userRole = 'latogato';
    }
  }

  public function getPageContent() {
    if($this->userRole == 'admin'){
      $pageContent = '<h1 id="title">Drum 🥁 Kit</h1>
      <div class="set">
        <button class="w drum">w</button>
        <button class="a drum">a</button>
        <button class="s drum">s</button>
        <button class="d drum">d</button>
        <button class="j drum">j</button>
        <button class="k drum">k</button>
        <button class="l drum">l</button>';
    } else if ($this->userRole != 'admin'){
        $pageContent = "<p>Nincs jogosultságod az oldal megtekintéséhez!</p>";
    }
    return $pageContent;
  }
}

$user = new UserRole();

?>
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row">
      <?php echo $user->getPageContent(); ?>
    </div>
    <script type="text/javascript" src="js/index.js"></script>
  </div>
</body>
</html>
