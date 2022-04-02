<?php 

//Refreshed php page after every 1 sec using meta tag
$page = $_SERVER['PHP_SELF'];
$sec = "1";
 
 //Connecting to database and getting the connection object
 $conn = new mysqli('localhost','root','','parking');
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //Creating a query
 $stmt = $conn->prepare("SELECT irValue FROM ir where id = (select max(id) from ir);");
 
 //Executing the query 
 $stmt->execute();
 
 //Binding results to the query 
 $stmt->bind_result($irValue);

 $sensor = array(); 
 
 //Traversing through all the results 
 while($stmt->fetch()){
 $temp = array();
 $temp['irValue'] = $irValue;
 array_push($sensor, $temp);
 }
 
 //Displaying the result in json format 

 //echo json_encode(array("sensor"=>$sensor));
 echo json_encode($sensor);

?>

<html>
    <head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
    <body>
    </body>
</html>

