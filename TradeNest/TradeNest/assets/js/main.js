// TradeNest Main JavaScript
console.log("TradeNest Marketplace Loaded");

// Handle alert dismissals automatically
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);
});
