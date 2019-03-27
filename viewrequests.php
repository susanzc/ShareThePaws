<div class="menu">
<a href="index.html">Home</a> ---  
<a href="register.html">Register</a> ---
<a href="dogmeetups.php">View Meetups</a> ---
<a href="viewrequests.php">View Walk Requests</a> ---
<a href="viewposts.php">View Walk Posts</a>
</div>
<h1>Walk Requests</h1>
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
$sql = "SELECT walkerid, walkid, message FROM walkrequest WHERE confirmed = 1";
$result = $conn->query($sql);
echo "
<b>Confirmed Requests:</b><br>";
if ($result->num_rows > 0) {
echo "
<table><tr>
<th class='border-class'>Sent by</th>
<th class='border-class'>Walk Post ID</th>
<th class='borderclass'>Message</th>
<th class='borderclass'></th>
</tr>";
// output data of each row
while($row = $result->fetch_assoc()) {
 echo "<tr><td class='borderclass'>".$row["walkerid"]."</td>
 <td class='borderclass'>".$row["walkid"]."</td>
 <td class='borderclass'>".$row["message"]."</td>
 <td class='borderclass'><button type='button'>Cancel</button></td></tr>";
}
echo "</table>";
} else {
echo "No confirmed requests to show.";
}
$sql = "SELECT walkerid, walkid, message FROM walkrequest WHERE confirmed = 0";
$result = $conn->query($sql);
echo "
<br><br><b>Pending Requests:</b><br>";
if ($result->num_rows > 0) {
echo "
<table><tr>
<th class='border-class'>Sent by</th>
<th class='border-class'>Walk Post ID</th>
<th class='borderclass'>Message</th>
<th class='borderclass'></th>
<th class='borderclass'></th>
</tr>";
// output data of each row
while($row = $result->fetch_assoc()) {
 echo "<tr><td class='borderclass'>".$row["walkerid"]."</td>
 <td class='borderclass'>".$row["walkid"]."</td>
 <td class='borderclass'>".$row["message"]."</td>
 <td class='borderclass'><button type='button'>Approve</button></td>
 <td class='borderclass'><button type='button'>Ignore</button></td>
 </tr>";
}
echo "</table>";
} else {
echo "No pending requests to show.";
}
CloseCon($conn);
?>