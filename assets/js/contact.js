"use strict";

function mainContact()
{
    // Initialize Summernote to it looks pretty
    initializeSummerNote();

    // Validate the contact form
    validateContactForm();
}

function initializeSummerNote()
{
    $('.summernote').summernote({
        height: 300,
        width: "100%",
        placeholder: "Write your request here"
    });
}

/** Write Code for Front-End Contact Form Validation and AJAX Sending */
function validateContactForm()
{
    // Validate input elements as soon as the appear on the page if they are not empty
    initialNameValidation();
    initialEmailValidation();
    initialSubjectValidation();
    initialUrgencyValidation();

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
                    sendBtn.html(`
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                    `);
                    sendBtn.prop("disabled", true);
                },
                success: function () {},
                error: function () {},
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

function initialNameValidation()
{
    /** Run to validate Name as soon as the script is loaded */
    const initialName = $("#name").val();

    if (initialName.trim().length > 0)
    {
        nameValidate();
        $(".valid-tooltip.name").hide();
        $(".invalid-tooltip.name").hide();
    }
}

function initialEmailValidation()
{
    /** Run to validate Email as soon as the script is loaded */
    const initialEmail = $("#email").val();

    if (initialEmail.trim().length > 0)
    {
        emailValidate();
        $(".valid-tooltip.email").hide();
        $(".invalid-tooltip.email").hide();
    }
}

function initialSubjectValidation()
{
    /** Run to validate Subject as soon as the script is loaded */
    const initialSubject = $("#subject").val();

    if (initialSubject.trim().length > 0)
    {
        subjectValidate();
        $(".valid-tooltip.subject").hide();
        $(".invalid-tooltip.subject").hide();
    }
}

function initialUrgencyValidation()
{
    /** Run to validate Urgency as soon as the script is loaded */
    const initialUrgency = $("#urgency").val();

    if (initialUrgency.trim().length > 0)
    {
        urgencyValidate();
        $(".valid-tooltip.urgency").hide();
        $(".invalid-tooltip.urgency").hide();
    }
}

function initialRequestValidation()
{
    /** Run to validate Request as soon as the script is loaded */
    const initialRequest = $("#request").summernote("code");

    if (initialRequest.trim().length > 0)
    {
        requestValidate();
        $(".valid-tooltip.request").hide();
        $(".invalid-tooltip.request").hide();
    }
}

function formControlFocusValidate(form_control_id)
{
    /** Execute when input element is on focus */
    if ($(`#${form_control_id}`).hasClass("is-valid"))
    {
        $(`.valid-tooltip.${form_control_id}`).fadeIn();
    }

    if ($(`#${form_control_id}`).hasClass("is-invalid"))
    {
        $(`.invalid-tooltip.${form_control_id}`).fadeIn();
    }
}

function formControlBlurValidate(form_control_id)
{
    /** Execute when input element is on blur */
    $(`.valid-tooltip.${form_control_id}`).fadeOut();
    $(`.invalid-tooltip.${form_control_id}`).fadeOut();
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

function displayFormErrorAlert(alert_container_id ,error_msg)
{
    // Create Error Alert
    const eAlert = $(errorAlert(error_msg));

    // Append the alert to the container
    $(`#${alert_container_id}`).append(eAlert);

    // Fade in the alert in 150 mls
    setTimeout(() => eAlert.addClass("show"), 150);
}

function displayFormSuccessAlert(alert_container_id, success_msg)
{
    // Create Success Alert
    const sAlert = $(errorAlert(success_msg));

    // Append the alert to the container
    $(`#${alert_container_id}`).append(sAlert);

    // Fade in the alert in 150 mls
    setTimeout(() => eAlert.addClass("show"), 150);
}

function removeAlertFromContainer(alert_container_id, alert_selector)
{
    $(`#${alert_container_id}`).find(alert_selector).remove();
}

$(document).ready(mainContact);