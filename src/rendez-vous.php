<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Page de rendez-vous">
  <meta name="author" content="BALLEUR, ESMILAIRE, DONIKIAN, DI-MEO">
  <title>Prendre un rendez-vous</title>

  <link rel="icon" href="../ressources/images/logo.webp" type="image/webp">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- FullCalendar CSS -->
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.css' rel='stylesheet' />

  <!-- FullCalendar JS -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.js'></script>
</head>
<body>
  <?php include('header.php'); ?>
  <div class="container">
    <div class="row text-center">
      <div class="col-12">
        <h1>Prendre un rendez-vous</h1>
        <p>N'hésitez pas à prendre un rendez-vous avec un spécialiste</p>

        <!-- Ajout du calendrier FullCalendar -->
        <div id='calendar'></div>
      </div>
    </div>

    <!-- Formulaire de confirmation -->
    <form id="appointment-form" style="display: none;">
      <div class="row">
        <div class="col-12">
          <h2>Confirmer votre rendez-vous</h2>
          <p>Date et heure : <span id="appointment-date-time"></span></p>
          <button type="submit" class="btn btn-primary">Confirmer</button>
          <button type="button" class="btn btn-secondary" id="cancel-appointment">Annuler</button>
        </div>
      </div>
    </form>
  </div>

    <!-- FullCalendar Initialization -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      function generateRandomTimes(date) {
        let times = [];
        for (let i = 0; i < 3; i++) {
          let hour = Math.floor(Math.random() * 8) + 9;
          let minute = Math.floor(Math.random() * 2) * 30;
          let formattedMinute = minute < 10 ? '0' + minute : minute;
          times.push({ hour, minute, text: `${hour}h${formattedMinute}` });
        }
        return times;
      }

      let events = [];
      for (let i = 0; i < 30; i++) {
        let eventDate = new Date();
        eventDate.setDate(eventDate.getDate() + i);
        let eventTimes = generateRandomTimes(eventDate);

        eventTimes.forEach(time => {
          events.push({
            title: time.text,
            start: new Date(eventDate.getFullYear(), eventDate.getMonth(), eventDate.getDate(), time.hour, time.minute),
            end: new Date(eventDate.getFullYear(), eventDate.getMonth(), eventDate.getDate(), time.hour + 1, time.minute),
            extendedProps: {
              availableTimes: eventTimes
            }
          });
        });
      }

      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        selectMirror: true,
        eventContent: function(arg) {
          return { html: '<input type="radio" name="appointment-time" class="fc-event-radio" value="' + arg.event.title + '">' + arg.event.title };
        },
        eventClick: function(info) {
          let selectedTime = info.el.querySelector('.fc-event-radio');
          if (selectedTime.checked) {
            confirmAppointment(info.event.start, info.event.extendedProps.availableTimes);
          }
        },
        events: events
      });
      calendar.render();

      function confirmAppointment(date, times) {
        let selectedTime = times.find(t => t.text === document.querySelector('input[name="appointment-time"]:checked').value);
        if (selectedTime) {
          document.getElementById('appointment-date-time').textContent = date.toLocaleString('fr-FR', { dateStyle: 'long', timeStyle: 'short' });
          document.getElementById('appointment-form').style.display = 'block';
        }
      }

      document.getElementById('cancel-appointment').addEventListener('click', function() {
        document.getElementById('appointment-form').style.display = 'none';
      });
    });
  </script>
</body>
</html>