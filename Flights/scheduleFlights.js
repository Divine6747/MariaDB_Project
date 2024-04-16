function validateDate() {    
    let selectedDate = new Date(document.getElementById("departureDate").value);
    let today = new Date();

    if (selectedDate <= today) {
        alert("Please select a departure date greater than today.");
        return false;
    }
    return true;
}
/**
    https://www.w3schools.com/js/tryit.asp?filename=tryjs_date_date
    Visited: 16/04/24
    Content: Using the data object for example new Date()
    Created B: W3Schools
 **/