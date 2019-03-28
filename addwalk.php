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
            padding: 5px 10px;
            /* text-align: center;
            text-decoration: none;
            display: inline-block; */
            font-size: 14px;
            cursor: pointer; 
        }
    input {
        margin: 5px;
    }
</style>
</html>
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
<center>
<h1>Add a Walk</h1>
<form action="addwalk.php" method="post">
 <label>Dog Name:</label>
 <select name="dog">
 <?php 
    include 'connect.php';
    $conn = OpenCon();
    $user = isset($_SESSION["user"])? $_SESSION["user"] : "";
    $sql = "SELECT name FROM dog where owner = '$user'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
        echo "<option value=\"".$row['name']."\">" . $row['name'] . "</option>";
    }
    CloseCon($conn);
?>
</select>
 <br>
 <br>
 <b>Start:</b>
 <br>
 <label>Time</label>
 <input name="stime" type="datetime-local" placeholder="Type Here">
 <br>
 <label>Location</label>
 <input name="slocn" type="text" placeholder="Type Here">
 <br>
 <br>
 <b>End:</b>
 <br>
 <label>Time</label>
 <input name="etime" type="datetime-local" placeholder="Type Here">
 <br>
 <label>Location</label>
 <input name="elocn" type="text" placeholder="Type Here">
 <br>
 <br>
 <label>Special Requests:</label><br>
 <textarea class="text" cols="70" rows ="5" name="requests"></textarea>
 <br><br>
 <button type="submit" name="submitpost" value="Submit Post">Submit Post</button>
</form>

<?php
$conn = OpenCon();
if (array_key_exists('submitpost', $_POST)) {
    $dog = $_POST['dog'];
    $stime = $_POST['stime'];
    $slocn = $_POST['slocn'];
    $etime = $_POST['etime'];
    $elocn = $_POST['elocn'];
    $requests = $_POST['requests'];
    if (!$dog || !$stime || !$slocn || !$etime || !$elocn) {
        echo "Please fill out all inputs.";
    }
    else {
        $sdatetime = date("Y-m-d H:i:s", strtotime($stime));
        $edatetime = date("Y-m-d H:i:s", strtotime($etime));
        $user = $_SESSION["user"];
        //echo "info:".$dog.$sdatetime.$slocn.$edatetime.$elocn.$requests."";
        // generate ref id
        $sql = "select max(referenceID) as max from walkpost";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $refID = $row['max'] + 1;
        //echo "refid:".$refID."";
        // insert

        //$user = $_SESSION["user"];
        $sql = "insert into walkpost values ('$user', '$dog', $refID, '$slocn', '$elocn', '$sdatetime', '$edatetime', 'F', 'F', '$requests')";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "<div>Walk post with ID = $refID posted successfully!</div><br>";
            echo "<form action='viewposts.php'>
        <button type='submit'>View Posts</button>
       </form>";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
CloseCon($conn);
?>
</center>