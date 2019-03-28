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
<?php
include 'connect.php';
$conn = OpenCon();

function displayDogs($result) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='margin: 10px; background-color: whitesmoke; padding: 10px; border-width: 1px; border-style: solid'>";
        echo "<div><b>Name: </b>".substr($row['name'], 0, 10)."</div>";
        echo "<div><b>Breed: </b>".$row['breed']."</div>";
        echo "<div><b>Age: </b>".$row['age']."</div>";
        echo "<div><b>Gender: </b>".$row['gender']."</div>";
        echo "<div><b>Size: </b>".$row['size']."</div>";
        echo"</div>";
    }
}
$owner = $_GET['owner'];
echo "<h1>Dog Owner: $owner</h1>";
$sql = "SELECT do.userimage as userimage,
do.phonenum as phonenum, onn.name as name
FROM dogowner do, ownernamenum onn
WHERE do.phonenum = onn.phonenum AND
do.username = '$owner'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<div><b>Name: </b>".$row['name']."</div>";
echo "<div><b>Phone Number: </b>".$row['phonenum']."</div>";

$sql = "SELECT d.name as name, d.age as age, d.gender as gender, d.breed as breed,
d.dogimage as dogimage, dt.size as size
FROM dog d, dogtype dt
WHERE d.age = dt.age AND d.breed = dt.breed AND d.owner = '$owner'";

$result = $conn->query($sql);
$numdogs = mysqli_num_rows($result);
echo "<h2>Dogs (".$numdogs.")</h2>";
displayDogs($result);

CloseCon($conn);

?>