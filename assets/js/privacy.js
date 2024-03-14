"use strict";

function mainContact()
{
    smoothlyScrollLinkHash();

    // Execute Once the Page is First Loaded
    manageStylesOfPrivacySections();

    // Run Also every time the window is resized
    $(window).resize(manageStylesOfPrivacySections);

    // Scroll Up Btn
    //new ScrollToTopBtn();
}

function smoothlyScrollLinkHash()
{
    $("a").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } 
    });
}

function manageStylesOfPrivacySections()
{
    // Grab the current screen width
    const newScreenWidth = $(window).width();

    console.log(newScreenWidth);

    // Grab Button Group Element
    const privacyNavBarContainer = $("#privacy-navbar-container");
    const privacyNavBar = $("#privacy-navbar");
    const privacyBtnGroup = $("#privacy-sections-group");
    const privateBtns = $("#privacy-sections-group > button");
    
    // In case the screen width is less than 576
    if (newScreenWidth <= 992)
    {
        privateBtns.addClass("w-100");
        privacyNavBar.addClass("text-center");
        privacyBtnGroup.addClass("flex-column");
        privacyBtnGroup.addClass("align-items-center");
    }

    else
    {
        privateBtns.removeClass("w-100");
        privacyBtnGroup.removeClass("flex-column");
        privacyBtnGroup.removeClass("align-items-center");
        privacyNavBar.removeClass("text-center");
    }
}

$(document).ready(mainContact);