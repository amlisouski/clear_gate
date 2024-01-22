import './bootstrap';

const d = window.document;
d.addEventListener('DOMContentLoaded', function (event) {

    // options
    const breakpoints = {
        sm: 540,
        md: 720,
        lg: 960,
        xl: 1140
    };

    var sidebar = document.getElementById('sidebarMenu');
    if (sidebar && d.body.clientWidth < breakpoints.lg) {
        sidebar.addEventListener('shown.bs.collapse', function () {
            document.querySelector('body').style.position = 'fixed';
        });
        sidebar.addEventListener('hidden.bs.collapse', function () {
            document.querySelector('body').style.position = 'relative';
        });
    }

    var iconNotifications = d.querySelector('.notification-bell');
    if (iconNotifications) {
        iconNotifications.addEventListener('shown.bs.dropdown', function () {
            iconNotifications.classList.remove('unread');
        });
    }

    //Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Datepicker
    var datepickers = [].slice.call(d.querySelectorAll('[data-datepicker]'));
    var datepickersList = datepickers.map(function (el) {
        return new Datepicker(el, {
            buttonClass: 'btn'
        });
    });

    if (d.querySelector('.current-year')) {
        d.querySelector('.current-year').textContent = moment().year();
    }

    if (d.querySelector('select.form-select')) {
        [].slice.call(d.querySelectorAll('select.form-select')).map(function (el) {
            $('#' + el.id).select2({
                theme: 'bootstrap-5',
                placeholder: el.getAttribute('data-placeholder'),
                closeOnSelect: !el.getAttribute('multiple'),
                // Allow to add new values if not exist
                tags: !el.getAttribute('data-allow-custom-entries')
            });
        });
    }
});




