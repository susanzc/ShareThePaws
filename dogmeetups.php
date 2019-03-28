<div class="menu">
<a href="index.html">Home</a> ---  
<a href="dogmeetups.php">Dog Meetups</a> ---
<a href="viewrequests.php">Walk Requests</a> ---
<a href="viewposts.php">Walk Posts</a> ---
<?php
session_start();
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
if ($user != "") {
    if ($usertype == "walker") {
        echo "<div style='float: right'>Hello, 
        <a href='walker.php?walker=".$user."'><b>$user</b></a></div>";
    }
    else if ($usertype == "owner") {
        echo "<div style='float: right'>Hello, 
        <a href='owner.php?owner=".$user."'><b>$user</b></a></div>";
    }
    else echo "<div style='float: right'>Hello, <b>$user</b></div>";
}
?>
</div>
<h1>Dog Meetups</h1>
<?php
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
if ($usertype == "owner") {
echo "<form action='dogmeetups.php' method='post'>
    <button type='submit' name='createmeetup'>Create Meetup Event</button>
</form>";
}
?>

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
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
if (array_key_exists('submitmeetup', $_POST)) {
    $time = $_POST['time'];
    $locn = $_POST['locn'];
    $datetime = date("Y-m-d H:i:s", strtotime($time));
    // get event id
    $sql = "select max(eventid) as max from dogmeetuppost";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $eventid = $row['max'] + 1;

    $sql = "insert into dogmeetuppost values ($eventid, '$datetime', '$locn', '$user')";
    $result = $conn->query($sql);
    // TODO
    if ($result === TRUE) {
        echo "<div>Event created!</div><br>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


}
if (array_key_exists('createmeetup', $_POST)) {
    echo "<form action='dogmeetups.php' method='post'>
    <label>Time</label>
    <input name='time' type='datetime-local' placeholder='Type Here'>
    <br>
    <label>Location</label>
    <input name='locn' type='text' placeholder='Type Here'>
    <br>
    <br>
    <input type='submit' name='submitmeetup' value='Post Meetup Event'>
   </form>";
}
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
