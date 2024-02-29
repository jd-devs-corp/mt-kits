$(document).ready(function () {
    function updateEndDate() {
        var startDate = $('[name="date_abonnement"]').val();
        var duration = $('[name="duree_abonnement"]').val();

        if (startDate && duration) {
            var endDate = new Date(startDate);
            endDate.setMonth(endDate.getMonth() + parseInt(duration));
            var endDateFormatted = endDate.toISOString().split('T')[0];
            $('[name="date_fin_abonnement"]').val(endDateFormatted);
        }
    }

    $('[name="date_abonnement"], [name="duree_abonnement"]').on('change', function () {
        updateEndDate();
    });

    updateEndDate();
});
