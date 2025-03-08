$(document).ready(function () {
    $(document).on('shown.bs.modal', '[id^="update-wash-transaction"]', function () {
        let modal = $(this);
        modal.find('#edit_cost, #edit_total_cost, #edit_additional_cost, #edit_payment_amount, #edit_change_amount')
            .closest('.fv-row')
            .hide();

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
            let cost = parseCurrency(modal.find('#edit_vehicle_id').find(':selected').data('cost'));
            let additionalCost = parseCurrency(modal.find('#edit_additional_cost').val());
            let total = cost + additionalCost;

            modal.find('#edit_total_cost')
                .val(formatRupiah(total))
                .prop('readonly', true)
                .closest('.fv-row').show();

            modal.find('#edit_payment_amount, #edit_change_amount').closest('.fv-row').show();

            calculateChange();
        }

        function calculateChange() {
            let totalCost = parseCurrency(modal.find('#edit_total_cost').val());
            let paymentAmount = parseCurrency(modal.find('#edit_payment_amount').val());

            let changeAmount = paymentAmount - totalCost;

            modal.find('#edit_change_amount')
                .val(changeAmount >= 0 ? formatRupiah(changeAmount) : 0)
                .prop('readonly', true);
        }

        modal.find('#edit_vehicle_id').on('change', function () {
            let selectedCost = modal.find(this).find(':selected').data('cost') || 0;
            modal.find('#edit_cost')
                .val(formatRupiah(selectedCost))
                .prop('readonly', true)
                .closest('.fv-row').show();

            modal.find('#edit_additional_cost').closest('.fv-row').show();
            calculateTotal();
        });

        modal.find('#edit_additional_cost').on('change keyup input', function () {
            calculateTotal();
        });

        let timeout;
        modal.find('#edit_payment_amount').on('change keyup input', function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                let totalCost = parseCurrency(modal.find('#edit_total_cost').val());
                let paymentAmount = parseCurrency(modal.find('#edit_payment_amount').val());

                if (paymentAmount < totalCost) {
                    toastr.error("Jumlah Bayar Tidak Boleh Kurang Dari Total");
                }

                calculateChange();
            }, 500);
        });

        function triggerOldValues() {
            let selectedVehicleCost = modal.find('#edit_vehicle_id').find(':selected').data('cost') || 0;
            modal.find('#edit_cost').val(formatRupiah(selectedVehicleCost)).prop('readonly', true);

            modal.find('#edit_vehicle_id').trigger('change');
            modal.find('#edit_additional_cost').trigger('change');
            modal.find('#edit_payment_amount').trigger('change');
        }

        triggerOldValues();
    });
});
