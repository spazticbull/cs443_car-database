<?php $title="Vehicle Sell"; require_once('header.php'); ?>
<script src="js/vehicle_sell.js" charset="utf-8"></script>

<div class="container">
  <div class="row">
    <form class="col s12 m12 l12" method="post">
      <div class="row">
        <div class="input-field col s12 m12 l12">
          <input required type="text" pattern=".{17,17}"   class="validate" name="vin" id="vin">
          <label for="vin" data-error="Only 17 characters" data-success="There we go" >Vehicle Identification Number (VIN)</label>
        </div>



        <div class="input-field col s6 m6 l6">
          <input type="text" name="customer_id" id="customer_id">
          <label for="customer_id">Customer ID</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input type="text" name="employee_id" id="employee_id">
          <label for="employee_id">Employee ID</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input type="text" name="price" id="price">
          <label for="price">Price</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input type="text" name="temp_tag" id="temp_tag">
          <label for="temp_tag">Temp Tag</label>
        </div>
        <div class="input-field col s12 m12 l12">
          <input type="text" name="custom_adds" id="custom_adds_desc">
          <label for="custom_adds">Vehicle Customisation</label>
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
