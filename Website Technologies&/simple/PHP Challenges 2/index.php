<?php
// PHP FUNCTION. DONE. TASK 1 
function replaceVowelsWithX($str){
    $vowels = array("a","e","i","o","u","A","E","I","O","U");
    $modified = str_replace($vowels, "x", $str);
    return $modified;
}

echo replaceVowelsWithX("Hello World!") . "<br>" . "<br>"; 

//For Loop. DONE. Task 3
echo "Multiplication table of &number:\n\n" . "<br>";

$number = 5;

for ($i = 0; $i < 11; $i++)
{
    $result = $number * $i;
    echo "$number x $i = $result\n" . "<br>";
}



//Else Statements. DONE. Task 4

$age = 2;

if ($age <= 12){
    echo "You are a child." . "<br>";
} else if ($age <= 17) {
    echo "You are a teenager." . "<br>";
} else if ($age <= 64) {
    echo "You are an adult." . "<br>";
} else {
    echo "You are a senior citizen." . "<br>";
}
?>
