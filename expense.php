<?php
$tp = $_POST['type'];
$q = $_POST['qty'];
$n = $_POST['note'];
$d = $_POST['date'];

$amt = 0;
if ($tp == "tea") {
    $amt = $q * 10;
} else if ($tp == "coffee") {
    $amt = $q * 15;
} else {
    $amt = $q * 25;
}

echo "type is: " . $tp . "<br>";
echo "quantity is: " . $q . "<br>";
echo "total: " . $amt . "<br>";
echo "note is: " . $n . "<br>";
echo "date is: " . $d . "<br>";

$conn = new mysqli('localhost', 'root', '', 'expense');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO exp(type, quantity, note, dt) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("siss", $tp, $q, $n, $d);
    
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    
}
?>
