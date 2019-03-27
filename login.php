<div class="menu">
<a href="index.html">Home</a> ---  
<a href="dogmeetups.php">Dog Meetups</a> ---
<a href="viewrequests.php">Walk Requests</a> ---
<a href="viewposts.php">Walk Posts</a>
<?php
session_start();?>
</div>
<?php
include 'connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$conn = OpenCon();
$sql = "select username, password from dogowner where username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pass = $row["password"];
    if ($pass != $password) {
        echo "<h1>Welcome to Share the Paws!</h1>";
        echo "<br><div>Incorrect username/password combination, please try again</div>";
    }
    else {
        $_SESSION["user"] = $username;
        $_SESSION["usertype"] = "owner";
        echo "<h1>Welcome to Share the Paws!</h1>";
        echo "<br><div>Login successful! Welcome, ".$username."</div>";
    }
}
else {
    $sql = "select username, password from dogwalker where username = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pass = $row["password"];
        if ($pass != $password) {
            echo "<h1>Welcome to Share the Paws!</h1>";
            echo "<br><div>Incorrect username/password combination, please try again</div>";
        }
        else {
            $_SESSION["user"] = $username;
            $_SESSION["usertype"] = "walker";
            echo "<h1>Welcome to Share the Paws!</h1>";
            echo "<br><div>Login successful!</div>";
        }
    }
    else {
        echo "<h1>Welcome to Share the Paws!</h1>";
        echo "<br><div>Incorrect username/password combination, please try again</div>";
    }
}
?>