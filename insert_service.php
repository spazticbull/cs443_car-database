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
    $service_id_array=explode(",", $service);
}

/*Check if car exists in invetory table*/
$vinCheckQuery="SELECT vin, vehicle_type FROM inventory";
// Check if query successfull
if (!($vinCheckResult=mysqli_query($conn, $vinCheckQuery))) {
    $message="An error occured. Please try again later: VIN CHECK ERROR".mysqli_error($conn);
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
        $vinCheckUpdateQuery="UPDATE inventory SET vehicle_type = 'Service' WHERE vin = '$vin' ";
    }

    if (!($vinCheckResult=mysqli_query($conn, $vinCheckUpdateQuery))) {
        $message="An error occured while UPDATING VEHICLE";
    } else {
        $vinCheck=true;
    }
}

/*Check if customer id exists*/

$customerIdQuery="SELECT id FROM customer";

if (!($customerIdResult=mysqli_query($conn, $customerIdQuery))) {
    $message="An error occured. Please try again later: CUSTOMER ID CHECK ERROR".mysqli_error($conn);
}

while ($row=mysqli_fetch_assoc($customerIdResult)) {
    $customerIdArray[] = $row['id'];
}

if (!in_array($customer_id, $customerIdArray)) {
    $message.="Specified customer id does not exist";
    $customerId=false;
} else {
    $customerId=true;
}
/*Check if employee id exists*/

$employeeIdQuery="SELECT id FROM employee";

if (!($employeeIdResult=mysqli_query($conn, $employeeIdQuery))) {
    $message="An error occured. Please try again later: EMPLOYEE ID CHECK ERROR".mysqli_error($conn);
}

while ($row=mysqli_fetch_assoc($employeeIdResult)) {
    $employeeIdArray[] = $row['id'];
}

if (!in_array($employee_id, $employeeIdArray)) {
    $message.="Specified employee id does not exist";
    $employeeId=false;
} else {
    $employeeId=true;
}

/*If vinCheck, employeeId and customerId check then go through*/
if (($vinCheck==true)&&($customerId==true)&&($employeeId==true)) {
    $insVin='"'.$vin.'"';
    $query="INSERT INTO service (vin, mileage_before, mileage_after,final_billing,vehicle_arrival,eta,vehicle_pickup,customer_pickup)
      VALUES ($insVin, $mileage_before, $mileage_after,$final_billing,'$vehicle_arrival','$eta', '$vehicle_pickup','$customer_pickup')";

    if (!($result=mysqli_query($conn, $query))) {
        $message="An error occured while INSERTING SERVICE".mysqli_error($conn);
    } else {
        $insert_service_id=mysqli_insert_id($conn);

        /*INSERT IN SERVICE_USED ONLY AFTER INSERT IN SERVICE IS SUCCESSFULL*/
        foreach ($service_id_array as $service_item_id) {
            $serviceUsedQuery="INSERT INTO service_used (service_id, service_item_id) VALUES ($insert_service_id,$service_item_id)";

            if (!($serviceUsedResult=mysqli_query($conn, $serviceUsedQuery))) {
                $message="An error occured while INSERTING SERVICE USED".mysqli_error($conn);
            } else {
                $message="Inserted in service_used";
            }
        }

        /*INSERT IN SERVICE_CUSTOMER ONLY AFTER INSERT IN SERVICE IS SUCCESSFULL*/

        $serviceCustomerQuery="INSERT INTO service_customer (service_id, customer_id, employee_id) VALUES ($insert_service_id, $customer_id, $employee_id)";

        if (!($serviceCustomerResult=mysqli_query($conn, $serviceCustomerQuery))) {
            $message="An error occured while INSERTING SERVICE CUSTOMER".mysqli_error($conn);
        } else {
            $message="Inserted in service customer";
        }

        $billingQuery="INSERT INTO billing (customer_id, service_id, status) VALUES ($customerId,$insert_service_id, 'PENDING')";

        if (!($billingResult=mysqli_query($conn, $billingQuery))) {
            $message="An error occured while INSERTING BILLING".mysqli_error($conn);
        } else {
            $message="Inserted in billing";
        }

        $message="Successfully created a new service";
    }
} else {
    $message="An error occured while executing operations";
}


echo $message;
