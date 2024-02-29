// custom.js
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('duree_abonnement').addEventListener('change', function() {
        updateEndDate();
    });

    document.getElementById('date_abonnement').addEventListener('change', function() {
        updateEndDate();
    });

    function updateEndDate() {
        const startDate = new Date(document.getElementById('date_abonnement').value);
        const duration = parseInt(document.getElementById('duree_abonnement').value);
        const endDate = new Date(startDate.getFullYear(), startDate.getMonth() + duration, startDate.getDate() - 1); // Soustraire 1 jour pour obtenir la fin de la journée précédente
        document.getElementById('date_fin_abonnement').value = endDate.toISOString().split('T')[0];
    }

    // Appeler la fonction updateEndDate() une fois pour initialiser la date de fin
    updateEndDate();
});
