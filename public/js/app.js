'use strict';

let datepicker = $('#datepicker,.datepicker');

if (datepicker.length > 0) {
    datepicker.datepicker({
        uiLibrary: 'bootstrap4',
        format:    'yyyy-mm-dd'
    });
}

