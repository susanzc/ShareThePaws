<div class="menu">
<a href="index.html">Home</a> ---  
<a href="register.html">Register</a> ---
<a href="dogmeetups.php">View Meetups</a> ---
<a href="viewrequests.php">View Walk Requests</a> ---
<a href="viewposts.php">View Walk Posts</a>
</div>
<h1>Dog Meetups</h1>
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
$sql = "SELECT datetime, location, postedby FROM
dogmeetuppost";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table><tr><th class='border-class'>Date/Time</th><th
class='border-class'>Location</th><th class='borderclass'>Posted By</th></tr>";
// output data of each row
while($row = $result->fetch_assoc()) {
 echo "<tr><td class='borderclass'>".$row["datetime"]."</td><td class='borderclass'>".$row["location"]."</td><td class='borderclass'>".$row["postedby"]."</td></tr>";
}
echo "</table>";
} else {
echo "0 results";
}
CloseCon($conn);
?>
