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


  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    format: 'mm-dd-yyyy',
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
}
