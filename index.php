<?php 
	/*this file for remote database
	filename : index.php
	path : RS/index.php
	versi : 1
	email : ksatrianglungupertama@gmail.com
	*/
	header("acces-control-allow-origin");
	header("content-Type: application/json; charset=UTF-8");

	$db = "localhost";
	$dbUser = "root";
	$dbPass = "asusa442u";
	$dbName = "RS";

	$con = new mysqli($db, $dbUser, $dbPass, $dbName);
	if ($con -> connect_error) {
		die("Connection failed : ". $con->connect_error);
	}

	$con->query("SET CHARACTER SET utf8");
	$con->query("SET NAMES 'utf8'");

	$action = $_GET["action"];

	switch ($action) {
		
		/*CREATE TABLE tbwarung (
		id INT(6) AUTO_INCREMENT PRIMARY KEY,
		namawarung text NOT NULL,
		namapemilik text NOT NULL,
		alamat text NOT NULL
		);*/
		
		Case "getAllWarung":
		$q = $con->query(
			"SElECT * FROM tbwarung");

		$rows = array();
			while($r = mysqli_fetch_assoc($q))
			{
				$rows[] = $r;
			}
			print json_encode($rows);
			// echo "hello";
		$con->close;

	break;

		Case "addUser" :
		$namawarung = $_GET["namawarung"];
		$namapemilik = $_GET["namapemilik"];
		$alamat = $_GET["alamat"];
		$q = $con->query(
			"INSERT INTO tbwarung(
			`namawarung`,
			`namapemilik`,
			`alamat`) VALUES (
			'$namawarung',
			'$namapemilik',
			'$alamat')"
			);

			if($q) {
				print json_decode("Data berhasil di input.");
			} else {
				print json_encode("Data gagal di input.");
			}

			$con -> close();
	break;

		Case "updateUser" :
		$id = $_GET["id"];
		$namawarung = $_GET["namawarung"];
		$namapemilik = $_GET["namapemilik"];
		$alamat = $_GET["alamat"];
		$q = $con->query(
			"UPDATE tbwarung set
			`namawarung` = '$namawarung',
			`namapemilik` = '$namapemilik',
			`alamat` = '$alamat'
			where `id`='$id'");

			if ($q) {
				print json_encode("berhasil Update.");
			} else{
				json_encode("Gagal Update.");
			}
			$con->close();
	break;

		Case "deleteUser":
		$id = $_GET["id"];
		$q = $con->query(
			"DELETE FROM users 
			where 
			`id`='$id");

			if($q){
				print json_encode("Terhapus");
			} else {
				print json_encode("Gagal menghapus");
			}
			$con->close();
	break;
	
	}
 ?>
