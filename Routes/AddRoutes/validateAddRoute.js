window.onload = function() {
    document.getElementById("DeptAirport").value = "";
    document.getElementById("ArrAirport").value = "";
    document.getElementById("TicketPrice").value = "";
    document.getElementById("Duration").value = "";
    document.getElementById("Status").value = "";
    document.getElementById("Duration").value = ""; 
};

function isLetter(char) {
    return (/[A-Z]/).test(char);
}

function isNumeric(num) {
    return !isNaN(num) && parseFloat(num) == num;
}

function isInteger(num) {
    return !isNaN(num) && parseInt(num) == num && !num.toString().includes('.');
}

function validateRoute() {
    const departure = document.getElementById("DeptAirport").value;
    const arrival = document.getElementById("ArrAirport").value;
    const tickets = document.getElementById("TicketPrice").value;
    const duration = document.getElementById("Duration").value;
    const status = document.getElementById("Status").value;

    if (departure === '' || arrival === '' || tickets === '' || duration === '' || status === '') {
        alert("All field are empty");
        return false;
    } 
    else if (!isLetter(departure.charAt(0)) || !isLetter(arrival.charAt(0))) {
        alert("Departure and Arrival Airport must start with an uppercase letter");
        return false;
    } 
    else if (departure.length !== 3 || arrival.length !== 3) {
        alert("Departure and Arrival Airport must be 3 characters in length");
        return false;
    } 
    else if (!isNumeric(tickets) || !isInteger(duration)) {
        alert("Ticket price must be a number and duration must be an integer");
        return false;
    }
    else {
        alert("Success");
        return true;
    }
}
