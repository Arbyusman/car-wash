$(document).ready(function() {
    $('#cost, #total_cost, #additional_cost, #payment_amount, #change_amount')
        .closest('.fv-row')
        .hide();

    $('select[id="vehicle_id"]').on('change', function() {
        let selectedCost = $(this).find(':selected').data('cost') || 0;
        $('#cost')
            .val(formatRupiah(selectedCost))
            .prop('readonly', true)
            .closest('.fv-row').show();

        $('#additional_cost').closest('.fv-row').show();
        calculateTotal();
    });

    $('#additional_cost').on('change keyup input', function() {
        calculateTotal();
    });

    let timeout;
    $('#payment_amount').on('change keyup input', function() {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            let totalCost = parseCurrency($('#total_cost').val());
            let paymentAmount = parseCurrency($('#payment_amount').val());

            if (paymentAmount < totalCost) {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toastr-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };

                toastr.error("Jumlah Bayar Tidak Boleh Kurang Dari Total");
            }

            calculateChange();
        }, 500);
    });


    function formatRupiah(amount) {
        let number = parseFloat(amount) || 0;
        let numberString = number.toFixed(2);
        let split = numberString.split(".");
        let integerPart = split[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return 'Rp ' + integerPart;
    }

    function parseCurrency(value) {
        if (typeof value === "number") return value;
        if (!value || value === "") return 0;
        return parseFloat(value.toString().replace(/[^\d,]/g, "").replace(",", ".")) || 0;
    }

    function calculateTotal() {
        let cost = parseCurrency($('select[id="vehicle_id"]').find(':selected').data('cost'));
        let additionalCost = parseCurrency($('#additional_cost').val());
        let total = cost + additionalCost;

        $('#total_cost')
            .val(formatRupiah(total))
            .prop('readonly', true)
            .closest('.fv-row').show();

        $('#payment_amount, #change_amount').closest('.fv-row').show();

        calculateChange();
    }

    function calculateChange() {
        let totalCost = parseCurrency($('#total_cost').val());
        let paymentAmount = parseCurrency($('#payment_amount').val());


        let changeAmount = paymentAmount - totalCost;


        $('#change_amount')
            .val(changeAmount >= 0 ? formatRupiah(changeAmount) : 0)
            .prop('readonly', true);

    }
});
