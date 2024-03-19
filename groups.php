<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $groupName = $_POST["group_Name"];
        $leaderId = $_POST["leader_Id"];

    $groupName = htmlspecialchars(trim($groupName));
    $leaderId = htmlspecialchars(trim($leaderId));
 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "auth";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM groups WHERE group_name = '$groupName' AND leader_id = '$leaderId'";
    $result = $conn->query($sql);
    
 
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Group Name</th><th>Leader ID</th><th>Meeting Day</th><th>Meeting Time</th><th>Location</th><th>Description</th></tr>";
     
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["group_name"]. "</td>";
            echo "<td>" . $row["leader_id"]. "</td>";
            echo "<td>" . $row["meeting_day"]. "</td>";
            echo "<td>" . $row["meeting_time"]. "</td>";
            echo "<td>" . $row["location"]. "</td>";
            echo "<td>" . $row["description"]. "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No group details found for the provided group name and leader ID.";
    }

    $conn->close();
}
?>
