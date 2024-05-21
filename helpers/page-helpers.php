<?php 

function getActualDomain()
{
    return $_SERVER["SERVER_NAME"];
}

function getActualPageName()
{
    return basename($_SERVER['PHP_SELF']);
}

function getWebsiteUrl()
{
    return "http://localhost/projects/master-password-manager";
}

?>