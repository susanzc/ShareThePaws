<html>
<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    table {
        width: 80%;
        border: 1px solid black;
    }

    th {
        font-size: 11pt;
        background: #666;
        color: #FFF;
        padding: 2px 6px;
        border-collapse: separate;
        border: 1px solid #000;
    }

    td {
        font-size: 11pt;
        border: 1px solid #DDD;
        color: black;
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
<h1>Walk Requests</h1>
<?php
include 'connect.php';
$conn = OpenCon();

function generateOwnerTable($result) {
    // approve/ignore option
    // todo: link walk post id to post page
    if ($result->num_rows > 0) {
    echo "
    <table><tr>
    <th class='border-class'>Sent by</th>
    <th class='border-class'>Walk Post ID</th>
    <th class='borderclass'>Message</th>
    <th class='borderclass'></th>
    <th class='borderclass'></th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
     echo "<tr><td class='borderclass'><a href='walker.php?walker=".$row["walkerid"]."'>".$row["walkerid"]."</a></td>
     <td class='borderclass'>".$row["walkid"]."</td>
     <td class='borderclass'>".$row["message"]."</td>
     <td class='borderclass'>
     <form style='margin: 5px' action='viewrequests.php' method='post'>
        <input type='hidden' name='reqid' value='".$row["requestid"]."'>
        <input type='hidden' name='walkid' value='".$row["walkid"]."'>
        <button type='submit' name='approverequest'>Approve</button>
     </form>
     </td>
     <td class='borderclass'>
     <form style='margin: 5px' action='viewrequests.php' method='post'>
        <input type='hidden' name='reqid' value='".$row["requestid"]."'>
        <button type='submit' name='deleterequest'>Delete</button>
     </form></td>
     </tr>";
    }
    echo "</table>";
    } else {
    echo "No requests to show.";
    }
}

function generateWalkerTable($result, $confirmed) {
    // view confirmed requests (can't delete yet!)
    // can delete pending requests
    // todo: link walk post id to post page
    if ($result->num_rows > 0) {
    echo "
    <table><tr>
    <th class='border-class'>Sent by</th>
    <th class='border-class'>Walk Post ID</th>
    <th class='borderclass'>Message</th>
    <th class='borderclass'></th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr><td class='borderclass'><a href='walker.php?walker=".$row["walkerid"]."'>".$row["walkerid"]."</a></td>
    <td class='borderclass'>".$row["walkid"]."</td>
    <td class='borderclass'>".$row["message"]."</td>
    <td class='borderclass'>
    <form style='margin: 5px' action='viewrequests.php' method='post'>
        <input type='hidden' name='reqid' value='".$row["requestid"]."'>
        <button type='submit' hidden='$confirmed' name='deleterequest'>Delete</button>
    </form>
    </td></tr>";
    }
    echo "</table>";
    } else {
    echo "No requests to show.";
    }

}
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";
if (array_key_exists('deleterequest', $_POST)) {
    $reqid = $_POST['reqid'];
    $sql = "delete from walkrequest where requestid = $reqid";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<br><div>Walk request deleted successfully!</div><br>";
        echo "<form action='viewrequests.php'>
        <button type='submit'>View Walk Requests</button>
        </form>";
        echo "<form action='viewposts.php'>
        <button type='submit'>View Walk Posts</button>
        </form>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else if (array_key_exists('approverequest', $_POST)) {
    $reqid = $_POST['reqid']; // to update request
    $walkid = $_POST['walkid']; // to update walk post

    $sql = "update walkrequest set confirmed = 1 where requestid = $reqid";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        $sql = "update walkpost set booked = 1 where referenceid = $walkid";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            // delete all other pending requests for this walk
            $sql = "delete from walkrequest where requestid != $reqid AND walkid = $walkid";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                echo "<br><div>Walk request confirmed for walk post with ID = $walkid !</div><br>";
                echo "<form action='viewrequests.php'>
                <button type='submit'>View Walk Requests</button>
                </form>";
                echo "<form action='viewposts.php'>
                <button type='submit'>View Walk Posts</button>
                </form>";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        // there could be some inconsistencies here if walkrequest was updated but walkpost wasnt
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else {
    if ($usertype == "walker") {
        // confirmed but not completed requests
        $sql = "SELECT walkerid, walkid, requestid, message FROM walkrequest 
        WHERE confirmed = 1 AND walkerid = '$user' AND walkid IN
        (
            SELECT referenceid as walkid
            FROM walkpost
            WHERE completed = 0
        )";
        $result = $conn->query($sql);
        echo "
        <h2>Confirmed Requests:</h2>";
        generateWalkerTable($result, true);
        
        // pending requests
        $sql = "SELECT walkerid, walkid, requestid, message FROM walkrequest 
        WHERE confirmed = 0 AND walkerid = '$user'";
        $result = $conn->query($sql);
        echo "
        <h2>Pending Requests:</h2>";
        generateWalkerTable($result, false);
    }
    else if ($usertype == "owner") {
        // only pending requests for the owner's posts
        $sql = "SELECT wr.walkerid as walkerid, 
        wr.walkid as walkid, wr.requestid as requestid, wr.message as message
        FROM walkrequest wr, walkpost wp
        WHERE wr.walkid = wp.referenceid AND wp.owner = '$user' AND wr.confirmed = 0";
        $result = $conn->query($sql);
        echo "
        <h2>Pending Requests:</h2>";
        generateOwnerTable($result);
    }
}
CloseCon($conn);
?>