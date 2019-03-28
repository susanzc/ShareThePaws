<html>
<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
</style>
</html>
<div class="menu">
<a href="index.html">Home</a> ---  
<a href="dogmeetups.php">Dog Meetups</a> ---
<a href="collections.php">Collections</a> ---
<a href="viewrequests.php">Walk Requests</a> ---
<a href="viewposts.php">Walk Posts</a>
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
<?php
include 'connect.php';
$conn = OpenCon();

function displayReviews($result) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='margin: 10px; width: 500px; border-radius: 1em; background-color: whitesmoke; padding: 10px; border-width: 1px; border-style: solid'>";
        echo "<div><b>Date: </b>".substr($row['date'], 0, 10)."</div>";
        echo "<div><b>Written By: </b><a href='owner.php?owner=".$row['writtenby']."'>".$row['writtenby']."</a></div>";
        echo "<div><b>Rating: </b>".$row['rating']."/5</div>";
        echo "<div><b>Comments: </b>".$row['comment']."</div>";
        echo"</div>";
    }
}
$walker = $_GET['walker'];
echo "<center>";
echo "<h1>Dog Walker: $walker</h1>";
$sql = "SELECT dw.userimage as userimage, dw.personalbio as personalbio,
dw.walkscompleted as walkscompleted, wnn.phonenum as phonenum, wnn.name as name
FROM dogwalker dw, walkernamenum wnn
WHERE dw.phonenum = wnn.phonenum AND
dw.username = '$walker'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<div style='display: flex; width: 500px'>";
echo "<div style='padding-right: 20px'><img width='200px' src='uploads/".$row['userimage']."'></div>";
echo "<div style='text-align: left'>";
echo "<div><b>Name: </b>".$row['name']."</div>";
echo "<div><b>Phone Number: </b>".$row['phonenum']."</div>";
echo "<div><b>Personal Bio: </b>".$row['personalbio']."</div>";
echo "<br>";
echo "<div><b>Walks Completed: </b>".$row['walkscompleted']."</div>";

$sql = "SELECT avg(rating) as average 
FROM review 
WHERE writtenfor = '$walker'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<div><b>Average Rating: </b>".number_format($row['average'], 2)."</div>";
echo "</div></div>";

$sql = "SELECT writtenby, reviewid, rating, date, comment
FROM review
WHERE writtenfor = '$walker'
ORDER BY date desc";

$result = $conn->query($sql);
$numreviews = mysqli_num_rows($result);
echo "<h2>Reviews (".$numreviews.")</h2>";
displayReviews($result);
echo "</center>";
CloseCon($conn);

?>