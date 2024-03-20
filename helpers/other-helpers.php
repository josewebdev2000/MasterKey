<?php 
/** PHP Reusable code of no specify category */
function is_valid_id_param($id_param)
{
    // Return true if the given id parameter is valid
    return isset($id_param) && is_numeric($id_param);
}

function has_exact_keys($assoc_arr, $expected_keys)
{
    // Return true if the assoc array has the expected arrays
    // Get the keys of the array
    $array_keys = array_keys($assoc_arr);

    // Sort both arrays to ensure order doesn't matter
    sort($array_keys);
    sort($expected_keys);

    // Compare the sorted arrays
    return $array_keys === $expected_keys;
}
?>