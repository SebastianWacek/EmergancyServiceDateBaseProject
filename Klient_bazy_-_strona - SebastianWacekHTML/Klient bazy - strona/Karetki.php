
<html lang="pl">
<link rel="stylesheet" href="styl.css" type="text/css" />
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Karetki</title>
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
    <h1>Karetki</h1>
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
		$stid = oci_parse($conn, 'select id_karetki, rodzaj_karetki, nr_rejestracyjny, ilosc_miejsc_dla_pacjentow, miesieczna_liczba_kilometrow from karetki');
		
		oci_execute($stid);
		
		echo "<table border='1'>";
		
		echo "<tr><th>" . "Id_karetki" . "</th><th>" . "Rodzaj karetki" . "</th><th>" . "Nr rejestracyjny" . "</th><th>" . "Ilosc miejsc dla pacjentow" . "</th><th>" . "Miesieczna liczba kilometrow" . "</th></tr>";
		
		while(($row = oci_fetch_array($stid, OCI_BOTH))!=false){
			echo "<tr><td>" . $row['ID_KARETKI'] . "</td><td>" . $row['RODZAJ_KARETKI'] . "</td><td>" . $row['NR_REJESTRACYJNY'] . "</td><td> " . $row['ILOSC_MIEJSC_DLA_PACJENTOW'] . "</td><td> " . $row['MIESIECZNA_LICZBA_KILOMETROW'] ."</td></tr>";
		}
		echo "</table>";
		}
	oci_close($conn);
	?>
</center>
</div>

<center>
<b>Dodaj Karetkę</b>
 <form enctype="multipart/form-data" action="Karetki.php" method="post">
        <p>Id:  <input type="text" id="name" 						name="zm1" maxlength="20" /></p>
        <p>Rodzaj karetki:  <input type="text" id="name" 	name="zm2" maxlength="15" /></p>
        <p>Nr rejestracyjny:  <input type="text" id="name" 				name="zm3" maxlength="20" /></p>
        <p>Ilość miejsc dla pacjentów:  <input type="text" id="name"	name="zm4" maxlength="20" /></p>
        <p>Miesięczna liczba kilometrów:  <input type="text" id="name" 	name="zm5" maxlength="20" /></p>
        <input type="submit" value="Wyślij" id="submit"/>
</form>
</center>
        
<?php


if(isset($_POST['zm1']) and isset($_POST['zm2']) and $_POST['zm3'] and $_POST['zm4'] and $_POST['zm5']) {
	
$v1=$_POST['zm1'];
$v2=$_POST['zm2'];
$v3=$_POST['zm3'];
$v4=$_POST['zm4'];
$v5=$_POST['zm5'];

$conn = oci_connect("pogotowie_ratunkowe", "7890", "//localhost/XEPDB1", "AL32UTF8");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	else{
		
		
		$sql = 'INSERT INTO karetki (id_karetki, rodzaj_karetki, nr_rejestracyjny, ilosc_miejsc_dla_pacjentow, miesieczna_liczba_kilometrow) '. 'VALUES(:v1, :v2, :v3, :v4, :v5)';
		
		$stid = oci_parse($conn, $sql);
		
		oci_bind_by_name($stid, ':v1', $v1);
		oci_bind_by_name($stid, ':v2', $v2);
		oci_bind_by_name($stid, ':v3', $v3);
		oci_bind_by_name($stid, ':v4', $v4);
		oci_bind_by_name($stid, ':v5', $v5);
		
		oci_execute($stid);
		
	}


		
	
}
?>



<div class="artykul">
 <article>
    <h1>Przeglądy karetek</h1>
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
		$stid = oci_parse($conn, 'SELECT id_przegladu, typ_przegladu, data_wykonania, data_waznosci, id_karetki FROM przeglady_karetek');
		
		oci_execute($stid);
		
		echo "<table border='1'>";
		
		echo "<tr><th>" . "ID przeglądu" . "</th><th>" . "Typ przeglądu" . "</th><th>" . "Data wykonania" . "</th><th>" . "Data ważności" . "</th><th>" . "ID karetki" . "</th></tr>";
		
		while(($row = oci_fetch_array($stid, OCI_BOTH))!=false){
			echo "<tr><td>" . $row['ID_PRZEGLADU'] . "</td><td>" . $row['TYP_PRZEGLADU'] . "</td><td>" . $row['DATA_WYKONANIA'] . "</td><td> " . $row['DATA_WAZNOSCI'] . "</td><td> " . $row['ID_KARETKI'] ."</td></tr>";
		}
		echo "</table>";
	}
	oci_close($conn);
	?>
</center>
</div>
</center>

</center>
</div>

<center>
<b>Dodaj informacje o przeglądzie</b>
 <form enctype="multipart/form-data" action="Karetki.php" method="post">
        <p>Id:  <input type="text" id="name" 						name="zm1" maxlength="20" /></p>
        <p>Typ przeglądu:  <input type="text" id="name" 	name="zm2" maxlength="15" /></p>
        <p>Data wykonania:  <input type="text" id="name" 				name="zm3" maxlength="20" /></p>
        <p>Data ważności:  <input type="text" id="name"	name="zm4" maxlength="20" /></p>
        <p>ID karetki:  <input type="text" id="name" 	name="zm5" maxlength="20" /></p>
        <input type="submit" value="Wyślij" id="submit"/>
</form>
</center>
        
<?php


if(isset($_POST['zm1']) and isset($_POST['zm2']) and $_POST['zm3'] and $_POST['zm4'] and $_POST['zm5']) {
	
$v1=$_POST['zm1'];
$v2=$_POST['zm2'];
$v3=$_POST['zm3'];
$v4=$_POST['zm4'];
$v5=$_POST['zm5'];

$conn = oci_connect("pogotowie_ratunkowe", "7890", "//localhost/XEPDB1", "AL32UTF8");
if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	else{
		
		
		$sql = 'INSERT INTO przeglady_karetek (id_przegladu, typ_przegladu, data_wykonania, data_waznosci, id_karetki) '. 'VALUES(:v1, :v2, :v3, :v4, :v5)';
		
		$stid = oci_parse($conn, $sql);
		
		oci_bind_by_name($stid, ':v1', $v1);
		oci_bind_by_name($stid, ':v2', $v2);
		oci_bind_by_name($stid, ':v3', $v3);
		oci_bind_by_name($stid, ':v4', $v4);
		oci_bind_by_name($stid, ':v5', $v5);
		
		oci_execute($stid);
	}
		
	
}
?>
</body>

</html>