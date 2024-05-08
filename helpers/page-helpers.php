<?php 

function getActualPageName()
{
    return basename($_SERVER['PHP_SELF']);
}

function getWebsiteUrl()
{
    return "http://localhost/projects/master-password-manager";
}

?>