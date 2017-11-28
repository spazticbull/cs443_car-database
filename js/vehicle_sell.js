$(document).ready(function() {
  $("#submit").click(function() {
    var vin = $.trim($("#vin").val());
    var customer_id = $.trim($("#customer_id").val());
    var employee_id = $.trim($("#employee_id").val());
    var price = $.trim($("#price").val());
    var temp_tag = $.trim($("#temp_tag").val());
    var custom_adds_desc = $.trim($("#custom_adds_desc").val());

    var dataString = "vin=" + vin + "&customer_id=" + customer_id + "&employee_id=" + employee_id + "&price=" + price + "&temp_tag=" + temp_tag + "&custom_adds_desc=" + custom_adds_desc;

    $.ajax({
      type: "POST",
      url: "insert_sell_vehicle.php",
      data: dataString,
      cache: false,
      success: function(result) {
        $(".result").show().html(result);
      },
      error: function(e) {
        console.log("Error in JS: " + e.stack);
      }
    });

    return false;
  });
});