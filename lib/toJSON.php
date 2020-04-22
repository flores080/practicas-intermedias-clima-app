<?php
function getJSON(mysqli_result $queryResult)
{
    $myArray = array();
    while ($row = $queryResult->fetch_array(MYSQLI_ASSOC))
        $myArray[] = $row;
    return json_encode($myArray);
}

function getArray($queryResult){
    $myArray = array();
    while ($row = $queryResult->fetch_array(MYSQLI_ASSOC))
        $myArray[] = $row;
    return $myArray;
}