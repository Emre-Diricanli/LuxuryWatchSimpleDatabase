<?php

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'luxury_watches';

$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
	die('Connection failed: ' . mysqli_connect_error());
}

// Query 1: Get all watches
function query1() {
	global $conn;

	$sql = "SELECT * FROM watches";
	$result = mysqli_query($conn, $sql);

	$watches = array();

	while ($row = mysqli_fetch_assoc($result)) {
		array_push($watches, $row);
	}

	echo json_encode($watches);
}

// Query 2: Get watches by brand
function query2() {
	global $conn;

	$brand = $_GET['brand'];

	$sql = "SELECT * FROM watches WHERE brand='$brand'";
	$result = mysqli_query($conn, $sql);

	$watches = array();

	while ($row = mysqli_fetch_assoc($result)) {
		array_push($watches, $row);
	}

	echo json_encode($watches);
}

// Query 3: Get watches by price range
function query3() {
	global $conn;

	$min_price = $_GET['min_price'];
	$max_price = $_GET['max_price'];

	$sql = "SELECT * FROM watches WHERE price BETWEEN $min_price AND $max_price";
	$result = mysqli_query($conn, $sql);

	$watches = array();

	while ($row = mysqli_fetch_assoc($result)) {
		array_push($watches, $row);
	}

	echo json_encode($watches);
}

// Add a new watch to the database
function addWatch($brand, $model, $price) {
	global $conn;

	$sql = "INSERT INTO watches (brand, model, price) VALUES ('$brand', '$model', $price)";
	mysqli_query($conn, $sql);
}

// Remove a watch from the database
function removeWatch($id) {
	global $conn;

	$sql = "DELETE FROM watches WHERE id=$id";
	mysqli_query($conn, $sql);
}

?>
