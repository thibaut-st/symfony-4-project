require('datatables.net-bs4');
import dt from 'datatables.net';

const LANG = require('./lang/datatables-fr');


$(document).ready(function () {
    $('.table-datatable').dataTable({
        "language": LANG
    });
});