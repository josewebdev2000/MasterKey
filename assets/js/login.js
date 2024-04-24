"use strict";

function mainLogin()
{
    // Reset Login Form
    resetLoginForm();

    // Validate and Submit Login Form
    validateAndSubmitLoginForm();
}

function resetLoginForm()
{
    $(window).on("beforeunload", function () {
        $("#username").val("");
        $("#password").val("");
        $("#send").val("");
        $("#rememberMeCheck").prop("checked", false);
    });
}

function validateAndSubmitLoginForm()
{
    // Validate the username input
    $("#username").on({
        input: usernameValidate,
        focus: () => formControlFocusValidate("username"),
        blur: () => formControlBlurValidate("username")
    });

    // Validate the password input
    $("#password").on({
        input: passwordValidate,
        focus: () => formControlFocusValidate("password"),
        blur: () => formControlBlurValidate("password")
    });

    // Submit the form
    $("#login-form").on("submit", function (e) {

        // Control whether AJAX Request should be performed or not
        var doAjax = false;

        // Make sure form submission is completely handled by JS, not by HTML or PHP
        e.preventDefault();

        // Check all required input controls have the is-valid class
        const inputControls = $("input[type='text'], input[type='password']").toArray();

        for (let inputControl of inputControls)
        {
            if ($(inputControl).hasClass("is-valid"))
            {
                doAjax = true;
            }

            else
            {
                doAjax = false;

                if ($("#form-alerts-container").children().length < 1)
                {
                    displayFormErrorAlert("form-alerts-container", "Login Form Needs To Be Properly Filled");
                }

                break;
            }
        }

        // Perform AJAX Request in case form has been properly filled
        if (doAjax)
        {
            // Grab username, password, and rememberMe value
            const username = $("#username").val();
            const password = $("#password").val();
            const rememberMe = $("#rememberMeCheck").prop("checked");

            // Form JSON String to send to the back-end
            const data = JSON.stringify({
                username,
                password,
                rememberMe
            });

            // Send AJAX Request
            $.ajax({
                url: `${websiteURL}/form-handlers/login.php`,
                method: "POST",
                contentType: "application/json",
                data,
                beforeSend: function() {
                    // Disable Send Button To Avoid Request Before Response
                    const sendBtn = $("#send");
                    sendBtn.html(loadingSpinner());
                    sendBtn.prop("disabled", true);
                },
                success: function(response) {
                    displayFormSuccessAlert("form-alerts-container", "Login Form Was Successful Bro");
                },
                error: function(xhr) {
                    displayFormErrorAlert("form-alerts-container", "Login Failed Bro");
                },
                complete: function() {
                    // Enable Send Button To Avoid Request Before Response
                    const sendBtn = $("#send");
                    sendBtn.html("Send");
                    sendBtn.prop("disabled", false);
                }
            });
        }
    });

}

function passwordValidate()
{
    const curPassword = $("#password").val();

    if (curPassword.trim().length == 0)
    {
        $("#password").removeClass("is-valid");
        $("#password").addClass("is-invalid");
        $(".invalid-tooltip.password").text("Password cannot be empty");
    }

    else if (!passwordRegex.test(curPassword.trim()))
    {
        $("#password").removeClass("is-valid");
        $("#password").addClass("is-invalid");
        $(".invalid-tooltip.password").text("Password needs lowercase and uppercase letters, digits, no special characters, and 8 characters or more");
    }

    else
    {
        $("#password").removeClass("is-invalid");
        $(".invalid-tooltip.password").text("");
        $("#password").addClass("is-valid");
    }
}

$(document).ready(mainLogin);