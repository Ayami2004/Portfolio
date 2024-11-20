//The Modal
function closeModal() {
    document.getElementById("errorModal").style.display = "none";
}

window.onclick = function(event) {
    var modal = document.getElementById("errorModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

//Checking if the user-entered email is pre-registered
function checkEmail() {
    var email = document.getElementById("email").value;
    var errorMsg = document.getElementById("errorMessage");

    var form = new FormData();
    form.append("email", email);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response == "Email Exists") {
                errorMsg.innerHTML = "This Email is already Registered.";
                document.getElementById('errorModal').style.display = 'block';
                document.getElementById('email').value = '';
            }
        }
    };

    request.open("POST", "checkEmail.php", true);
    request.send(form);
}

//Obtaining user data from the first signUp page
function saveAndSignUp() {
    var email = document.getElementById("email").value;
    var pw = document.getElementById("pw").value;
    var errorMsg = document.getElementById("errorMessage");

    var form = new FormData();
    form.append("email", email);
    form.append("pw", pw);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "signup2.php";
            } else {
                errorMsg.innerHTML = response;
                document.getElementById('errorModal').style.display = 'block';
            }

        }
    };

    request.open("POST", "signUpStepOne.php", true);
    request.send(form);
}

function signUp() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var mobile = document.getElementById("mobile").value;
    var errorMsg = document.getElementById("errorMessage");


    var form = new FormData();
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("m", mobile);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "signin.php";
            } else {
                errorMsg.innerHTML = response;
                document.getElementById('errorModal').style.display = 'block';
            }
        }
    };

    request.open("POST", "signUpProcess.php", true);
    request.send(form);
}

function signIn() {
    var email = document.getElementById("email").value;
    var pw = document.getElementById("pw").value;
    var rememberMe = document.getElementById("rememberMe").checked;
    var errorMsg = document.getElementById("errorMessage");

    var form = new FormData();
    form.append("email", email);
    form.append("pw", pw);
    form.append("rm", rememberMe);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response === "Success") {
                window.location = "home.php";
            } else {
                errorMsg.innerHTML = response;
                document.getElementById('errorModal').style.display = 'block';
            }
        }
    };

    request.open("POST", "signInProcess.php", true);
    request.send(form);
}

function checkAndSignIn() {
    var email = document.getElementById("email").value;
    var pw = document.getElementById("pw").value;
    var errorMsg = document.getElementById("errorMessage");

    var form = new FormData();
    form.append("email", email);
    form.append("pw", pw);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response === "Success") {
                signIn();
            } else {
                errorMsg.innerHTML = response;
                document.getElementById('errorModal').style.display = 'block';
            }
        }
    };

    request.open("POST", "validateEmailAndPassword.php", true);
    request.send(form);
}

function editProfile() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var nic = document.getElementById("nic").value;
    var mobile = document.getElementById("mobile").value;

    var form = new FormData();
    form.append("f", fname);
    form.append("l", lname);
    form.append("n", nic);
    form.append("m", mobile);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "profile.php";
            }
        }
    };

    request.open("POST", "editProfileProcess.php", true);
    request.send(form);
}

function addVehicleHTML() {
    var vehicleSection = document.getElementById("vehicleSection");
    var vehicleCount = document.querySelectorAll('.vehicle-info').length + 1;

    var newVehicleDiv = document.createElement("div");
    newVehicleDiv.className = "vehicle-info";
    newVehicleDiv.innerHTML = `
    <p>Vehicle ${vehicleCount}</p>
    <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">Vehicle No</span><br />
    <input class="profileinput" type="text" name="vehicle_no[]" /><br />
    <span style="margin-top: -15px; font-size: 10px; color: rgb(71, 71, 71);">Vehicle Model</span><br />
    <input class="profileinput" type="text" name="vehicle_model[]" /><br />
    <button class="delete-vehicle vehiclebtn" onclick="deleteVehicle(this)">Delete</button>
`;
    vehicleSection.appendChild(newVehicleDiv);
}

function deleteVehicle(button) {
    var vehicleDiv = button.parentNode;
    vehicleDiv.classList.add('deleted');
    vehicleDiv.style.display = 'none';
}

function saveVehicle() {
    var vehicles = document.querySelectorAll('.vehicle-info');
    var vehicle_nos = [];
    var vehicle_models = [];
    var deleted_vehicles = [];

    vehicles.forEach(function(vehicle) {
        var vehicle_no_input = vehicle.querySelector('input[name="vehicle_no[]"]');
        var vehicle_model_input = vehicle.querySelector('input[name="vehicle_model[]"]');

        if (!vehicle.classList.contains('deleted')) {
            var vehicle_no = vehicle_no_input ? vehicle_no_input.value : '';
            var vehicle_model = vehicle_model_input ? vehicle_model_input.value : '';

            if (vehicle_no.trim() !== '' && vehicle_model.trim() !== '') {
                vehicle_nos.push(vehicle_no);
                vehicle_models.push(vehicle_model);
            }
        } else {
            var deleted_vehicle_no = vehicle_no_input ? vehicle_no_input.value : '';
            if (deleted_vehicle_no.trim() !== '') {
                deleted_vehicles.push(deleted_vehicle_no);
            }
        }
    });

    var form = new FormData();
    form.append('vehicle_no', JSON.stringify(vehicle_nos));
    form.append('vehicle_model', JSON.stringify(vehicle_models));
    form.append('deleted_vehicles', JSON.stringify(deleted_vehicles)); // Include deleted vehicles

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response === "Success") {
                window.location = "profile.php"; // Redirect or handle success
            } else {
                alert("Failed to save vehicles. Please try again.");
            }
        }
    };

    request.open("POST", "saveVehicles.php", true);
    request.send(form);
}


let selectedChargerId = null; // Global variable to store the selected charger ID

function handleChargerClick(chargerId) {
    // Disable all charger buttons
    const buttons = document.querySelectorAll('.tile');
    buttons.forEach(button => {
        button.disabled = true;
    });

    // Re-enable the clicked button
    document.getElementById(chargerId).disabled = false;

    var form = new FormData();
    form.append("ci", chargerId);
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response == "Success") {
                // Re-enable all buttons after alert is closed
                buttons.forEach(button => {
                    button.disabled = false;
                });
            }

            // Re-enable all buttons after alert is closed
            buttons.forEach(button => {
                button.disabled = false;
            });

            // Store the selected charger ID
            selectedChargerId = chargerId;
        }
    };

    request.open("POST", "handleCharger.php", true);
    request.send(form);
}

document.addEventListener("DOMContentLoaded", function() {
    var startChargingButton = document.getElementById("startChargingButton");

    startChargingButton.addEventListener("click", function() {
        if (!selectedChargerId) {
            alert("Please select a charger first.");
            return;
        }

        var form = new FormData();
        form.append("chargerId", selectedChargerId);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.status === 200 && request.readyState === 4) {
                var response = request.responseText;
                alert(response);
                if (response == "Charging session started successfully.") {
                    window.location = "stopcharger.php";

                } else {
                    alert("Failed to start charging");
                }
            }
        };

        request.open("POST", "startChargingSession.php", true);
        request.send(form);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var stopChargingButton = document.getElementById("stopChargingButton");

    stopChargingButton.addEventListener("click", function() {

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.status === 200 && request.readyState === 4) {
                var response = request.responseText;
                if (response == "Charging session stopped successfully.") {
                    document.getElementById("stopPagePaymentBtn").style.display = "block";
                    stopChargingButton.innerHTML = "Charging Stopped";
                    document.getElementById("stopHeadText").innerHTML = "Please Remove your Charger to end Charging";
                }
            }
        };

        request.open("POST", "stopChargingSession.php", true);
        request.send();
    });
});

function proceedToPayment() {
    var consumedUnits = document.getElementById("chargingUnits").value;
    var vehicleId = document.getElementById("vehicleNo").value;

    var form = new FormData();
    form.append("u", consumedUnits);
    form.append("vid", vehicleId);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            if (response == "Success") {
                window.location = "paymentsum.php";
            }
        }
    };

    request.open("POST", "paymentProcess.php", true);
    request.send(form);
}

function paymentGateway() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;
            var paymentObject = JSON.parse(response);
            // Payment completed. It can be a successful failure.
            payhere.onCompleted = function onCompleted(orderId) {
                alert("Payment Successful");
                // Note: validate the payment and show success or failure page to the customer
            };

            // Payment window closed
            payhere.onDismissed = function onDismissed() {
                // Note: Prompt user to pay again or show an error page
                alert("Payment dismissed");
            };

            // Error occurred
            payhere.onError = function onError(error) {
                // Note: show an error page
                alert("Error Occured: " + error);
            };

            // Put the payment variables here
            var payment = {
                "sandbox": true,
                "merchant_id": "1227678", // Replace your Merchant ID
                "return_url": "http://localhost/Friedrik's/success.php", // Important
                "cancel_url": "http://localhost/Friedrik's/error.php", // Important
                "notify_url": "http://sample.com/notify",
                "order_id": `${paymentObject["order_id"]}`,
                "items": paymentObject["items"],
                "amount": `${paymentObject["amount"]}`,
                "currency": "LKR",
                "hash": paymentObject["hash"],
                // *Replace with generated hash retrieved from backend
                "first_name": paymentObject["first_name"],
                "last_name": paymentObject["last_name"],
                "email": paymentObject["email"],
                "phone": paymentObject["phone"],
                "address": paymentObject["address"],
                "city": paymentObject["city"],
                "country": paymentObject["Colombo"],
            };

            // Show the payhere.js popup, when "PayHere Pay" is clicked
            payhere.startPayment(payment);
        }
    };

    request.open("POST", "paymentGateway.php", true);
    request.send();
}