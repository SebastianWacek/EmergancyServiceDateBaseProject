<html>
<link rel="stylesheet" href="styl.css" type="text/css" />
<head>
<title>Lekarze</title>
<link rel="stylesheet" href="styl.css" type="text/css" />
</head>

<body>
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

<div class = "smalldiv"></div>

<div class="artykul">
 <article>
    <h1>Lekarze</h1>
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
		$stid = oci_parse($conn, 'SELECT id_lekarza, imie, nazwisko, wiek, specjalizacja, id_karetki FROM lekarze');
		
		oci_execute($stid);
		
		echo "<table border='1'>";
		echo "<tr><th>" . "ID lekarza" . "</th><th>" . "Imie" . "</th><th>" . "Nazwisko" . "</th><th>" . "Wiek" . "</th><th>" . "Specjalizacja" . "</th><th>" . "ID karetki" . "</th></tr>";
		
		while(($row = oci_fetch_array($stid, OCI_BOTH))!=false){
		echo "<tr><td>" . $row['ID_LEKARZA'] . "</td><td>" . $row['IMIE'] . "</td><td>" . $row['NAZWISKO'] . "</td><td> " . $row['WIEK'] . "</td><td> " . $row['SPECJALIZACJA'] ."</td><td>" . $row['ID_KARETKI'] . "</td></tr>";
		}
		echo "</table>";
	}
	oci_close($conn);
?>
</center>
</div>

</div>
<center>
<b>Dodaj lekarza</b>
 <form enctype="multipart/form-data" action="Lekarze.php" method="post">
        <p>Id:  <input type="text" id="name" name="id" maxlength="20" /></p>
        <p>Imię:  <input type="text" id="name" name="imie" maxlength="15" /></p>
        <p>Nazwisko:  <input type="text" id="name" name="nazwisko" maxlength="20" /></p>
        <p>Wiek:  <input type="text" id="name" name="wiek" maxlength="20" /></p>
        <p>Specjalizacja:  <input type="text" id="name" name="specjalizacja" maxlength="20" /></p>
        <p>Id karetki:  <input type="text" id="name" name="karetka" maxlength="20" /></p>
        <input type="submit" value="Wyślij" id="submit"/>
</form>
</center>
        
<?php


if(isset($_POST['id']) and isset($_POST['imie']) and $_POST['nazwisko'] and $_POST['wiek'] and $_POST['specjalizacja'] and $_POST['karetka']) {
	
$id=$_POST['id'];
$imie=$_POST['imie'];
$nazwisko=$_POST['nazwisko'];
$wiek=$_POST['wiek'];
$specjalizacja=$_POST['specjalizacja'];
$karetka=$_POST['karetka'];

$conn = oci_connect("pogotowie_ratunkowe", "7890", "//localhost/XEPDB1", "AL32UTF8");
if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	else{
		
		
		$sql = 'INSERT INTO Lekarze (id_lekarza, Imie, Nazwisko, Wiek, Specjalizacja, id_karetki) '. 'VALUES(:id, :imie, :nazwisko, :wiek, :specjalizacja, :id_karetki)';
		
		$stid = oci_parse($conn, $sql);
		
		oci_bind_by_name($stid, ':id', $id);
		oci_bind_by_name($stid, ':imie', $imie);
		oci_bind_by_name($stid, ':nazwisko', $nazwisko);
		oci_bind_by_name($stid, ':wiek', $wiek);
		oci_bind_by_name($stid, ':specjalizacja', $specjalizacja);
		oci_bind_by_name($stid, ':id_karetki',$karetka);
		
		oci_execute($stid);
	}
		
	
}
?>

<div class="artykul">
 <article>
    <h1>Urlopy Lekarzy</h1>
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
		$stid = oci_parse($conn, 'SELECT id_urlopu_lekarza, wykorzystane_dni_urlopu, typ_urlopu, data_rozpoczecia_urlopu, data_zakonczenia_urlopu, id_lekarza FROm urlopy_lekarzy');
		
		oci_execute($stid);
		
		echo "<table border='1'>";
		echo "<tr><th>" . "ID urlopu lekarza" . "</th><th>" . "Wykorzystane dni urlopu" . "</th><th>" . "Typ urlopu" . "</th><th>" . "Data rozpoczecia urlopu" . "</th><th>" . "Data zakonczenia urlopu" . "</th><th>" . "ID lekarza" . "</th></tr>";
		
		while(($row = oci_fetch_array($stid, OCI_BOTH))!=false){
		echo "<tr><td>" . $row['ID_URLOPU_LEKARZA'] . "</td><td>" . $row['WYKORZYSTANE_DNI_URLOPU'] . "</td><td>" . $row['TYP_URLOPU'] . "</td><td> " . $row['DATA_ROZPOCZECIA_URLOPU'] . "</td><td> " . $row['DATA_ZAKONCZENIA_URLOPU'] ."</td><td>" . $row['ID_LEKARZA'] . "</td></tr>";
		}
		echo "</table>";
	}
	oci_close($conn);
?>
 
 
 </center>


</div>
<center>
<b>Dodaj nowy urlop</b>
 <form enctype="multipart/form-data" action="Lekarze.php" method="post">
        <p>Id:  <input type="text" id="name" 						name="zm1" maxlength="20" /></p>
        <p>Wykorzystane dni urlopu:  <input type="text" id="name" 	name="zm2" maxlength="15" /></p>
        <p>Typ urlopu:  <input type="text" id="name" 				name="zm3" maxlength="20" /></p>
        <p>Data rozpoczęcia urlopu:  <input type="text" id="name"	name="zm4" maxlength="20" /></p>
        <p>Data zakończenia urlopu:  <input type="text" id="name" 	name="zm5" maxlength="20" /></p>
        <p>Id_lekarza:  <input type="text" id="name" 				name="zm6" maxlength="20" /></p>
        <input type="submit" value="Wyślij" id="submit"/>
</form>
</center>
        
<?php


if(isset($_POST['zm1']) and isset($_POST['zm2']) and $_POST['zm3'] and $_POST['zm4'] and $_POST['zm5'] and $_POST['zm6']) {
	
$v1=$_POST['zm1'];
$v2=$_POST['zm2'];
$v3=$_POST['zm3'];
$v4=$_POST['zm4'];
$v5=$_POST['zm5'];
$v6=$_POST['zm6'];

$conn = oci_connect("pogotowie_ratunkowe", "7890", "//localhost/XEPDB1", "AL32UTF8");
if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	}
	else{
		
		
		$sql = 'INSERT INTO urlopy_lekarzy (id_urlopu_lekarza, wykorzystane_dni_urlopu, typ_urlopu, data_rozpoczecia_urlopu, data_zakonczenia_urlopu, id_lekarza) '. 'VALUES(:v1, :v2, :v3, :v4, :v5, :v6)';
		
		$stid = oci_parse($conn, $sql);
		
		oci_bind_by_name($stid, ':v1', $v1);
		oci_bind_by_name($stid, ':v2', $v2);
		oci_bind_by_name($stid, ':v3', $v3);
		oci_bind_by_name($stid, ':v4', $v4);
		oci_bind_by_name($stid, ':v5', $v5);
		oci_bind_by_name($stid, ':v6', $v6);
		
		oci_execute($stid);
	}
		
	
}
?>

</body>

</html>
