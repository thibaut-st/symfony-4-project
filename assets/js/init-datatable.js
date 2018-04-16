require('datatables.net-bs4');

let locale = document.getElementById('locale-for-js');
const DT_LANG = require('./lang/datatables/datatables-' + locale.dataset.lang);

function initDT() {
    return $(document).ready(function () {
        $('.table-datatable').dataTable({
            "language": DT_LANG
        });
    });
}

module.exports = initDT();