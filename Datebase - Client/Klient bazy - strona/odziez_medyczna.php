
<html lang="pl">
<link rel="stylesheet" href="styl.css" type="text/css" />
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Odzież medyczna</title>
<link rel="stylesheet" href="styl.css" type="text/css" />
</head>

<body>
<center>
<section>
<header>
<img class="img" src="logo.png">
<h2><a href="index.php">Pogotowie Ratunkowe</a></h2>
</header>
<div class="content">
<nav>
<ul>
<li><a class="btn" href="index.php">Start</a></li>
<li><a class="btn" href="Lekarze.php">Lekarze</a></li>
<li><a class="btn" href="Ratownicy.php">Ratownicy</a></li>
<li><a class="btn" href="Kierowcy.php">Kierowcy</a></li>
<li><a class="btn" href="Pacjenci.php">Pacjenci</a></li>
<li><a class="btn" href="Karetki.php">Karetki</a></li>
<li><a class="btn" href="Dyzury.php">Dyżury</a></li>
<li><a class="btn" href="Odziez_medyczna.php">Odzież medyczna</a></li>
<li><a class="btn" href="Zarobki.php">Zarobki</a></li>
<li><a class="btn" href="Zgloszenia.php">Zgłoszenia</a></li>
</ul>
</nav>
</div>


</section>

<div class = "smalldiv"></div>

<div class="artykul">
 <article>
    <h1>Odzież medyczna</h1>
 </article>
 
 <center>
 
	<?php
	$conn = oci_connect("pogotowie_ratunkowe", "7890", "//localhost/XEPDB1", "AL32UTF8");
	if (!$conn) {
	  $m = oci_error();
	  echo $m['message'], "\n";
	  exit;
	}
	else{
		$stid = oci_parse($conn, 'SELECT nr_zestawu_odziezy, typ_odziezy, damska_czy_meska, id_ratownika FROM odziez_medyczna');
		
		oci_execute($stid);
		
		echo "<table border='1'>";
		
		echo "<tr><th>" . "Nr zestawu odzieży" . "</th><th>" . "Typ odzieży" . "</th><th>" . "Damska czy męska" . "</th><th>" . "ID ratownika" . "</th></tr>";
		
		while(($row = oci_fetch_array($stid, OCI_BOTH))!=false){
			echo "<tr><td>" . $row['NR_ZESTAWU_ODZIEZY'] . "</td><td>" . $row['TYP_ODZIEZY'] . "</td><td>" . $row['DAMSKA_CZY_MESKA'] . "</td><td> " . $row['ID_RATOWNIKA'] . "</td></tr>";
		}
		echo "</table>";
	}
	oci_close($conn);
?>
</center>
</div>
</center>

<center>
<b>Dodaj informacje o nowej odzieży medycznej</b>
 <form enctype="multipart/form-data" action="odziez_medyczna.php" method="post">
        <p>Nr zestawu odzieży:  <input type="text" id="name" 						name="zm1" maxlength="20" /></p>
        <p>Typ odzieży  <input type="text" id="name" 	name="zm2" maxlength="15" /></p>
        <p>Damska czy męska:  <input type="text" id="name" 				name="zm3" maxlength="20" /></p>
        <p>ID ratownika:  <input type="text" id="name"	name="zm4" maxlength="20" /></p>
        <input type="submit" value="Wyślij" id="submit"/>
</form>
</center>
        
<?php


if(isset($_POST['zm1']) and isset($_POST['zm2']) and $_POST['zm3'] and $_POST['zm4']) {
	
$v1=$_POST['zm1'];
$v2=$_POST['zm2'];
$v3=$_POST['zm3'];
$v4=$_POST['zm4'];

$conn = oci_connect("pogotowie_ratunkowe", "7890", "//localhost/XEPDB1", "AL32UTF8");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	else{
		
		
		$sql = 'INSERT INTO odziez_medyczna (nr_odziezy_medycznej, typ_odziezy, damska_czy_meska, id_ratownika) '. 'VALUES(:v1, :v2, :v3, :v4)';
		
		$stid = oci_parse($conn, $sql);
		
		oci_bind_by_name($stid, ':v1', $v1);
		oci_bind_by_name($stid, ':v2', $v2);
		oci_bind_by_name($stid, ':v3', $v3);
		oci_bind_by_name($stid, ':v4', $v4);
		
		oci_execute($stid);
		
	}	
	
}
?>

</body>

</html>