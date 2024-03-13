"use strict";

function mainContact()
{
    initializeSummerNote();
}

function initializeSummerNote()
{
    $('.summernote').summernote({
        height: 300,
        width: "100%",
        placeholder: "Write your request here"
    });
}

$(document).ready(mainContact);