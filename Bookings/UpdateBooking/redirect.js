function redirectBooking() {
    window.onload = function() {

    alert("Booking successful!!! You are being redirected to the search flight page.");

    setTimeout(function() {
        window.location.href = "searchFlights.php";
    }, 100);
    };
}

function goBackToSelect() {
    window.location.href = "searchFlights.php";
}

function goBackToHome() {
    window.location.href = "../../index.html";
}