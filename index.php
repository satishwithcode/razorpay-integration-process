
<div id="datepicker" class="calendar"></div>
           
<span class="h1">Appointment Type </span> 
<form class="p-bbok" action="proceed-book.php" method="POST">
<label><input type="radio" name="appointment_type" checked value="Clinic Visit">Clinic Visit</label><br>
<label class="hh"><input type="radio" name="appointment_type" value="Video Consultation">Video Consultation</label><br>  
<br><p>Doctur details</p>
<input type="text" value="Dr Satish Yadav" name="name">
<input type="text" value="Neuro" name="designation"> 
<input type="text" value="2000" name="price">
<input type="text" value="15min" name="duration">  
<input type="text" value="" name="selected_day" id="selected_day">
<input type="text" value="" name="selected_date" id="selected_date">
<div class="appt-slots"> 
    <div id="selectedDayInfo" style="margin-top: 10px;"></div>
    <div id="selectedDateInfo" style="margin-top:4px;"></div>
    <div class="appointment-times">
        <!--<p>Select appointment time:</p>-->
        <label><input type="radio" name="appointment_time" value="10am-11am" checked > 10am - 11am</label><br>
        <label><input type="radio" name="appointment_time" value="12pm-1pm"> 12pm - 1pm</label><br>
        <label><input type="radio" name="appointment_time" value="2pm-3pm"> 2pm - 3pm</label><br>
        <label><input type="radio" name="appointment_time" value="4pm-5pm"> 4pm - 5pm</label><br>
        <label><input type="radio" name="appointment_time" value="6pm-7pm"> 6pm - 7pm</label><br>
    </div>
</div> 
<button class="btnr btnr-primary btnr-hover" style="padding: 15px 30px;" type="submit">proceed to book</button>
</form> 
     
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> 
<script>
    $(function() {
      $("#datepicker").datepicker({
        firstDay: 1,
        onSelect: function(dateText, inst) {
          var selectedDate = new Date(dateText);
          showSelectedDateTime(selectedDate);
        }
      });

      // Show current date and day name by default
      var currentDate = new Date();
      showSelectedDateTime(currentDate);
    });

    function showSelectedDateTime(date) {
      var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var selectedDay = dayNames[date.getDay()];

      var selectedDateText = formatDate(date);

      $("#selectedDayInfo").html(selectedDay);
      $("#selected_date").val(selectedDateText); // Update the value of the selected_date input field
      $("#selected_day").val(selectedDay); // Update the value of the selected_day input field
      $("#selectedDateInfo").html(selectedDateText);
    }

    // Function to format the date in the desired format (e.g., 01 May 2024)
    function formatDate(date) {
      var day = date.getDate();
      var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      var monthIndex = date.getMonth();
      var year = date.getFullYear();

      return day + ' ' + monthNames[monthIndex] + ' ' + year;
    }
</script>
 <script>
    $(function() {
      $("#datepicker").datepicker({
        firstDay: 1,
        onSelect: function(dateText, inst) {
          showSelectedDate(dateText);
        }
      });

      // Show current date and day name by default
      var currentDate = $.datepicker.formatDate('dd/mm/yy', new Date());
      showSelectedDate(currentDate);
    });

    function showSelectedDate(dateText) {
      var selectedDate = new Date(dateText);
      var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var selectedDay = dayNames[selectedDate.getDay()];

      var selectedDateInfo = "Selected Date: " + dateText + "<br>" + "Day: " + selectedDay;
      $("#selectedDateInfo").html(selectedDateInfo);
    }
  </script>
  <script>
    function openNav() {
      document.getElementById("mySidenav-m").style.width = "85%";
    }

    function closeNav() {
      document.getElementById("mySidenav-m").style.width = "0";
    }
</script> 