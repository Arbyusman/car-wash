$(document).ready(function () {
    Inputmask({
        alias: "numeric",
        radixPoint: ",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: "Rp ",
        autoGroup: true,
        digits: 0,
        rightAlign: false,
        removeMaskOnSubmit: true
    }).mask(".idr-currency");



    Inputmask({
        mask: "[A{1,3}] 9999 [A{1,3}]",
        definitions: {
            "A": {
                validator: "[A-Z]",
                casing: "upper"
            },
            "9": {
                validator: "[0-9]"
            }
        },
        greedy: false,
    }).mask(".plate-number");
});
