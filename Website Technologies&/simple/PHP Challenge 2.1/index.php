<?php
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
            $result = "Invalid operator selected.";
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple PHP Calculator</title>
</head>
<body>

<h2>Simple Calculator</h2>

<form method="POST">
    <label>Enter first number:</label><br>
    <input type="number" name="num1" required><br><br>

    <label>Enter second number:</label><br>
    <input type="number" name="num2" required><br><br>

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

<?php if ($result !== ""): ?>
    <h3>Result: <?php echo $result; ?></h3>
<?php endif; ?>

</body>
</html>
