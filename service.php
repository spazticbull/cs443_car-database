<?php $title="Service"; require_once('header.php'); ?>
<script src="js/service.js"></script>

<div class="container">
  <div class="row">
    <form class="col s12 m12 l12" method="post">
      <div class="row">
        <div class="input-field col s12 m12 l12">
          <input required type="text" pattern=".{17,17}"   class="validate" name="vin" id="vin">
          <label for="vin" data-error="Only 17 characters" data-success="There we go" >Vehicle Identification Number (VIN)</label>

        </div>
        <div class="input-field col s6 m6 l6">
          <input required type="text" id="mileage_before" class="validate" name="mileage_before">
          <label for="mileage_before">Initial Mileage</label>

        </div>
        <div class="input-field col s6 m6 l6">
          <input required type="text" id="mileage_after"  class="validate" name="mileage_after">
          <label for="mileage_after">After Mileage</label>

        </div>

        <div class="col s12 m12 l12" id="service_item">
          <label for="service_item">Select service items: </label>
          <?php
                      require_once 'connection.php';

                      $query="SELECT * FROM service_item";
                      if (!$result=mysqli_query($conn, $query)) {
                          echo "An error occured";
                      }

                      while ($row=mysqli_fetch_assoc($result)) {
                          $service_id=$row['id'];
                          $service_description=$row['service_description'];
                          $service_price=$row['service_price'];

                          echo "<p>
              				<input type='checkbox' class='filled-in' name='service' value=$service_price value_2=$service_id id=$service_description />
              				<label for=$service_description> $service_description <span style='margin-left:10px;'>$$service_price</span> </label>
              				</p>
              				";
                      }
                  ?>
        </div>
        <div class="col s12 m12 l12 light-blue lighten-5" style="margin-top:6%; margin-bottom:5px;">
          <div class="input-field col s6 m6 l6">
            <input type="text" class="datepicker validate" id="vehicle_arrive_date">
            <label for="vehicle_arrive_date">Date Vehicle Arrived</label>
          </div>
          <div class="input-field col s6 m6 l6">
            <input type="text" class="timepicker validate" id="vehicle_arrive_time">
            <label for="vehicle_arrive_time">Time Vehicle Arrived</label>
          </div>
        </div>

        <div class="col s12 m12 l12  lime lighten-5" style="margin-top:5px; margin-bottom:5px;">
          <div class="input-field col s6 m6 l6">
            <input type="text" class="datepicker validate" id="vehicle_eta_date">
            <label for="vehicle_eta_date">Complete Estimate Date</label>
          </div>
          <div class="input-field col s6 m6 l6">
            <input type="text" class="timepicker validate" id="vehicle_eta_time">
            <label for="vehicle_eta_time">Complete Estimate Time</label>
          </div>
        </div>

        <div class="col s12 m12 l12 cyan lighten-5" style="margin-top:5px; margin-bottom:5px;">
          <div class="input-field col s6 m6 l6">
            <input type="text" class="datepicker validate" id="vehicle_complete_date">
            <label for="vehicle_complete_date">Date Vehicle Complete</label>
          </div>
          <div class="input-field col s6 m6 l6">
            <input type="text" class="timepicker validate" id="vehicle_complete_time">
            <label for="vehicle_complete_time">Time Vehicle Complete</label>
          </div>
        </div>

        <div class="col s12 m12 l12  teal lighten-5" style="margin-top:5px; margin-bottom:5px;">
          <div class="input-field col s6 m6 l6">
            <input type="text" class="datepicker validate" id="customer_pickup_date">
            <label for="customer_pickup_date">Date Customer Pickup</label>
          </div>
          <div class="input-field col s6 m6 l6">
            <input type="text" class="timepicker validate" id="customer_pickup_time">
            <label for="customer_pickup_time">Time Customer Pickup</label>
          </div>
        </div>

        <div class="input-field col s6 m6 l6">
          <input type="text" name="customer_id" id="customer_id">
          <label for="customer_id">Customer ID</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input type="text" name="employee_id" id="employee_id">
          <label for="employee_id">Employee ID</label>
        </div>


        <div class="col s12 m12 l12" id="billing_div" style="display: none">
          <div class="card-panel">
            Final billing based on service:
            <span class="blue-text text-darken-2" name="final_billing" id="final_billing"></span>
          </div>
        </div>

        <button class="btn waves-effect waves-light" id="submit" type="submit" name="action" style="margin-top:20px;">Submit
         <i class="material-icons right">send</i>
       </button>
      </div>

      <div class="result">

      </div>
    </form>
  </div>
  <!-- ./row -->
</div>
<!-- ./container -->

<?php require_once('footer.php');?>



<!-- <script type="text/javascript">
$(document).ready(function(){
  $("#submit").click(function(){
    $('input[name="service"]:checked').each(function() {
     console.log(this.value);
  });

  });
});

</script> -->
