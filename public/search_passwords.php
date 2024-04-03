<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');

$user_id = $_GET['user_id'];
$search_query = $_GET['query'];
$search_query = '%' . $search_query . '%'; 

$sql = "SELECT * FROM passwords WHERE application_name LIKE ? AND user_id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $search_query, $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['application_name'] . "</p>";
    }
} else {
    echo "<p>No results found.</p>";
}

$stmt->close();
$conn->close();

?>