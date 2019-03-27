
<div class="menu">
<a href="index.html">Home</a> ---  
<a href="register.html">Register</a> ---
<a href="dogmeetups.php">View Meetups</a> ---
<a href="viewrequests.php">View Walk Requests</a> ---
<a href="viewposts.php">View Walk Posts</a>
</div>
<h1>Walk Posts</h1>
<?php
session_start();
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
if ($usertype === "owner") {
    echo "<form action='addwalk.php'>
    <button type='submit' style='padding: 15px 20px; font-size: 18px'>+ Add Walk</button>
    </form>";
}
?>
<br>
<html>
<style>
    table {
        border: 1px solid black;
    }

    button {
        background-color: #4CAF50;
        border:0.16em solid #666;
        border-radius:2em;
        color: white;
        padding: 10px 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 4px 2px;
        cursor: pointer;
    }

    th {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11pt;
        background: #666;
        color: #FFF;
        padding: 2px 6px;
        border-collapse: separate;
        border: 1px solid #000;
    }

    td {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11pt;
        border: 1px solid #DDD;
        color: black;
    }
</style>
</html>

<?php

include 'connect.php';
$conn = OpenCon();
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";

function generateTable($result) {
    $usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
    if ($result->num_rows > 0) {
        echo "<table><tr>
        <th class='border-class'>Walk Post ID</th>
        <th class='border-class'>Description</th>";
    if ($usertype === "owner") {
        echo "<th class='borderclass'></th>
        <th class='borderclass'></th>
        </tr>";
    }
    else if ($usertype === "walker") {
        echo "<th class='borderclass'></th>
        </tr>";
    }
    else {
        echo "</tr>";
    }
    // output data of each row
    while($row = $result->fetch_assoc()) {
     echo "<tr>
     <td class='borderclass'>".$row["referenceid"]."</td>
     <td class='borderclass'>
     <div style='padding: 2pt'><b>Posted By: </b>".$row["owner"]."</div>
     <div style='padding: 2pt'><b>Dog Name: </b>".$row["dog"]."</div>
     <div style='padding: 2pt'><b>Start Time: </b>".$row["starttime"]."</div>
     <div style='padding: 2pt'><b>Start Location: </b>".$row["startlocn"]."</div>
     <div style='padding: 2pt'><b>End Time: </b>".$row["endtime"]."</div>
     <div style='padding: 2pt'><b>End Location: </b>".$row["endlocn"]."</div>
     <div style='padding: 2pt'><b>Special Requests: </b>".$row["specialrequests"]."</div>
     </td>";
     if ($usertype === "owner") {
     echo "
        
        <td class='borderclass'>
        <form action='viewposts.php' method='post'>
        <input type='hidden' name='refid' value='".$row["referenceid"]."'>
        <button type='submit' name='markcomplete' style='background-color: #4CAF50'>Mark as Complete</button>
        </form>
        </td>
    
        <td class='borderclass'>
        <form action='viewposts.php' method='post'>
        <input type='hidden' name='refid' value='".$row["referenceid"]."'>
        <button type='submit' name='deletepost' style='background-color: #F00'>Remove Post</button>
        </form></td>
        </tr>";
     }
     else if ($usertype === "walker") {
        echo "<td class='borderclass'><button type='button'>Request to Walk</button></td>
        </tr>";
     }
     else {
         echo "</tr>";
     }
    }
    echo "</table>";
    } else {
    echo "No results to show.<br><br>";
    }
}

if ($usertype === "owner") {
    // show only results associated with user
    echo "<h2>Booked Walks:</h2>";
    // todo - join with walkrequest and show walker that booked the walk
    $sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn, specialrequests, booked, completed 
    FROM walkpost WHERE booked = 1 AND completed = 0 AND owner = '$user'";
    $resultbooked = $conn->query($sql);
    generateTable($resultbooked);

    echo "<h2>Unbooked Walks:</h2>";
    $sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn, specialrequests, booked, completed 
    FROM walkpost WHERE booked = 0 AND completed = 0 AND owner = '$user'";
    $resultunbooked = $conn->query($sql);
    generateTable($resultunbooked);

    
}
else {
    // show all results
    $sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn, specialrequests, booked, completed 
    FROM walkpost WHERE booked = 0 AND completed = 0";
    $result = $conn->query($sql);
    generateTable($result);
}

if (array_key_exists('deletepost', $_POST)) {
    $refID = (int)$_POST['refid'];
    $sql = "delete from walkpost where referenceid = $refID";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<br><div>Walk post with ID = $refID deleted successfully!</div><br>";
        echo "<form action='viewposts.php'>
        <button type='submit'>Refresh Page</button>
       </form>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else if (array_key_exists('markcomplete', $_POST)) {
    $refID = (int)$_POST['refid'];
    $sql = "update walkpost set completed = 1 where referenceid = $refID";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<br><div>Walk post with ID = $refID marked as complete!</div><br>";
        echo "<form action='viewposts.php'>
        <button type='submit'>Refresh Page</button>
       </form>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
CloseCon($conn);
?>
