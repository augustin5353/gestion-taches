import './bootstrap';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(function () {
    $('#datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});
