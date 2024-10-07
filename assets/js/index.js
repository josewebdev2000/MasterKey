"use strict";

function main()
{
    // Make sure the group orientation of auth btns is correct
    new BtnGroupResponsive("#auth-btn-group", 992);

    // Make sure Bootstrap Tooltips are available throughout the whole application
    $("[data-toggle='tooltip']").tooltip();
}

$(document).ready(main);