
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
</div>
</div>
</body>
