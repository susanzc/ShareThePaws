<div class="menu">
<a href="index.html">Home</a> ---
<a href="dogmeetups.php">Dog Meetups</a> ---
<a href="viewrequests.php">Walk Requests</a> ---
<a href="viewposts.php">Walk Posts</a>
<?php
session_start();
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";
if ($user != "") {
    echo "<div style='float: right'>You Already Have an Account <b>$user</b></div>";
} else {
  echo "<div style='float: right'>Welcome!</div>";
}
?>
</div>

<form action="register.php" method="post">
 <br>
 <br>
 <label>Username:</label>
 <br>
 <input name="username" type="text" placeholder="Type Here">
 <br>
 <label>Password:</label>
 <input name="password" type="password" placeholder="Type Here">
 <br>
 <br>
 <label>Image:</label>
 <b>Select a file</b>
 <input name="userImage" type="file" placeholder="Type Here">
 <br>
 <label>Phone:</label>
 <input name="phoneNum" type="text" placeholder="Type Here">
 <br>
 <label>Are u a Walker or Owner</label>
 <select name="walkerorowner">
   <option value="dogwalker">Walker</option>
  <option value="dogowner">Owner</option>
 </select>
 <br>
 <br><br>
 <input type="submit" name="registration" value="Register">
</form>


<?php
$conn = OpenCon();
if (array_key_exists('registration', $_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userImage = $_POST['userImage'];
    $phoneNum = $_POST['phoneNum'];
    $walkerorowner = $_POST['walkerorowner'];
    if (!$username || !$password || !$userImage || !$phoneNum || !$wal) {
        echo "Please fill out all inputs.";
    }
    else {
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
        $sql = "insert into $walkerorowner values ('$usename', '$password', $userImage, '$phoneNum')";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "<div>Account with username = $username created successfully!</div><br>";
            echo "<form action='viewaccount.php'>
        <button type='submit'>View Account</button>
       </form>";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
CloseCon($conn);
?>
