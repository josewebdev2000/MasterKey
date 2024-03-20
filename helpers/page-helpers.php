<?php 

function getActualPageName()
{
    return basename($_SERVER['PHP_SELF']);
}

function getWebsiteUrl()
{
    return "http://locahost/projects/master-password-manager/";
}

?>