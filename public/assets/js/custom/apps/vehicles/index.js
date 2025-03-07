$(document).ready(function () {
    $(".idr-currency").inputmask("numeric", {
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: "Rp ",
        autoGroup: true,
        digits: 0,
        rightAlign: false
    });
});
