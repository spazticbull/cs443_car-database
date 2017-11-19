<!DOCTYPE html>
<html>
    
<?php include 'header.php';?>    

<head>
    <style type="text/css">
    </style>
</head>

<body>
    <?php
    // variables
    $email = $firstName = $lastName = $streetAddr = $cityAddr = $stateAddr = $zipAddr = $phone = "";
    $emailErr = $firstNameErr = $lastNameErr = $streetAddrErr = $cityAddrErr = $stateAddrErr = $zipAddrErr = $phoneErr = "";
    
    // error validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // validate email
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check e-mail address is in correct format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email";
            }
        }
        
        // validate first name
        if (empty($_POST["firstName"])) {
            $firstNameErr = "First name is required";
        } else {
            $firstName = test_input($_POST["firstName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
                $firstNameErr = "Only letters and spaces allowed";
            }
        }
        
        // validate last name
        if (empty($_POST["lastName"])) {
            $lastNameErr = "Last name is required";
        } else {
            $lastName = test_input($_POST["lastName"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                $lastNameErr = "Only letters and spaces allowed";
            }
        }
    }
    ?>
    
    <div class="container">
        <div class="row">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addCust">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" class="validate" name="email" value="<?php echo $email ?>">
                        <label for="email" data-error="<?php echo $emailErr;?>">Email *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" class="validate" name="firstName" value="<?php echo $firstName ?>">
                        <label for="firstName" data-error="<?php echo $firstNameErr;?>">First name *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" class="validate" name="lastName" value="<?php echo $lastName ?>">
                        <label for="lastName" data-error="<?php echo $lastNameErr;?>">Last name *</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" class="validate" name="streetAddr" value="<?php echo $streetAddr ?>">
                        <label for="streetAddr" data-error="<?php echo $streetAddrErr;?>">Street address *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" class="validate" name="cityAddr" value="<?php echo $cityAddr ?>">
                        <label for="cityAddr" data-error="<?php echo $cityAddr;?>">City *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" class="validate" name="stateAddr" value="<?php echo $stateAddr ?>">
                        <label for="stateAddr" data-error="<?php echo $stateAddr;?>">State *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" class="validate" name="zipAddr" value="<?php echo $zipAddr ?>">
                        <label for="zipAddr" data-error="<?php echo $zipAddr;?>">Zip code/Postal code *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" class="validate" name="phone" value="<?php echo $phone ?>">
                        <label for="phone" data-error="<?php echo $phoneErr;?>">Phone *</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div><!-- ./row -->
    </div><!-- ./container -->
    
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
</body>
</html>