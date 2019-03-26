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
