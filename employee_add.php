<!DOCTYPE html>
<html>
    
<?php include 'header.php';?>    

<head>
    <style type="text/css">
        .radio-pad {
            padding-right: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="hide-on-small-only">
            <div class="row">
                <form action="customer_post.php" name="addCust" method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="email" name="email" class="validate">
                            <label for="email" data-error="wrong" data-success="right">Email *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="firstName" class="validate">
                            <label for="firstName">First name *</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="lastName" class="validate">
                            <label for="lastName">Last name *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="streetAddress" class="validate">
                            <label for="streetAddress">Street address *</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="streetAddress2" class="validate">
                            <label for="streetAddress2">Street address line 2</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="cityAddress" class="validate">
                            <label for="cityAddress">City *</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="stateAddress" class="validate">
                            <label for="stateAddress">State *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="zipAddress" class="validate">
                            <label for="zipAddress">Zip code/Postal code *</label>
                        </div>
                        <div class="input-field col s6">
                            <select name="countryAddress" class="validate">
                                
                                <!-- get countries from txt file -->
                                <?php
                                $options = nl2br(file_get_contents("countries.txt"));
                                $options = preg_split("/(\r\n|\n|\r|\|+)/", $options);
                                
                                for($i = 0; $i < count($options); $i = $i + 2)
                                    {
                                    echo "<option value='" . $options[$i] . "'>" . $options[$i + 1] . "</option>";
                                    }
                                ?>
                            </select>
                            <label for="">Country/Region *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" class="validate" name="phone">
                            <label for="phone">Phone *</label>
                        </div>
                        <div class="hide-on-small-only">
                            <div class="col s1">
                                <label for="">Gender</label>
                            </div>
                            <div class="col s5">
                                <input type="radio" class="with-gap" name="gender" id="male"/>
                                <label class="radio-pad" for="male">Male</label>
                                <input type="radio" class="with-gap" name="gender" id="female"/>
                                <label for="female">Female</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- ./row -->
        </div><!-- ./responsive ending for medium and up -->
        
        
        <div class="hide-on-med-and-up">
            <div class="row">
                <form action="customer_post.php" name="addCust" method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="email" name="email" class="validate">
                            <label for="email" data-error="wrong" data-success="right">Email *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="firstName" class="validate">
                            <label for="firstName">First name *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="lastName" class="validate">
                            <label for="lastName">Last name *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="streetAddress" class="validate">
                            <label for="streetAddress">Street address *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="streetAddress2" class="validate">
                            <label for="streetAddress2">Street address line 2</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="cityAddress" class="validate">
                            <label for="cityAddress">City *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="stateAddress" class="validate">
                            <label for="stateAddress">State *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" name="zipAddress" class="validate">
                            <label for="zipAddress">Zip code/Postal code *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="countryAddress" class="validate">
                                
                                <!-- get countries from txt file -->
                                <?php
                                $options = nl2br(file_get_contents("countries.txt"));
                                $options = preg_split("/(\r\n|\n|\r|\|+)/", $options);
                                
                                for($i = 0; $i < count($options); $i = $i + 2)
                                    {
                                    echo "<option value='" . $options[$i] . "'>" . $options[$i + 1] . "</option>";
                                    }
                                ?>
                            </select>
                            <label for="">Country/Region *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" class="validate" name="phone">
                            <label for="phone">Phone *</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s2">
                            <label for="">Gender</label>
                        </div>
                        <div class="col s10">
                            <input type="radio" class="with-gap" name="gender" id="male"/>
                            <label class="radio-pad" for="male">Male</label>
                            <input type="radio" class="with-gap" name="gender" id="female"/>
                            <label for="female">Female</label>
                        </div>
                    </div>
                </form>
            </div><!-- ./row -->
        </div><!-- responsive ending for small only -->
    </div><!-- ./container -->
    
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
    </script>
</body>
</html>
