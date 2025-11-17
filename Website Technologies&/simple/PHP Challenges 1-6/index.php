<?php 
// Task 1 DONE - Strings, Variables and Math.
$width = 10;
$height = 5;
$area = $width * $height;

print "The rectangle has a width of " . $width . " meters, a height of " . $height . " meters, and an area of " . $area . " square meters.  <br><br>";

// Task 2 DONE Strings, numbers and math.
$number1 = 10;
$number2 = 5;

print "Addition of $number1 and $number2 is: " . ($number1 + $number2) . "<br>";
print "Subtraction of $number1 and $number2 is: " . ($number1 - $number2) . "<br>";
print "Multiplication of $number1 and $number2 is: " . ($number1 * $number2) . "<br>";
print "Division of $number1 and $number2 is: " . ($number1 / $number2) . "<br>";
print "Concatenation of $number1 and $number2 is: " . $number1  . $number2 . "<br>";


// Task 3 DONE. Age Calc.
print "<h2>Age Calculator</h2>";
// variables
$myAge = 26;
$daysNoLeap = 365;
$hoursInDay = 24;
$secondsInHour = 3600;

//variables with equations.

$daysAlive = $myAge * $daysNoLeap;
$hoursAlive = $daysAlive * $hoursInDay;
$secondsAlive = $hoursAlive * $secondsInHour; 



print "<p>You have been alive for</p>";

print "" . $daysAlive . " days!" . "<br>";
print "" . $hoursAlive . " hours!" . "<br>";
print "" . $secondsAlive . " minutes!" . "<br>";






//Task 4 DONE Numeric Arrays
echo "<p>The Week</p>";
$week = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');

//this displays the array as a bulleted list.
echo "<ul>";
foreach($week as $value)
{print "<li>$value</li>" ;
}
echo "</ul>";

//Task 5 Associative Arrays. DONE
print "<p>The average Temperature in Edinburgh</p>";

$temp = array(
    "July" => 19,
    "Aug"  => 11,
    "Jan"  => 7,
    "Feb"  => 1
);

$date = array(
    "July-Aug" => array("July", "Aug"),
    "Jan-Feb"  => array("Jan", "Feb")
);

print "<table border='1' cellpadding='5' cellspacing='0'>";
print "<tr>
        <th>Month</th>
        <th>High (℃)</th>
        <th>Low (℃)</th>
      </tr>";

foreach($date as $monthName => $months) {
    $tempsInPeriod = array();
    foreach($months as $month) {
        $tempsInPeriod[] = $temp[$month];
    }
    $high = max($tempsInPeriod);
    $low = min($tempsInPeriod);

    echo "<tr>
            <td>$monthName</td>
            <td>$high</td>
            <td>$low</td>
          </tr>";
}

print "</table>";

//task 6 DONE - MULTIDIMENSIONAL ARRAYS
$finalGrades = array(
    "Aarron" => array (
        "Physics" => "74%",
        "English" => "69%",
        "Maths" => "70%"
    ),

    "Jamie" => array (
        "Physics" => "64%",
        "English" => "79%",
        "Maths" => "69%"
    ),

    "Harry" => array (
        "Physics" => "55%",
        "English" => "52%",
        "Maths" => "57%"
    )
);

print "<p>Student Results</p>";
print "Physics result for Aarron : " . ($finalGrades["Aarron"]["Physics"]) . "<br>";
print "Enlgish result for Jamie : " . ($finalGrades["Jamie"]["English"]) . "<br>";
print "Maths result for Harry : " . ($finalGrades["Harry"]["Maths"]) . "<br>";



?>

