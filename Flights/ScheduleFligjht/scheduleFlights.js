
/**
    https://www.w3schools.com/js/tryit.asp?filename=tryjs_date_date
    Visited: 16/04/24
    Content: Using the data object for example new Date()
    Created B: W3Schools
 **/

function validateScheduleFlight(){
    const noSeats = document.getElementById("noSeats").value;
    let selectedDate = new Date(document.getElementById("departureDate").value);
    let today = new Date();

    if (selectedDate <= today) {
        alert("Please select a departure date greater than today.");
        return false;
    }
    if (noSeats < 10 || noSeats >100) {
        alert("Please add and appropiate number of seats.");
        return false;
    }

}

