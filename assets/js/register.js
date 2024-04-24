"use strict";

function mainRegister()
{
    // Reset Register Form When Required
    resetRegisterForm();

    // Validate and Submit the Register Form
    validateAndSubmitRegisterForm();
}

function resetRegisterForm()
{
    $(window).on("beforeunload", function() {
        $("#username").val("");
        $("#aboutCheck").prop("checked", false);
        $("#privacyCheck").prop("checked", false);
    });
}

function validateAndSubmitRegisterForm()
{
    // Validate the username input
    $("#username").on({
        input: usernameValidate,
        focus: () => formControlFocusValidate("username"),
        blur: () => formControlBlurValidate("username")
    });

    // Validate Agree Checkbox
    $("#aboutCheck").on({
        change: agreeValidate,
        focus: () => formControlBlurValidate("aboutCheck"),
        blur: () => formControlBlurValidate("aboutCheck") 
    });

    // Validate Privacy Checkbox
    $("#privacyCheck").on({
        change: privacyValidate,
        focus: () => formControlFocusValidate("privacyCheck"),
        blur: () => formControlBlurValidate("privacyCheck")
    });

    // Submit the form
    $("#register-form").on("submit", function (e) {
        
        // Control whether AJAX Request should be performed or not
        var doAjax = false;

        // Make sure form submission is completely handled by JS, not by HTML or PHP
        e.preventDefault();

        // Check all required input elements have the is-valid class
        const inputControls = $("input").toArray();

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
                    displayFormErrorAlert("form-alerts-container", "Register Form Needs To Be Properly Filled");
                }

                break;
            }
        }

        // Perform AJAX Request if form has been properly filled
        if (doAjax)
        {
            // Grab the value of the username
            const username = $("#username").val();

            // Form JSON String to send to the back-end
            const data = JSON.stringify({
                username
            });

            // Send AJAX Request
            $.ajax({
                url: `${websiteURL}/form-handlers/register.php`,
                method: "POST",
                contentType: "application/json",
                data,
                beforeSend: function () {
                    // Disable Send Button To Avoid Request Before Response
                    const sendBtn = $("#send");
                    sendBtn.html(loadingSpinner());
                    sendBtn.prop("disabled", true);
                },
                success: function (response) {

                    // Grab username and token file content in base 64
                    const username = response["username"];
                    const password = response["password"];

                    // Decode the Base64 Rep of the Tokens File
                    const {url, fileName} = decodeBase64TextFile(response["token_file_base64"], `${username}-tokens.txt`);

                    // Grab the pertinent elements
                    const registerFormContainer = $("#register-form-container");
                    const credsShower = $("#creds-shower");

                    // Fade out and hide the registerFormContainer
                    registerFormContainer.fadeOut();
                    registerFormContainer.removeClass("d-flex");
                    registerFormContainer.addClass("d-none");

                    // Place corresponding user details where they belong
                    $("#user-congratulate").text(`Hello, ${username}!`);
                    $("#show-username").text(`${username}`);
                    $("#show-password").text(`${password}`);

                    // Add Link for file with tokens
                    $("#token-file-link").attr("href", url);
                    $("#token-file-link").attr("download", fileName);

                    // Fade in and show the credsShower
                    credsShower.removeClass("d-none");
                    credsShower.addClass("d-flex");
                    credsShower.fadeIn();
                },
                error: function (xhr) {
                    displayFormErrorAlert("form-alerts-container", xhr.responseJSON["error"]);
                },
                complete: function () {
                    // Enable Send Button To Avoid Request Before Response
                    const sendBtn = $("#send");
                    sendBtn.html("Send");
                    sendBtn.prop("disabled", false);
                }
            });
        }
    });
}

function agreeValidate()
{
    const isAgreed = $("#aboutCheck").prop("checked");

    if (isAgreed)
    {
        $("#aboutCheck").removeClass("is-invalid");
        $("#aboutCheck").addClass("is-valid");
    }

    else
    {
        $("#aboutCheck").removeClass("is-valid");
        $("#aboutCheck").addClass("is-invalid");
    }

}

function privacyValidate()
{
    const knowsPrivacy = $("#privacyCheck").prop("checked");

    if (knowsPrivacy)
    {
        $("#privacyCheck").removeClass("is-invalid");
        $("#privacyCheck").addClass("is-valid");
    }

    else
    {
        $("#privacyCheck").removeClass("is-valid");
        $("#privacyCheck").addClass("is-invalid");
    }
}

$(document).ready(mainRegister);