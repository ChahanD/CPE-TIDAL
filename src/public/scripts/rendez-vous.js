document.addEventListener('DOMContentLoaded', function() {
    /*
    * This is responsible for rendering a calendar with random available times for appointments.
    * When the user clicks on an available time, a confirmation form is displayed.
    * The calendar is rendered using FullCalendar.
    * The script is executed when the DOM is fully loaded.
    */

    function generateRandomTimes() {
        /*
        * This function generates random available times for appointments.
        * The times are generated between 9:00 and 17:00, with a 30 minutes interval.
        * @returns {array} An array with 3 random times.
        */
      let times = [];
      for (let i = 0; i < 3; i++) {
            let hour = Math.floor(Math.random() * 8) + 9;
            let minute = Math.floor(Math.random() * 2) * 30;
            let formattedMinute = minute < 10 ? '0' + minute : minute;
            times.push({ hour, minute, text: `${hour}h${formattedMinute}` });
        }
      return times;
    }

    function confirmAppointment(date, times) {
        /*
        * This function displays the confirmation form for the appointment.
        * @param {Date} date The date of the appointment.
        * @param {array} times The available times for the appointment.
        */
        let selectedTime = times.find(t => t.text === document.querySelector('input[name="appointment-time"]:checked').value);
        if (selectedTime) {
            document.getElementById('appointment-date-time').textContent = date.toLocaleString('fr-FR', { dateStyle: 'long', timeStyle: 'short' });
            document.getElementById('appointment-form').style.display = 'block';
        }
    }

    // Generate random events for the calendar
    let events = [];
    for (let i = 0; i < 30; i++) {
        let eventDate = new Date();
        eventDate.setDate(eventDate.getDate() + i);
        let eventTimes = generateRandomTimes();

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

    // Render the calendar
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        selectMirror: true,

        // Display the available times as radio buttons
        eventContent: function(arg) {
            return { html: '<input type="radio" name="appointment-time" class="fc-event-radio" value="' + arg.event.title + '">' + arg.event.title };
        },

        // When the user clicks on an available time, display the confirmation form
        eventClick: function(info) {
            let selectedTime = info.el.querySelector('.fc-event-radio');
            if (selectedTime.checked) {
            confirmAppointment(info.event.start, info.event.extendedProps.availableTimes);
            }
        },
        events: events
    });
    calendar.render();

    // When the user clicks on the "Cancel" button, hide the confirmation form
    document.getElementById('cancel-appointment').addEventListener('click', function() {
        document.getElementById('appointment-form').style.display = 'none';
    });
});
