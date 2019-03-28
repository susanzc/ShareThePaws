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

function displayDogs($result) {
    while($row = $result->fetch_assoc()) {
        echo "<div style='display: flex; margin: 10px; width: 500px; border-radius: 1em; background-color: whitesmoke; padding: 10px; border-width: 1px; border-style: solid'>";
        echo "<div style='padding-right: 20px;'><img width='150px' src='uploads/".$row['dogimage']."'></div>";
        echo "<div style='text-align: left'>";
        echo "<div><b>Name: </b>".substr($row['name'], 0, 10)."</div>";
        echo "<div><b>Breed: </b>".$row['breed']."</div>";
        echo "<div><b>Age: </b>".$row['age']."</div>";
        echo "<div><b>Gender: </b>".$row['gender']."</div>";
        echo "<div><b>Size: </b>".$row['size']."</div>";
        echo "</div>";
        echo "</div>";
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

echo "<div style='display: flex; width: 500px'>";
echo "<div style='padding-right: 20px'><img width='200px' src='uploads/".$row['userimage']."'></div>";
echo "<div style='text-align: left'>";
echo "<div><b>Name: </b>".$row['name']."</div>";
echo "<div><b>Phone Number: </b>".$row['phonenum']."</div>";
echo "</div></div>";

if ($owner === $user) {
    // can add dog
    echo "<br><br><form action='owner.php?owner=".$owner."' method='post'>";
    echo "<button type='submit' name='adddog'>+ Add Dog</button>";
    echo "</form>";
}
if (array_key_exists('adddog', $_POST)) {
    $sql = "SELECT distinct breed from dogtype";
    $result = $conn->query($sql);
    echo "<form action='owner.php?owner=".$owner."' method='post' enctype='multipart/form-data'>";
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
    echo "<label>Upload Image (optional): </label><input type='file' accept='image/*' name='image' id='image'><br><br>";
    echo "<input type='submit' name='submitdog' value='Submit'></form>";
}
else if (array_key_exists('submitdog', $_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $breed = $_POST['breed'];
    $gender = $_POST['gender'];

    $target_dir = dirname(getcwd())."/htdocs/uploads/";
    $imgname = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $imgname;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $sql = "INSERT into dog VALUES ('$name', $age, '$gender', '$breed', '$imgname', '$owner')";
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