<html>
<link rel="stylesheet" href="styl.css" type="text/css" />
<head>
<title>Dyzury</title>
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
</section>

<div class = "smalldiv"></div>

<div class="artykul">
 <article>
    <h1>Dyżury</h1>
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
		$stid = oci_parse($conn, 'SELECT id_dyzuru, typ_dyzuru, miejsce_dyzuru, dzien_tygodnia, data_waznosci FROM dyzury');
		
		oci_execute($stid);
		
		echo "<table border='1'>";
		echo "<tr><th>" . "ID dyżuru" . "</th><th>" . "Typ dyżuru" . "</th><th>" . "Miejsce dyżuru" . "</th><th>" . "Dzień tygodnia" . "</th><th>" . "Data ważności" . "</th></tr>";
		
		while(($row = oci_fetch_array($stid, OCI_BOTH))!=false){
		echo "<tr><td>" . $row['ID_DYZURU'] . "</td><td>" . $row['TYP_DYZURU'] . "</td><td>" . $row['MIEJSCE_DYZURU'] . "</td><td> " . $row['DZIEN_TYGODNIA'] . "</td><td> " . $row['DATA_WAZNOSCI'] ."</td></tr>";
		}
		echo "</table>";
	}
	oci_close($conn);
?>
</center>
</div>

<center>
<b>Dodaj informacje o dyżurze</b>
 <form enctype="multipart/form-data" action="Dyzury.php" method="post">
        <p>Id:  <input type="text" id="name" 						name="zm1" maxlength="20" /></p>
        <p>Typ dyżuru:  <input type="text" id="name" 	name="zm2" maxlength="15" /></p>
        <p>Miejsce dyżuru:  <input type="text" id="name" 				name="zm3" maxlength="20" /></p>
        <p>Dzień tygodnia:  <input type="text" id="name"	name="zm4" maxlength="20" /></p>
        <p>Data ważności:  <input type="text" id="name" 	name="zm5" maxlength="20" /></p>
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
		
		
		$sql = 'INSERT INTO dyzury (id_dyzuru, typ_dyzuru, miejsce_dyzuru, dzien_tygodnia, data_waznosci) '. 'VALUES(:v1, :v2, :v3, :v4, :v5)';
		
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

</php>