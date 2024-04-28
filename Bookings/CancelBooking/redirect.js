function redirectCancelBooking() {
    window.onload = function() {

    alert("Booking Successfully Cancelled!!! You are being redirected to the Home flight page.");

    setTimeout(function() {
        window.location.href = "../../index.html";
    }, 100);
    };
}


function goBackToHome() {
    window.location.href = "../../index.html";
}