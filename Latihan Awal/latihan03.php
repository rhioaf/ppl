<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ppl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM mahasiswa";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "NIM     Nama      Umur <br>";
    while($row = $result->fetch_assoc()) {
        echo $row["nim"] . " " . $row["nama"]. " " .$row["umur"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?> 