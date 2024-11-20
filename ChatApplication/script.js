function signUp() {

    var fName = document.getElementById("f").value;
    var lName = document.getElementById("l").value;
    var nName = document.getElementById("n").value;
    var password = document.getElementById("p").value;
    var email = document.getElementById("e").value;


    var form = new FormData();
    form.append("f", fName);
    form.append("l", lName);
    form.append("n", nName);
    form.append("p", password);
    form.append("e", email);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            swal({
                    title: "Good Job!",
                    text: response,
                    icon: "success",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "index.php";

                    } else {
                        window.location = "sigup.php";
                    }
                });
        }
    };
    request.open("POST", "signUpProcess.php", true);
    request.send(form);
}


function signIn() {

    var email = document.getElementById("e").value;
    var password = document.getElementById("p").value;

    var form = new FormData();
    form.append("e", email);
    form.append("p", password);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                swal({
                        title: "Good Job!",
                        text: response,
                        icon: "success",
                        buttons: true,
                        dangerMode: false,
                    })
                    .then((ok) => {
                        if (ok) {
                            window.location = "chat.php";

                        } else {
                            window.location = "index.php";
                        }
                    });

            } else {
                swal("!", response, "error");

            }
        }
    };

    request.open("POST", "signInProcess.php", true);
    request.send(form);

}

function send() {
    var receiver = document.getElementById("receiver").value;
    var msg = document.getElementById("msg").value;

    var form = new FormData();
    form.append("r", receiver);
    form.append("m", msg);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "Success") {
                swal("", "කෙටි පණිවුඩය උඩුගත වන ලදි", "success");
            } else {
                swal("!", "කෙටි පණිවුඩය උඩුගත වුයේ නැත.", "error");

            }
        }
    };

    request.open("POST", "sendProcess.php", true);
    request.send(form);





}

function loadMsg() {

    var receiver = document.getElementById("receiver").value;

    var form = new FormData();
    form.append("r", receiver);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            document.getElementById("msgbox").innerHTML = response;
        }
    };

    request.open("POST", "loadMsgProcess.php", true);
    request.send(form);

}

function y() {
    setInterval(loadMsg, 5000);
}