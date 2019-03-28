<html>
<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    button {
        background-color: #4CAF50;
        /* border:0.16em solid #666; */
        border-radius:2em;
        color: white;
        padding: 10px 15px;
        /* text-align: center;
        text-decoration: none;
        display: inline-block; */
        font-size: 14px;
        cursor: pointer; 
    }
</style>
</html>
<div class="menu">
<a href="index.html">Home</a> ---  
<a href="dogmeetups.php">Dog Meetups</a> ---
<a href="viewdogs.php">Dog Collection</a> ---
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
        echo "<div style='margin: 10px; width: 500px; border-radius: 1em; background-color: whitesmoke; padding: 10px; border-width: 1px; border-style: solid'>";
        echo "<div><b>Name: </b>".substr($row['name'], 0, 10)."</div>";
        echo "<div><b>Breed: </b>".$row['breed']."</div>";
        echo "<div><b>Age: </b>".$row['age']."</div>";
        echo "<div><b>Gender: </b>".$row['gender']."</div>";
        echo "<div><b>Size: </b>".$row['size']."</div>";
        echo"</div>";
    }
}
$owner = $_GET['owner'];
echo "<center>";
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

if ($owner === $user) {
    // can add dog
    echo "<br><br><form action='owner.php?owner=".$owner."' method='post'>";
    echo "<button type='submit' name='adddog'>+ Add Dog</button>";
    echo "</form>";
}
if (array_key_exists('adddog', $_POST)) {
    $sql = "SELECT distinct breed from dogtype";
    $result = $conn->query($sql);
    echo "<form action='owner.php?owner=".$owner."' method='post'>";
    echo "<label>Dog Name: </label><input type='text' name='name'><br><br>";
    echo "<label>Age: </label><input type='number' name='age'><br><br>";

    echo "<label>Breed: </label><select name='breed'>";

    while ($row = $result->fetch_assoc()){
        echo "<option value=\"".$row['breed']."\">" . $row['breed'] . "</option>";
    }
    echo "</select><br><br>";
    echo "<label>Gender: </label><select name='gender'>
    <option value=\"M\">M</option>
    <option value=\"F\">F</option>
    </select><br><br>";
    echo "<label>Upload Image (optional): </label><input type='file' name='image'><br><br>";
    echo "<input type='submit' name='submitdog' value='Submit'></form>";
}
else if (array_key_exists('submitdog', $_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];
    $image = $_POST['image'];

    $sql = "INSERT into dog VALUES ('$name', $age, '$gender', '$breed', '$image', '$owner')";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<br><div>Dog added successfully!</div><br>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT d.name as name, d.age as age, d.gender as gender, d.breed as breed,
d.dogimage as dogimage, dt.size as size
FROM dog d, dogtype dt
WHERE d.age = dt.age AND d.breed = dt.breed AND d.owner = '$owner'";

$result = $conn->query($sql);
$numdogs = mysqli_num_rows($result);
echo "<h2>Dogs (".$numdogs.")</h2>";
displayDogs($result);
echo "</center>";
CloseCon($conn);

?>