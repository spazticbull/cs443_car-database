//When a service is checked call the calculate function
$(document).ready(function() {
  $('input[name="service"]').click(function() {
    if ($(this).is(':checked')) { //If checkbox is checked
      calculate();
    }
    if ($(this).is(':not(:checked)')) { //If checkbox is unchecked
      calculate();
    }
  });





  $('#submit').click(function() {
    var vin = $.trim($("#vin").val());

    var mileage_before = $.trim($("#mileage_before").val());
    var mileage_after = $.trim($("#mileage_after").val());

    var vehicle_arrive_date = $.trim($("#vehicle_arrive_date").val());
    var vehicle_arrive_time = $.trim($("#vehicle_arrive_time").val());

    var vehicle_eta_date = $.trim($("#vehicle_eta_date").val());
    var vehicle_eta_time = $.trim($("#vehicle_eta_time").val());

    var vehicle_complete_date = $.trim($("#vehicle_complete_date").val());
    var vehicle_complete_time = $.trim($("#vehicle_complete_time").val());

    var customer_pickup_date = $.trim($("#customer_pickup_date").val());
    var customer_pickup_time = $.trim($("#customer_pickup_time").val());

    var customer_id = $.trim($("#customer_id").val());
    var employee_id = $.trim($("#employee_id").val());
    var final_billing = $("#final_billing").attr("value");

    var service = [];

    $('input[name="service"]:checked').each(function() {
      service.push($.trim($(this).attr("value_2")));
    });

    var vehicle_arrival = vehicle_arrive_date + " " + vehicle_arrive_time;
    var eta = vehicle_eta_date + " " + vehicle_eta_time;
    var vehicle_pickup = vehicle_complete_date + " " + vehicle_complete_time;
    var customer_pickup = customer_pickup_date + " " + customer_pickup_time;

    var dataString = "vin=" + vin + "&mileage_before=" + mileage_before + "&mileage_after=" + mileage_after + "&final_billing=" + final_billing + "&vehicle_arrival=" + vehicle_arrival + "&eta=" + eta + "&vehicle_pickup=" + vehicle_pickup + "&customer_pickup=" + customer_pickup + "&customer_id=" + customer_id + "&employee_id=" + employee_id + "&service=" + service;


    $.ajax({
      type: "POST",
      url: "insert_service.php",
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


  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    format: 'yyyy-dd-mm',
    closeOnSelect: false // Close upon selecting a date,
  });


  $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function() {} //Function for after opening timepicker
  });

})

//Calulate the sum of the checked services
function calculate() {
  var sum = 0;
  $('input[name="service"]:checked').each(function() {
    sum += parseInt($(this).attr("value"));
  });

  $("#billing_div").show();
  $("#final_billing").text("$" + sum);
  $("#final_billing").attr("value", sum);
}