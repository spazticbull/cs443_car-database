<?php $title="Add Customer"; require_once "header.php";?>    

<head>
    <style type="text/css">
        .input-field {
            margin-top: 30px;
        }
        div.error {
            color: red;
            margin-top: -15px;
            padding: 0;
            font-size: 0.9em;
            text-align: right;
        }
        .radioSection {
            margin-top: 20px;
        }
        #radioError {
            color: red;
            margin-top: -15px;
            padding: 0;
            font-size: 0.9em;
        }
    </style>
</head>

<body>
    <?php
    // variables
    $email = $firstName = $lastName = $streetAddr = $cityAddr = $stateAddr = $zipAddr = $phone = "";
    $emailErr = $firstNameErr = $lastNameErr = $streetAddrErr = $cityAddrErr = $stateAddrErr = $zipAddrErr = $phoneErr = "";

    // error validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // clean email
        if (isset($_POST["email"])) {
            $email = clean($_POST["email"]);
            $email = strtolower($email);
        }
        // clean first name
        if (isset($_POST["firstName"])) {
            $firstName = clean($_POST["firstName"]);
            $firstName = ucwords($firstName);
        }
        // clean last name
        if (isset($_POST["lastName"])) {
            $lastName = clean($_POST["lastName"]);
            $lastName = ucwords($lastName);
        }
        // clean street address
        if (isset($_POST["streetAddr"])) {
            $streetAddr = clean($_POST["streetAddr"]);
            $streetAddr = ucwords($streetAddr);
        }
        // clean city address
        if (isset($_POST["cityAddr"])) {
            $cityAddr = clean($_POST["cityAddr"]);
            $cityAddr = ucwords($cityAddr);
        }
        // clean state address
        if (isset($_POST["stateAddr"])) {
            $stateAddr = clean($_POST["stateAddr"]);
            $stateAddr = strtoupper($stateAddr);
        }
        // clean zip address
        if (isset($_POST["zipAddr"])) {
            $zipAddr = clean($_POST["zipAddr"]);
        }
        // clean phone
        if (isset($_POST["phone"])) {
            $phone = clean($_POST["phone"]);
        }   
    }

    function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    
    <div class="container">
        <div class="row">
            <h2>Add Customer</h2>
        </div>

        <div class="row">
            <form method="post" class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="addCust">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" name="email" placeholder="johndoe@gmail.com" value="<?php echo $email ?>">
                        <label class="active" for="email" data-success="Eggstravagent!">Email *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="firstName" placeholder="John" value="<?php echo $firstName ?>">
                        <label class="active" for="firstName" data-success="Perfect!">First name *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="lastName" placeholder="Doe" value="<?php echo $lastName ?>">
                        <label class="active" for="lastName" data-success="Awesome!">Last name *</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="streetAddr" placeholder="1906 College Heights Blvd" value="<?php echo $streetAddr ?>">
                        <label class="active" for="streetAddr" data-success="Stupendous!">Street address *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="cityAddr" placeholder="Bowling Green" value="<?php echo $cityAddr ?>">
                        <label class="active" for="cityAddr" data-success="Eggstatic!">City *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="stateAddr" placeholder="KY" value="<?php echo $stateAddr ?>">
                        <label class="active" for="stateAddr" data-success="Stellar!">State *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="zipAddr" placeholder="42101" value="<?php echo $zipAddr ?>">
                        <label class="active" for="zipAddr" data-success="Eggceptional!">Zip code/Postal code *</label>
                    </div>
                    <div class="input-field col s12 m6">
                        <input type="text" name="phone" placeholder="2701234567" value="<?php echo $phone ?>">
                        <label class="active" for="phone" data-success="Wowza!">Phone *</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 right-align">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </div><!-- ./row -->

        <div class="row">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // obtain connection to database
                    require_once("connection.php");
                    
                    // insert customer into database
                    if (isset($_REQUEST["action"])) {
                        $sql = "INSERT INTO customer (firstname, lastname, email, street, city, state, zip, phone) VALUES 
                        (' $firstName ', ' $lastName ', ' $email ', ' $streetAddr ', ' $cityAddr ', ' $stateAddr ', ' $zipAddr ', ' $phone ');";
                    
                        if ($conn->query($sql) === TRUE) {
                            echo "Customer " . $firstName . " " . $lastName . " has been added to the database successfully";
                            // must use script to not interfere with earlier php header call
                            echo("<script>location.href = '" . $_SERVER["PHP_SELF"] . "';</script>");
                            die;
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
            ?>
        </div>
    </div><!-- ./container -->


    <script>
        $(document).ready(function() {
            $('#addCust').validate({
                errorElement: "div",
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                // custom rules
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    firstName: {
                        required: true,
                        maxlength: 30
                    },
                    lastName: {
                        required: true,
                        maxlength: 30
                    },
                    streetAddr: {
                        required: true,
                        maxlength: 30
                    },
                    cityAddr: {
                        required: true,
                        maxlength: 30
                    },
                    stateAddr: {
                        required: true,
                        minlength: 2,
                        maxlength: 2
                    },
                    zipAddr: {
                        required: true,
                        digits: true,
                        minlength: 5,
                        maxlength: 9
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 12
                    }
                },
                // custom messages
                messages: {
                    email: {
                        required: "Please enter email",
                        email: "Follow email format: johndoe@gmail.com",
                        maxlength: "No more than 30 characters"
                    },
                    firstName: {
                        required: "Please enter first name",
                        maxlength: "No more than 30 characters"
                    },
                    lastName: {
                        required: "Please enter last name",
                        maxlength: "No more than 30 characters"
                    },
                    streetAddr: {
                        required: "Please enter street address",
                        maxlength: "No more than 30 characters"
                    },
                    cityAddr: {
                        required: "Please enter city",
                        maxlength: "No more than 30 characters"
                    },
                    stateAddr: {
                        required: "Please enter state",
                        minlength: "Must be 2 characters",
                        maxlength: "Must be 2 characters"
                    },
                    zipAddr: {
                        required: "Please enter zip code",
                        digits: "Only use digits",
                        minlength: "Must be 5 - 9 digits long",
                        maxlength: "Only 9 digits long"
                    },
                    phone: {
                        required: "Please enter phone number",
                        digits: "Only use digits",
                        minlength: "Must be 10 - 12 digits long",
                        maxlength: "Only 12 digits long"
                    }
                }
            });
        });
    </script>
</body>

<php require_once("footer.php");