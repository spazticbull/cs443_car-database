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

if (isset($_POST["customer_id"])) {
    $string=cleanInput($_POST["customer_id"]);
    $customer_id=$string;
}

if (isset($_POST["employee_id"])) {
    $string=cleanInput($_POST["employee_id"]);
    $employee_id=$string;
}

if (isset($_POST["price"])) {
    $string=cleanInput($_POST["price"]);
    $price=$string;
}

if (isset($_POST["temp_tag"])) {
    $string=cleanInput($_POST["temp_tag"]);
    $temp_tag=$string;
}

if (isset($_POST["custom_adds_desc"])) {
    $string=cleanInput($_POST["custom_adds_desc"]);
    $custom_adds_desc=$string;
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
    if ((strcmp(strtolower($vinCheckArray[$vin]), "sold")!==0)&&(strcmp(strtolower($vinCheckArray[$vin]), "service"))) { //if car is not sold
        $vinCheckUpdateQuery="UPDATE inventory SET vehicle_type = 'Sold' WHERE vin = '$vin' ";
        if (!($vinCheckResult=mysqli_query($conn, $vinCheckUpdateQuery))) {
            $message="An error occured while UPDATING VEHICLE";
            $vinCheck=false;
        } else {
            $vinCheck=true;
        }
    } else {
        $message="car is not available";
        $vinCheck=false;
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
    $message.=" Specified customer id does not exist";
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
    $message.=" Specified employee id does not exist";
    $employeeId=false;
} else {
    $employeeId=true;
}



/*If vinCheck, employeeId and customerId check then go through*/
if (($vinCheck==true)&&($customerId==true)&&($employeeId==true)) {
    $insVin='"'.$vin.'"';
    $vehicleQuery="INSERT INTO vehicle (vin, customer_id,price) VALUES ($insVin, $customer_id, $price)";

    if (!($result=mysqli_query($conn, $vehicleQuery))) {
        $message=" An error occured while INSERTING VEHICLE".mysqli_error($conn);
    } else {
        $message=" Inserted in VEHICLE";
    }

    $insTemp_Tag='"'.$temp_tag.'"';
    $insCustom_Adds_Desc='"'.$custom_adds_desc.'"';
    $saleQuery="INSERT INTO sale (vin, temp_tag, custom_adds_desc) VALUES ($insVin, $insTemp_Tag, $insCustom_Adds_Desc)";

    if (!($result=mysqli_query($conn, $saleQuery))) {
        $message="An error occured while INSERTING SALE".mysqli_error($conn);
    } else {
        $insert_sale_id=mysqli_insert_id($conn);

        /*INSERT IN SALE CUSTOMER ONLY AFTER INSERT IN SALE IS SUCCESSFULL*/
        $saleCustomerQuery="INSERT INTO sale_customer(sale_id, customer_id, employee_id) VALUES ($insert_sale_id, $customer_id,$employeeId)";

        if (!($result=mysqli_query($conn, $saleCustomerQuery))) {
            $message=" An error occured while INSERTING SALE CUSTOMER".mysqli_error($conn);
        } else {
            $message=" Inserted in SALE CUSTOMER";
        }


        /*INSERT IN BILLING ONLY AFTER INSERT IN SALE IS SUCCESSFULL*/
        $billingQuery="INSERT INTO billing (customer_id, sale_id, status) VALUES ($customerId,$insert_sale_id, 'PENDING')";

        if (!($billingResult=mysqli_query($conn, $billingQuery))) {
            $message=" An error occured while INSERTING BILLING".mysqli_error($conn);
        } else {
            $message=" Inserted in billing";
        }
    }
}


echo $message;
