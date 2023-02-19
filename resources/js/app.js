import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus';
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import EmojiPickerFormComponentAlpinePlugin from './filament/forms/emoji-picker';

import { Calendar } from '@fullcalendar/core'
import timeGridPlugin from '@fullcalendar/timegrid'

window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.plugin(focus);
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
Alpine.plugin(EmojiPickerFormComponentAlpinePlugin)

if (document.getElementById('calendar')) {
    const calendar = new Calendar(document.getElementById('calendar'), {
        plugins: [timeGridPlugin],
        initialView: 'timeGridWeek',
        events: {
            url: '/api/blocks',
        },
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'timeGridWeek'
        },
        firstDay: 1,
        slotDuration: '00:15:00',
        scrollTime: '08:00:00'
    })
    calendar.render();
}


Alpine.start();
