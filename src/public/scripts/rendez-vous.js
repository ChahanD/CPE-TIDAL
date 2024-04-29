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
