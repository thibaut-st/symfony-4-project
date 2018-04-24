const toastr = require('toastr');

toastr.options.escapeHtml = true;
toastr.options.closeButton = true;
toastr.options.progressBar = true;
toastr.options.timeOut = 6000;
toastr.options.extendedTimeOut = 3000;

module.exports = toastr;