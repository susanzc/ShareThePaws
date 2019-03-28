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
<a href="viewdogs.php">Dog Collection</a> ---
<a href="viewrequests.php">Walk Requests</a> ---
<a href="viewposts.php">Walk Posts</a>
<?php
session_start();?>
</div>
<center>
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
        echo "<br><div>Incorrect username/password combination, <a href='index.html'>please try again</a>.</div>";
    }
    else {
        $_SESSION["user"] = $username;
        $_SESSION["usertype"] = "owner";
        echo "<h1>Welcome to Share the Paws!</h1>";
        echo "<br><div>Login successful! Welcome, <a href='owner.php?owner=".$username."'>".$username."</a></div>";
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
            echo "<br><div>Incorrect username/password combination, <a href='index.html'>please try again</a>.</div>";
        }
        else {
            $_SESSION["user"] = $username;
            $_SESSION["usertype"] = "walker";
            echo "<h1>Welcome to Share the Paws!</h1>";
            echo "<br><div>Login successful! Welcome, <a href='walker.php?walker=".$username."'>".$username."</a></div>";
        }
    }
    else {
        echo "<h1>Welcome to Share the Paws!</h1>";
        echo "<br><div>Incorrect username/password combination, <a href='index.html'>please try again</a>.</div>";
    }
}
?>
</center>