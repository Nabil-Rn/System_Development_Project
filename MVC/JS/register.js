function validateForm() {
    var email = $("#email").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var password = $("#password").val();
    var formCheck = true;
    var emailRegex = /^[a-zA-Z0-9._%+-]{3,}@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/;
    var usernameRegex = /^[a-zA-Z0-9][a-zA-Z0-9-]*$/;
    var pswdRegex = /^(?=.+\d)(?=.+[A-Z])(?=.+[a-z])[A-Za-z\d@!$\.]{8,24}$/;
    var addNumber = /^(?=.*\d).*/;

    //Email check
    if (!emailRegex.test(email)) {
        $("#email").addClass("error");
        $("#email-error").html("Invalid email address.");
        formCheck = false;
    } else {
        $("#email").removeClass("error");
        $("#email-error").html("");
        formCheck = true;
    }

    // first name check
    if (!usernameRegex.test(firstname)) {
        $("#username").addClass("error");
        $("#user-error").html("error: it must at least three letters");
        formCheck = false;
    } else {
        $("#username").removeClass("error");
        $("#user-error").html("");
        formCheck = true;
    }

    // last name check
    if (!usernameRegex.test(lastname)) {
        $("#username").addClass("error");
        $("#user-error").html("error: it must at least three letters");
        formCheck = false;
    } else {
        $("#username").removeClass("error");
        $("#user-error").html("");
        formCheck = true;
    }

    //Password check
    if (!pswdRegex.test(password)) {
        if (!addNumber.test(password) && password!="") {
        $("#pass").addClass("error");
        $("#pass-error").html("Missing a number");
        formCheck = false;
        }
    } else {
        if(pswd.includes(username) ){
            $("#pass-error").html("it has your Username, it's best to remove it");
        }
        $("#pass").removeClass("error");
        $("#pass-error").html("");
    }

    if (formCheck) {
        return true;
    } else {
        return false;
    }
}