import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus';
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'

import { Calendar } from '@fullcalendar/core'
import timeGridPlugin from '@fullcalendar/timegrid'

window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.plugin(focus);
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)

const calendar = new Calendar(document.getElementById('calendar'), {
    plugins: [timeGridPlugin],
    initialView: 'timeGridWeek',
    headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'timeGridWeek'
    }
})
calendar.render();


Alpine.start();
