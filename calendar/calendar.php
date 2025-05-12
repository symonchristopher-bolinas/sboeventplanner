<!DOCTYPE html>
<html>
<head>
  <title>Simple Event Calendar</title>
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
  <style>
    body {
      font-family: Arial;
      background: #f5f5f5;
    }
    #calendar {
      max-width: 700px;
      margin: 40px auto;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .legend {
      text-align: center;
      margin-top: 10px;
    }
    .legend span {
      margin: 0 15px;
      font-weight: bold;
    }
  </style>
</head>
<body>

<h2 style="text-align:center;">Event Scheduler</h2>

<div id='calendar'></div>

<div class="legend">
  <span style="color:green;">● Approved</span>
  <span style="color:orange;">● Pending</span>
  <span style="color:red;">● Not Available</span>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
      initialView: 'dayGridMonth',
      selectable: true,
      editable: false,
      height: 550,
      events: 'fetch-events.php',
      select: function(info) {
        var title = prompt("Enter Event Title:");
        if (title) {
          var formData = new FormData();
          formData.append("event", event);
          formData.append("start", info.startStr);
          formData.append("end", info.endStr);

          fetch('add-event.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              alert("Event submitted as pending.");
              calendar.refetchEvents();
            } else {
              alert(data.message);
            }
          });
        }
      }
    });
    calendar.render();
  });
</script>

</body>
</html>
