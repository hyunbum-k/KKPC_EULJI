<?php

$servername = "localhost";
$username = "id12634515_emladmin";
$password = "vk2Be1hv_mV(^mR6";
$database = "id12634515_emldb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if($_POST['action']=='select'){
	$category = $_POST['category'];
	$sort = $_POST['sort'];

	$sql = "select t1.*, t2.review from StoreListTable t1 join ReviewTable t2 on t1.name = t2.name where t1." . $category . "= 1 order by t2." . $sort;
	$result = mysqli_query($conn, $sql);
	$data = array("recordset" => array());

	while($row = mysqli_fetch_assoc($result)){
		$name = $row['name'];
		$address = $row['address'];
		$menu = $row['menu'];
		$img_name = $row['img_name'];
		$phone = $row['phone'];
		$homepage = $row['homepage'];
		$open = $row['open'];
		$close = $row['close'];
		$korean = $row['korean'];
		$review = $row['review'];

		$data["recordset"][] = array("name" => $name, "address" => $address, "menu" => $menu, "img_name" => $img_name, "phone" => $phone, "homepage" => $homepage, "open" => $open, "close" => $close, "korean" => $korean, "review" => $review);
	}
	$data = json_encode($data, JSON_UNESCAPED_UNICODE);
	echo $data;
	mysqli_close($conn);
}
if($_POST['action']=='search'){
	$name = $_POST['name'];
	$sql = "select homepage from StoreListTable where name = '" . $name . "'";
	$result = mysqli_query($conn, $sql);
	
	$data = array("recordset" => array());

	$row = mysqli_fetch_assoc($result);
	$homepage = $row['homepage'];

	$data["recordset"][] = array("homepage" => $homepage);
	$data = json_encode($data, JSON_UNESCAPED_UNICODE);
	
	echo $data;
	mysqli_close($conn);
}
if($_POST['action']=='review_update'){
	$name = $_POST['name'];
	$sql = "update ReviewTable set review = review + 1 where name = '" . $name . "'";
	
	mysqli_query($conn, $sql);
	
	$sql = "select review from ReviewTable where name = '" . $name . "'";
	$result = mysqli_query($conn, $sql);
	
	$data = array("recordset" => array());

	$row = mysqli_fetch_assoc($result);
	$review = $row['review'];

	$data["recordset"][] = array("review" => $review);
	$data = json_encode($data, JSON_UNESCAPED_UNICODE);
	
	echo $data;
	
	mysqli_close($conn);
}
if($_POST['action']=='review_get'){
	$name = $_POST['name'];
	$sql = "select review from ReviewTable where name = '" . $name . "'";
	$result = mysqli_query($conn, $sql);
	
	$data = array("recordset" => array());

	$row = mysqli_fetch_assoc($result);
	$review = $row['review'];

	$data["recordset"][] = array("review" => $review);
	$data = json_encode($data, JSON_UNESCAPED_UNICODE);
	
	echo $data;
	mysqli_close($conn);
}
?>