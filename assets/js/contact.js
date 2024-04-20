"use strict";

function mainContact()
{
    // Initialize Summernote to it looks pretty
    initializeSummerNote();

    // reset contact form on reload
    resetContactForm();

    // Validate the contact form
    validateAndSubmitContactForm();
}

function initializeSummerNote()
{
    $('#request').summernote({
        height: 300,
        width: "100%",
        placeholder: "Write your request here"
    });
}

function resetContactForm()
{
    $(window).on("beforeunload", function () {
        $("#name").val("");
        $("#email").val("");
        $("#subject").val("");
        $("#urgency").val("");
        $("#request").summernote("code", "");
    });
}

/** Write Code for Front-End Contact Form Validation and AJAX Sending */
function validateAndSubmitContactForm()
{
    // Validate the name input
    $("#name").on({
        input: nameValidate,
        focus: () => formControlFocusValidate("name"),
        blur: () => formControlBlurValidate("name")
    });

    // Validate the email input
    $("#email").on({
        input: emailValidate,
        focus: () => formControlFocusValidate("email"),
        blur: () => formControlBlurValidate("email")
    });

    // Validate the subject input
    $("#subject").on({
        input: subjectValidate,
        focus: () => formControlFocusValidate("subject"),
        blur: () => formControlBlurValidate("subject")
    });

    // Validate the urgency select
    $("#urgency").on({
        change: urgencyValidate,
        focus: () => formControlFocusValidate("urgency"),
        blur: () => formControlBlurValidate("urgency")
    });

    // Validate the request element
    $("#request").on({
        "summernote.change": requestValidate,
        "summernote.focus": () => formControlFocusValidate("request"),
        "summernote.blur": () => formControlBlurValidate("request")
    });

    // Submit the form
    $("#contact-form").on("submit", function (e) {

        var doAjax = false;

        // Make sure form submission is handled by JS, not by HTML or PHP
        e.preventDefault();

        // Check all required form controls have the is-valid class
        const formControls = $(".form-control:not(.note-input)").toArray();

        for (let formControl of formControls)
        {
            if ($(formControl).hasClass("is-valid"))
            {
                doAjax = true;
            }

            else
            {
                doAjax = false;
                if ($("#form-alerts-container").children().length < 1)
                {
                    displayFormErrorAlert("form-alerts-container", "Contact Form Needs To Be Properly Filled");
                }
                break;
            }
        }

        // Perform AJAX Request if form has been properly filled
        if (doAjax)
        {
            // Grab actual values of all form controls
            const name = $("#name").val();
            const email = $("#email").val();
            const subject = $("#subject").val();
            const urgency = $("#urgency").val();
            const request = $("#request").summernote("code");

            // Form JSON string to send to the back-end
            const data = JSON.stringify({
                name,
                email,
                subject,
                urgency,
                request
            });

            // Send AJAX Request
            $.ajax({
                url: `${websiteURL}/form-handlers/contact.php`,
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
                    displayFormSuccessAlert("form-alerts-container", response["success"]);  
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

function nameValidate() 
{
    const curName = $("#name").val();

    if (curName.trim().length == 0)
    {
        $("#name").removeClass("is-valid");
        $("#name").addClass("is-invalid");
        $(".invalid-tooltip.name").text("Name cannot be empty");
    }

    else if (!nameRegex.test(curName.trim()))
    {
        $("#name").removeClass("is-valid");
        $("#name").addClass("is-invalid");
        $(".invalid-tooltip.name").text("Name cannot have numbers or special symbols");
    }

    else
    {
        $("#name").removeClass("is-invalid");
        $(".invalid-tooltip.name").text("");
        $("#name").addClass("is-valid");
    }
}

function emailValidate()
{
    const curEmail = $("#email").val();

    if (curEmail.trim().length == 0)
    {
        $("#email").removeClass("is-valid");
        $("#email").addClass("is-invalid");
        $(".invalid-tooltip.email").text("Email cannot be empty");
    }

    else if (!emailRegex.test(curEmail.trim()))
    {
        $("#email").removeClass("is-valid");
        $("#email").addClass("is-invalid");
        $(".invalid-tooltip.email").text("Invalid Email");
    }

    else
    {
        $("#email").removeClass("is-invalid");
        $(".invalid-tooltip.email").text("");
        $("#email").addClass("is-valid");
    }
}

function subjectValidate()
{
    const curSubject = $("#subject").val();

    if (curSubject.trim().length == 0)
    {
        $("#subject").removeClass("is-valid");
        $("#subject").addClass("is-invalid");
        $(".invalid-tooltip.subject").text("Subject cannot be empty");
    }

    else
    {
        $("#subject").removeClass("is-invalid");
        $(".invalid-tooltip.subject").text("");
        $("#subject").addClass("is-valid");
    }
}

function urgencyValidate()
{
    const curUrgency = $("#urgency").val();

    if (curUrgency.length == 0)
    {
        $("#urgency").removeClass("is-valid");
        $("#urgency").addClass("is-invalid");
        $(".invalid-tooltip.urgency").text("Choose a valid option");
    }

    else
    {
        $("#urgency").removeClass("is-invalid");
        $(".invalid-tooltip.urgency").text("");
        $("#urgency").addClass("is-valid");
    }
}

function requestValidate()
{
    const curRequest = $("#request").summernote('code');

    if (curRequest.trim().length <= "<br>".length)
    {
        $("#request").removeClass("is-valid");
        $("#request").addClass("is-invalid");
        // You can customize the error message as needed
        $(".invalid-tooltip.request").text("Request cannot be empty");
    }
    else
    {
        $("#request").removeClass("is-invalid");
        $(".invalid-tooltip.request").text("");
        $("#request").addClass("is-valid");
    }
}

$(document).ready(mainContact);