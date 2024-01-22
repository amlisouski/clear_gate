// use strict mode
'use strict';

window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');
    window.Popper = require('@popperjs/core');
    window.bootstrap = require('bootstrap');
    require('select2');

} catch (e) {
    console.log(e);
}

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

import noUiSlider from 'nouislider';

window.noUiSlider = noUiSlider;

// import Swal from 'sweetalert2';
// window.Swal = Swal;

// import OnScreen from 'onscreen';
// window.os = new OnScreen();
//
import * as Chartist from 'chartist';

window.Chartist = Chartist;

import * as ChartistTooltip from 'chartist-plugin-tooltips';

window.Chartist.plugin = {};
window.Chartist.plugin.tooltip = ChartistTooltip;

import {Datepicker} from 'vanillajs-datepicker';

window.Datepicker = Datepicker;

import {Notyf} from 'notyf';

window.Notyf = Notyf;

import SimpleBar from 'simplebar';

window.SimpleBar = SimpleBar;

import moment from 'moment';

window.moment = moment;

import SmoothScroll from 'smooth-scroll';

window.SmoothScroll = SmoothScroll;

import DataTable from 'datatables.net-dt';
import 'datatables.net-rowreorder-bs5';
import 'datatables.net-responsive-bs5';
// import 'datatables.net-searchpanes-dt';
// import 'datatables.net-select-dt';

window.DataTable = DataTable;

import Helper from './scripts';

window.Helper = Helper;
