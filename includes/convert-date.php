<?php
function convert ($date){
    $dateString = $date;

// Create a DateTime object from the date string
$date = new DateTime($dateString);

// Custom function to get the ordinal suffix for a day
function getOrdinalSuffix($day) {
    if (!in_array(($day % 100), [11, 12, 13])) {
        switch ($day % 10) {
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

// Format the day with the ordinal suffix
$day = $date->format('j');
$ordinalSuffix = getOrdinalSuffix($day);
$dayWithSuffix = $day . $ordinalSuffix;

// Format the rest of the date
$formattedDate = $dayWithSuffix . ' ' . $date->format('F Y, H:i');

return $formattedDate;
}
?>