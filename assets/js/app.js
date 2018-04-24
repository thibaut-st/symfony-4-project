//module
const $ = require('jquery');
require('bootstrap');
require('sweetalert');

//locale
require('./init-datatable');
const toastr = require('./init-toastr');

//global
global.$ = global.jQuery = $;
global.toastr = toastr;