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
<body>
<center>
<div class="container">
<div class="main">
<h2>Share The Paws: Dog Walkers</h2>
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

// join dogwalkers to walkrequests to walkposts
// total number of dogs
// = numbers of dogs walked by dogwalker

$sql = "SELECT COUNT (DISTINCT dog), username
FROM dogwalker dw
 LEFT JOIN walkrequest wr
 ON username = wr.walkerID
 LEFT JOIN walkpost wp
 ON wr.walkID = wp.referenceID
WHERE comfirmed AND booked AND completed
GROUP BY username
HAVING dog = SELECT COUNT(name, owner) FROM dog";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th class='border-class'>Dog Walker</th>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
     echo "<tr><td class='borderclass'><a href='walker.php?walker=".$row["username"]."'>".$row["username"]."</a></td>";
    }
    echo "</table>";
    } else {
    echo "0 results";
    }
CloseCon($conn);
?>
</center>
