<html>
<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    table {
        border: 1px solid black;
        width: 70%;
    }

    th {
        font-size: 11pt;
        background: #666;
        color: #FFF;
        padding: 2px 6px;
        border-collapse: separate;
        border: 1px solid #000;
    }

    input {
      margin: 15px 5px;
    }

    td {
        font-size: 11pt;
        border: 1px solid #DDD;
        color: black;
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
        font-size: 12px;
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
<body>
<center>
<div class="container">
<div class="main">
<h2>Share The Paws: Dog Collection</h2>
<p style="color: grey; font-style: italic">View information about all the dogs registered in Share the Paws!</p>
<form action="viewdogs.php" method="post">
<label class="heading" style="font-weight: bold;">Select Attributes:</label><br>
<input type="checkbox" name="check_list[]" value="name"><label>Name </label>
<input type="checkbox" name="check_list[]" value="age"><label>Age </label>
<input type="checkbox" name="check_list[]" value="breed"><label>Breed </label>
<input type="checkbox" name="check_list[]" value="dogImage"><label>Image </label>
<input type="checkbox" name="check_list[]" value="owner"><label>Owner </label>
<br>
<button type="submit" name="submit" Value="Submit"/>Submit</button>
</form>
</div>
</div>
</center>
</body>
<center>
<!--- Including PHP Script ----->
<?php
include 'connect.php';
$conn = OpenCon();
// if (array_key_exists('submit',$_POST)) {
//   echo "line 28";
// }
// else {
//   echo "fail line 31";
// }
if(isset($_POST['submit'])){
if(!empty($_POST['check_list'])) {
// Counting number of checked checkboxes.
$checked_count = count($_POST['check_list']);
echo "You have selected following ".$checked_count." option(s): <br/>";
// Loop to store and display values of individual checked checkbox.
foreach($_POST['check_list'] as $selected) {
echo "<div>- ".$selected ."</div>";
}
$sql = "select ".implode(', ',$_POST['check_list'])." from Dog";
//echo "string".$sql."line 57";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // code...
  echo "<br><table><tr>";
  foreach ($_POST['check_list'] as $value) {
    echo "<th class='border-class'>".$value."</th>";
  }
   echo "</tr>";
   // output data of each row
   while($row = $result->fetch_assoc()) {
     echo "<tr>";
     foreach ($_POST['check_list'] as $value) {
       echo "<td class='border-class'>".$row[$value]."</td>";
     }
     echo "</tr>";
   }
   echo "</table>";

} else {
  // code...
  echo "0 results";
}
}
else{
echo "<b>Please select at least one option.</b>";
}
}
CloseCon($conn);
?>
</center>
