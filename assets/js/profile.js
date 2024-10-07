"use strict";

function mainProfile()
{
    // Detect when the Profile Picture button is clicked
    const profilePicBtn = $("a[href='#profile-pic-editor']");

    profilePicBtn.on("click", function () {
        // Grab relevant ids
        const picsGridSelectorId = "pic-grid-selector";
        const inputUrlId = "avatar-url";
        const avatarButtonId = "avatar-btn";

        // Initialize a Pic Grid Selector
        const avatarPicSelector = new PicGridSelector(picsGridSelectorId, inputUrlId, avatarButtonId);

        // Send the Pic to the Backend
        avatarPicSelector.sendPicUrlToBackend(
            avatarPicSelector,
            `${websiteURL}`
        );
    });
}

$(document).ready(mainProfile);