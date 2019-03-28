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
if ($user != "") {
    echo "<div style='float: right'>Currently logged in as <b>$user</b></div>";
}
?>
</div>
<center>
<h2>Register as a Dog Owner</h2>
<form action="registerO.php" method="post" enctype="multipart/form-data">
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
 <label>Display Image (optional):</label>
 <input id="image" name="image" type="file" accept="image/*">
 <br>
 <br>
 <label>Phone:</label>
 <input name="phoneNum" type="text" placeholder="Type Here">
 <br>
 <!-- <label>Are u a Walker or Owner</label>
 <select name="walkerorowner">
   <option value="dogwalker">Walker</option>
  <option value="dogowner">Owner</option>
 </select> -->
 <br><br>
 <button type="submit" name="registration" value="Register">Register</button>
</form>
</center>


<?php
include 'connect.php';
$conn = OpenCon();
echo "<center>";
if (array_key_exists('registration', $_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phoneNum = $_POST['phoneNum'];
    //$walkerorowner = $_POST['walkerorowner'];
    if (!$username || !$password || !$phoneNum|| !$name) {
        echo "Please fill out all inputs.";
    }
    else {
    
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
    
      $sql = "insert into ownerNameNum values('$phoneNum','$name')";
      $result = $conn->query($sql);
      if ($result === TRUE) {
        $sql = "insert into dogowner values ('$username', '$password', '$imgname', '$phoneNum')";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "<div>Account with username = $username created successfully!</div><br>";
            echo "<form action='login.php' method='post'>
            <input type='hidden' name='username' value='".$username."'>
            <input type='hidden' name='password' value='".$password."'>
        <button type='submit'>Login</button>
       </form>";
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
echo "</center>";
CloseCon($conn);
?>
