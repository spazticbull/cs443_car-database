<?php
$message="";
try {
    require_once 'connection.php';
} catch (Exception $e) {
    $message= "Error occured";
}
function cleanInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST["vin"])) {
    $string=cleanInput($_POST["vin"]);
    $vin=$string;
}

if (isset($_POST["mileage_before"])) {
    $string=cleanInput($_POST["mileage_before"]);
    $mileage_before=$string;
}

if (isset($_POST["mileage_after"])) {
    $string=cleanInput($_POST["mileage_after"]);
    $mileage_after=$string;
}

if (isset($_POST["final_billing"])) {
    $string=cleanInput($_POST["final_billing"]);
    $final_billing=$string;
}

if (isset($_POST["vehicle_arrival"])) {
    $string=cleanInput($_POST["vehicle_arrival"]);
    $vehicle_arrival=$string;
}

if (isset($_POST["eta"])) {
    $string=cleanInput($_POST["eta"]);
    $eta=$string;
}

if (isset($_POST["vehicle_pickup"])) {
    $string=cleanInput($_POST["vehicle_pickup"]);
    $vehicle_pickup=$string;
}

if (isset($_POST["customer_pickup"])) {
    $string=cleanInput($_POST["customer_pickup"]);
    $customer_pickup=$string;
}

if (isset($_POST["customer_id"])) {
    $string=cleanInput($_POST["customer_id"]);
    $customer_id=$string;
}

if (isset($_POST["employee_id"])) {
    $string=cleanInput($_POST["employee_id"]);
    $employee_id=$string;
}

if (isset($_POST["service"])) {
    $string=cleanInput($_POST["service"]);
    $service = $string;
    $service_id=explode(",", $service);
}

$vinCheckQuery="SELECT vin, vehicle_type FROM inventory";
// Check if query successfull
if (!($vinCheckResult=mysqli_query($conn, $vinCheckQuery))) {
    $message="An error occured. Please try again later: VIN CHECK ERROR";
}

//Insert all records in array
while ($row=mysqli_fetch_assoc($vinCheckResult)) {
    $vinCheckArray[$row['vin']] = $row['vehicle_type'];
}
if (!array_key_exists($vin, $vinCheckArray)) {
    $message="Please check vehicle if in inventory";
    $vinCheck=false;
} else {
    if (strcmp(strtolower($vin), "service")!==0) {
        $vinCheckUpdateQuery="UPDATE inventory SET vehicle_type = 'service' WHERE vin = '$vin' ";
        $message=$vinCheckUpdateQuery;
    }

    if (!($vinCheckResult=mysqli_query($conn, $vinCheckUpdateQuery))) {
        $message="An error occured while updating vehicle";
    } else {
        $message="Goof to go";
    }
}


echo $message;

$insVin='"'.$vin.'"';

$query="INSERT INTO service (vin, mileage_before, mileage_after,final_billing,vehicle_arrival,eta,vehicle_pickup,customer_pickup)
VALUES ($insVin, $mileage_before, $mileage_after,$final_billing,$vehicle_arrival,$eta, $vehicle_pickup,$customer_pickup)";
