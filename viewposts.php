<div class="menu">
<a href="index.html">Home</a> ---  
<a href="register.html">Register</a> ---
<a href="dogmeetups.php">View Meetups</a> ---
<a href="viewrequests.php">View Walk Requests</a> ---
<a href="viewposts.php">View Walk Posts</a>
</div>
<h1>Walk Posts</h1>
<html>
<style>
    table {
        width: 80%;
        border: 1px solid black;
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
$sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn FROM walkpost WHERE booked = 'F' AND completed = 'F'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table><tr>
<th class='border-class'>Walk Post ID</th>
<th class='border-class'>Posted By</th>
<th class='border-class'>Dog name</th>
<th class='borderclass'>Start time</th>
<th class='borderclass'>Start location</th>
<th class='borderclass'>End time</th>
<th class='borderclass'>End location</th>
<th class='borderclass'></th>
</tr>";
// output data of each row
while($row = $result->fetch_assoc()) {
 echo "<tr>
 <td class='borderclass'>".$row["referenceid"]."</td>
 <td class='borderclass'>".$row["owner"]."</td>
 <td class='borderclass'>".$row["dog"]."</td>
 <td class='borderclass'>".$row["starttime"]."</td>
 <td class='borderclass'>".$row["startlocn"]."</td>
 <td class='borderclass'>".$row["endtime"]."</td>
 <td class='borderclass'>".$row["endlocn"]."</td>
 <td class='borderclass'><button type='button'>Request to Walk</button></td>
 </tr>";
}
echo "</table>";
} else {
echo "0 results";
}
CloseCon($conn);
?>
