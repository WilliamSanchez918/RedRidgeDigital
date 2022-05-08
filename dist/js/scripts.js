//vanilla js
document.addEventListener("DOMContentLoaded", function() {
    // Handler when the DOM is fully loaded
    console.log("form Script loaded");
});

function validateForm() {
    let error;
    var name = document.getElementById('name').value;
    if (name == "") {
        error = document.getElementById('name-feedback');
        error.style.display = "block";
        return false;
    }
    var email = document.getElementById('email').value;
    if (email == "") {
        error = document.getElementById('email-feedback');
        error.style.display = "block";
        return false;
    } else {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(email)) {
            error = document.getElementById('email-feedback-invalid');
            error.style.display = "block";
            return false;
        }
    }
    var phone = document.getElementById('phone').value;
    if (phone == "") {
        error = document.getElementById('phone-invalid');
        error.style.display = "block";
        return false;
    }
    var message = document.getElementById('message').value;
    if (message == "") {
        error = document.getElementById('message-invalid');
        error.style.display = "block";
        return false;
    }

    formData = {
        'name': name,
        'email': email,
        'phone': phone,
        'message': message
    };

    let status = document.getElementById("submitSuccessMessage");
    status.classList.remove("d-none")

    document.getElementById('status').innerHTML = "Sending...";


    $.ajax({
        url: "mail.php",
        type: "POST",
        data: formData,
        success: function(data, textStatus, jqXHR) {

            $('#status').text(data.message);
            console.log("success")
            if (data.code) //If mail was sent successfully, reset the form.
                $('#contact-form').closest('form').find("input[type=text], textarea").val("");
                document.getElementById('status').innerHTML = "Message Sent. We will be in contact shortly.";
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#status').text(jqXHR);
        }
    });


    //   document.getElementById('contact-form').submit();

}
