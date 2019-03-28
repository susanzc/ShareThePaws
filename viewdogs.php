
<head>
  <div class="menu">
  <a href="index.html">Home</a> ---
  <a href="viewdogs.php">Dogs</a> ---
  <a href="dogmeetups.php">Dog Meetups</a> ---
  <a href="viewrequests.php">Walk Requests</a> ---
  <a href="viewposts.php">Walk Posts</a>
  <?php
  session_start();
  $user = isset($_SESSION["user"])? $_SESSION["user"] : "";
  if ($user != "") {
      echo "<div style='float: right'>Hello, <b>$user</b></div>";
  }
  ?>
  </div>
<title>All Dogs</title>

</head>
<body>
<div class="container">
<div class="main">
<h2>Select Elements:</h2>
<form action="viewdogs.php" method="post">
<label class="heading">Select Elements::</label>
<input type="checkbox" name="check_list[]" value="name"><label>Name</label>
<input type="checkbox" name="check_list[]" value="age"><label>Age</label>
<input type="checkbox" name="check_list[]" value="breed"><label>Breed</label>
<input type="checkbox" name="check_list[]" value="dogImage"><label>Image</label>
<input type="checkbox" name="check_list[]" value="owner"><label>Owner</label>
<input type="submit" name="submit" Value="Submit"/>
</form>
</div>
</div>
</body>
<html>
<style>
    table {
        width: 80%;
        border: 1px solid black;
    }

    th {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11pt;
        background: #666;
        color: #FFF;
        padding: 2px 6px;
        border-collapse: separate;
        border: 1px solid #000;
    }

    td {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11pt;
        border: 1px solid #DDD;
        color: black;
    }
</style>
</html>

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
echo "<p>".$selected ."</p>";
}
$sql = "select ".implode(', ',$_POST['check_list'])." from Dog";
echo "string".$sql."line 57";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // code...
  echo "<table><tr>";
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
echo "<b>Please Select Atleast One Option.</b>";
}
}
CloseCon($conn);
?>
