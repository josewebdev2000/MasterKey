<?php 
/** PHP Reusable code of no specify category */
function is_valid_id_param($id_param)
{
    // Return true if the given id parameter is valid
    return isset($id_param) && is_numeric($id_param);
}
?>