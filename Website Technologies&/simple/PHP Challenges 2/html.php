<?php
//Calculator. Not Started. Task 2
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = $_POST["num1"];

    $num2 = $_POST["num2"];

    $operator = $_POST["operator"];

    switch ($operator) {

        case "+":
            $result = $num1 + $num2;
            break;
        case "-":
            $result = $num1 - $num2;
            break;
        case "*":
            $result = $num1 * $num2;
            break;
        case "/":
            $result = $num1 / $num2;
            break;
        default:
            $result = "Invalid";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calc</title>
</head>

<body>
    <h2>Simple Calc</h2>

 <form method="POST">
    <label>Enter first number:</label><br>
    <input type="number" step="any" name="num1" required><br><br>

    <label>Enter second number:</label><br>
    <input type="number" step="any" name="num2" required><br><br>

    <label>Select operation:</label><br>
    <select name="operator" required>
        <option value="+">Addition (+)</option>
        <option value="-">Subtraction (-)</option>
        <option value="*">Multiplication (*)</option>
        <option value="/">Division (/)</option>
    </select>
    <br><br>

    <button type="submit">Calculate</button>
</form>

    </form>
</body>
</html>