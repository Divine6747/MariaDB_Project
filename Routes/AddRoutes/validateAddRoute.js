window.onload = function() {
    document.getElementById("DeptAirport").value = "";
    document.getElementById("ArrAirport").value = "";
    document.getElementById("TicketPrice").value = "";
    document.getElementById("Duration").value = "";
    document.getElementById("Status").value = "";
    document.getElementById("Duration").value = ""; 
};

function isNumeric(num) {
    return !isNaN(num) && parseFloat(num) == num;
}

function isInteger(num) {
    return !isNaN(num) && parseInt(num) == num && !num.toString().includes('.');
}

function validateRoute() {
    const tickets = document.getElementById("TicketPrice").value;
    const duration = document.getElementById("Duration").value;

    if (!isNumeric(tickets) || !isInteger(duration)) {
        alert("Ticket price must be an integer or decimal");
        return false;
    }

    if (!isInteger(duration)) {
        alert("Duration must be integer");
        return false;
    }
}
