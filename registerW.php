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
<a href="viewrequests.php">Walk Requests</a> ---
<a href="viewposts.php">Walk Posts</a>
<?php
session_start();
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";
if ($user != "") {
    echo "<div style='float: right'>Currently logged in as <b>$user</b></div>";
}
?>
</div>
<form action="registerW.php" method="post">
 <br>
 <br>
 <label>Username:</label>
 <input name="username" type="text" placeholder="Type Here">
 <br><br>
 <label>Password:</label>
 <input name="password" type="password" placeholder="Type Here">
 <br><br>
 <label>Full Name:</label>
 <input name="name" type="text" placeholder="Type Here">
 <br>
 <br>
 <label>Image:</label>
 <b>Select a file</b>
 <input name="userImage" type="file" placeholder="Type Here">
 <br><br>
 <label>Phone:</label>
 <input name="phoneNum" type="text" placeholder="Type Here">
 <br><br>
 <label>personalBio:</label>
 <input name="personalBio" type="text" placeholder="Type Here">
 <!-- <label>Are u a Walker or Owner</label>
 <select name="walkerorowner">
   <option value="dogwalker">Walker</option>
  <option value="dogowner">Owner</option>
 </select> -->
 <br>
 <br><br>
 <input type="submit" name="registration" value="Register">
</form>


<?php
include 'connect.php';
$conn = OpenCon();
if (array_key_exists('registration', $_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $personalBio = $_POST['personalBio'];
    $userImage = $_POST['userImage'];
    $phoneNum = $_POST['phoneNum'];
    $name = $_POST['name'];
    //$walkerorowner = $_POST['walkerorowner'];
    if (!$username || !$password || !$phoneNum|| !$personalBio||!$name) {
        echo "Please fill out all inputs.";
    }
    else {
      $sql = "insert into walkerNameNum values('$phoneNum','$name')";
      $result = $conn->query($sql);
      if ($result === TRUE) {
        $sql = "insert into dogwalker values ('$username', '$password', '$userImage', '$phoneNum','$personalBio',0)";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "<div>Account with username = $username created successfully!</div><br>";
            echo "<form action='login.php' method='post'>
            <input type='hidden' name='username' value='".$username."'>
            <input type='hidden' name='password' value='".$password."'>
        <button type='submit'>Login</button></form>";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

      }
      else {
        echo "Error: ". $sql ."<br>".$conn->error;
      }
      // to aviod duplicate username
      // $sql = "select username from '$walkerorowner'"
      // $result = $conn->query($sql);
      // $rows = $result->fetch_assoc();
      // foreach ($rows as $value) {
      //   // code...
      //   if ($value == $username) {
      //     // code...
      //     echo "username already exists, try another one";
      //   }
      // }
      // not sure what to do with the image!!!
        //
        //$user = $_SESSION["user"];

    }
}
CloseCon($conn);
?>
