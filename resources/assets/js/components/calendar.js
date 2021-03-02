/**
 * Calendar instantiation
 */

import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import listPlugin from '@fullcalendar/list'

var calendarEl = document.getElementById('calendar')

let calendar = new Calendar(calendarEl, {
  plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
  initialView: 'dayGridMonth',
  headerToolbar: {
    start: 'title',
    center: 'dayGridMonth,timeGridDay,timeGridWeek,listYear',
    end: 'today prev,next',
  },
  locale: 'pt-br',
  eventSources: ['/agenda/feed'],
  views: {
    dayGridMonth: {
      buttonText: 'mês',
    },
    timeGridDay: {
      buttonText: 'dia',
    },
    timeGridWeek: {
      buttonText: 'semana',
    },
    listYear: {
      buttonText: 'ano',
    },
  },
})

if (calendarEl) {
  calendar.render()
}

//
// jQuery(document).ready(function () {
//   jQuery('#calendar').fullCalendar({
//     locale: 'pt-br',
//
//     eventSources: ['/agenda/feed'],
//
//     header: { center: 'month,agendaDay,agendaWeek,listYear' }, // buttons for switching between views
//
//   })
// })
