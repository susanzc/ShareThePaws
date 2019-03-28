<html>
<style>
    * {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }
    table {
        border: 1px solid black;
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
<center>
<h1>Walk Posts</h1>

<?php

include 'connect.php';
$conn = OpenCon();
$usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";

function generateTable($result, $booked) {
    $usertype = isset($_SESSION["usertype"])? $_SESSION["usertype"] : "";
    if ($result->num_rows > 0) {
        echo "<table><tr>
        <th class='border-class'>Walk Post ID</th>
        <th class='border-class'>Description</th>";
        if ($usertype === "owner" && !$booked) {
            // extra column for update
            echo "<th class='borderclass'></th>";
        }
        else if ($usertype === "owner" && $booked) {
            // extra column for walker username
            echo "<th class='borderclass'>Walker</th>";

        }
        echo "<th class='borderclass'></th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td class='borderclass'>".$row["referenceid"]."</td>
        <td class='borderclass'>
        <div style='padding: 2pt'><b>Posted By: </b><a href='owner.php?owner=".$row['owner']."'>".$row["owner"]."</a></div>
        <div style='padding: 2pt'><b>Dog Name: </b>".$row["dog"]."</div>
        <div style='padding: 2pt'><b>Start Time: </b>".$row["starttime"]."</div>
        <div style='padding: 2pt'><b>Start Location: </b>".$row["startlocn"]."</div>
        <div style='padding: 2pt'><b>End Time: </b>".$row["endtime"]."</div>
        <div style='padding: 2pt'><b>End Location: </b>".$row["endlocn"]."</div>
        <div style='padding: 2pt'><b>Special Requests: </b>".$row["specialrequests"]."</div>
        </td>";
        if ($usertype === "owner") {
            if ($booked) {
            echo "
            <td class='borderclass'>
            <a href='walker.php?walker=".$row['walkerid']."'>".$row['walkerid']."</a>
            </td>
            <td class='borderclass'>
            <form action='viewposts.php' method='post'>
            <input type='hidden' name='refid' value='".$row["referenceid"]."'>
            <button style='width: 80px' type='submit' name='markcomplete' style='background-color: #4CAF50'>Mark as Complete</button>
            </form>
            </td>";
            }
            else {
                echo "
            <td class='borderclass'>
            <form action='viewposts.php' method='post'>
            <input type='hidden' name='refid' value='".$row["referenceid"]."'>
            <button type='submit' name='editpost' style='width: 80px;'>Edit</button>
            </form></td>";
                echo "
            <td class='borderclass'>
            <form action='viewposts.php' method='post'>
            <input type='hidden' name='refid' value='".$row["referenceid"]."'>
            <button type='submit' name='deletepost' style='width: 80px; background-color: #F00'>Delete</button>
            </form></td>";
            }
            echo "</tr>";
        }
        else if ($usertype === "walker" && !$booked) {
            echo "<td class='borderclass'>
            <form action='viewposts.php' method='post'>
            <input type='hidden' name='walkid' value='".$row["referenceid"]."'>
            <button style='width: 80px' type='submit' name='requestwalk'>Request to Walk</button>
            </form></td>
            </tr>";
        }
        else {
            echo "</tr>";
        }
        }
        echo "</table>";
    } else {
    echo "No results to show.<br><br>";
    }
}

if (array_key_exists('requestwalk', $_POST)) {
    // walk request message display
    $walkid = $_POST['walkid'];

    echo "<h2>Sending Walk Request for Walk ID = $walkid :</h2>";
    echo "<div> Message to the owner: </div>";
    echo "<form action='viewposts.php' method='post'>
    <input type='hidden' name='walkid' value='".$walkid."'>
    <textarea class='text' placeholder='Eg. Hi! I am very interested in walking your dog :)' cols='70' rows ='5' name='message'></textarea>
    <br><br>
    <button type='submit' name='submitrequest' value='Submit Request'>Submit Request</button>
   </form>";

}
else if (array_key_exists('submitrequest', $_POST)) {
    // request sent display
    $walkid = $_POST['walkid'];
    $message = $_POST['message'];

    // generate new requestid
    $sql = "select max(requestid) as max from walkrequest";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $reqid = $row['max'] + 1;
    $sql = "insert into walkrequest values ('$user', '$walkid', $reqid, '$message', 'F')";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<div>Walk request successfully sent!</div><br>";
        echo "<form action='viewposts.php'>
        <button type='submit'>View Walk Posts</button>
        </form>";
        echo "<form action='viewrequests.php'>
        <button type='submit'>View Walk Requests</button>
        </form>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
else if (array_key_exists('deletepost', $_POST)) {
    $refID = (int)$_POST['refid'];
    $sql = "delete from walkpost where referenceid = $refID";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<br><div>Walk post with ID = $refID deleted successfully!</div><br>";
        echo "<form action='viewposts.php'>
        <button type='submit'>View Walk Posts</button>
    </form>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else if (array_key_exists('editpost', $_POST)) {
    // return UI for edit
    $refid = $_POST['refid'];
    $sql = "SELECT dog, startlocn, endlocn, starttime, endtime, specialrequests
    FROM walkpost WHERE referenceid = $refid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stime = strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['starttime']));
    $etime = strftime('%Y-%m-%dT%H:%M:%S', strtotime($row['endtime']));

    // load current info - can change start/end locn and time and special requests only

    echo "<h2>Edit Walk Post ID = $refid</h2>";
    echo "<div><b>Dog Name: </b>".$row['dog']."</div>";
    echo "<form action='viewposts.php' method='post'>
    <b>Start:</b>
    <br>
    <label>Time</label>
    <input name='stime' type='datetime-local' value='".$stime."'>
    <br>
    <label>Location</label>
    <input name='slocn' type='text' value='".$row['startlocn']."'>
    <br>
    <br>
    <b>End:</b>
    <br>
    <label>Time</label>
    <input name='etime' type='datetime-local' value='".$etime."'>
    <br>
    <label>Location</label>
    <input name='elocn' type='text' value='".$row['endlocn']."'>
    <br>
    <br>
    <label>Special Requests:</label><br>
    <textarea class='text' cols='70' rows ='5' name='requests'>".$row['specialrequests']."</textarea>
    <br><br>
    <input type='hidden' name='refid' value='".$refid."'>
    <button type='submit' name='submitupdate' value='Update Post'>Update Post</button>
   </form>";
   echo "<form action='viewposts.php'><button type='submit'>Cancel</button></form>";
}
else if (array_key_exists('submitupdate', $_POST)) {
    $refid = $_POST['refid'];
    $stime = date("Y-m-d H:i:s", strtotime($_POST['stime']));
    $slocn = $_POST['slocn'];
    $etime = date("Y-m-d H:i:s", strtotime($_POST['etime']));
    $elocn = $_POST['elocn'];
    $requests = $_POST['requests'];
    $sql = "UPDATE walkpost SET starttime = '$stime', startlocn = '$slocn',
    endtime = '$etime', endlocn = '$elocn',
    specialrequests = '$requests' where referenceid = $refid";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<br><div>Walk post with ID = $refid successfully updated!</div><br>";
        echo "<form action='viewposts.php'>
        <button type='submit'>View Walk Posts</button>
    </form>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


}
else if (array_key_exists('markcomplete', $_POST)) {
    $refID = (int)$_POST['refid'];
    $sql = "update walkpost set completed = 1 where referenceid = $refID";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        // update dogwalker completed count
        $sql = "SELECT wr.walkerid as walkerid, w.walksCompleted as walkscompleted
        FROM walkpost wp, walkrequest wr, dogwalker w
        WHERE wp.referenceid = wr.walkid AND
        wr.walkerid = w.username AND
        wp.referenceid = $refID AND
        wr.confirmed = 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $count = $row['walkscompleted'] + 1;
        $walkerid = $row['walkerid'];
        $sql = "UPDATE dogwalker SET walkscompleted = $count WHERE username = '$walkerid'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            echo "<br><div>Walk post with ID = $refID marked as complete!</div><br>";
            echo "<form action='writereview.php' method='post'>
            <input type='hidden' name='walkerid' value='".$walkerid."'>
            <button type='submit' name='postreview'>Write a Review for ".$walkerid."</button>
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
    // main display with tables
    if ($usertype === "owner") {
        echo "<form action='addwalk.php'>
        <button type='submit' style='padding: 15px 20px; font-size: 18px'>+ Add Walk</button>
        </form>";
        // show only results associated with user
        echo "<h2>Booked Walks:</h2>";
        // todo - join with walkrequest and show walker that booked the walk
        $sql = "SELECT wp.referenceid as referenceid, wp.owner as owner,
        wp.dog as dog,
        wp.starttime as starttime, wp.startlocn as startlocn,
        wp.endtime as endtime, wp.endlocn as endlocn,
        wp.specialrequests as specialrequests,
        wp.booked as booked, wp.completed as completed,
        wr.walkerid as walkerid
        FROM walkpost wp, walkrequest wr
        WHERE
        referenceid = walkid AND
        wr.confirmed = 1 AND
        booked = 1 AND
        completed = 0
        AND owner = '$user'";
        $resultbooked = $conn->query($sql);
        generateTable($resultbooked, true);

        echo "<h2>Unbooked Walks:</h2>";
        $sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn, specialrequests, booked, completed
        FROM walkpost WHERE booked = 0 AND completed = 0 AND owner = '$user'";
        $resultunbooked = $conn->query($sql);
        generateTable($resultunbooked, false);


    }
    else if ($usertype === "walker") {

        echo "<h2>Scheduled Walks:</h2>";
        $sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn, specialrequests, booked, completed
        FROM walkpost WHERE booked = 1 AND completed = 0 AND
        referenceid in (SELECT walkid FROM walkrequest WHERE walkerid = '$user' AND confirmed = 1)";
        $result = $conn->query($sql);
        generateTable($result, true);

        echo "<h3>Filter by:</h3>
        <label>Dog Size:</label>
        <form action='viewposts.php' method='post'>
        <select name='size'>";

       $user = isset($_SESSION["user"])? $_SESSION["user"] : "";
       $sql = "SELECT DISTINCT size FROM DogType";
       $result = $conn->query($sql);
       while ($row = $result->fetch_assoc()){
           echo "<option value=\"".$row['size']."\">" . $row['size'] . "</option>";
       }


        echo "</select>
        <input type='submit' name='filterSize' value='Filter by Size'>
        </form>";

        echo "<label>Filter by date range:</label>
        <form action='viewposts.php' method='post'>
        <label>Start</label>
        <input name='startTime' type='datetime-local' placeholder='Type Here'>
        <label>End</label>
        <input name='endTime' type='datetime-local' placeholder='Type Here'>
        <input type='submit' name='filterTimeframe' value='Filter by date'>
        <br>
        <br>
        <input type='submit' name='cancelFilter' value='Cancel Filters'>
       </form>";


        echo "<h2>Available Walks:</h2>";
        if (array_key_exists('filterSize', $_POST)) {
            $size = $_POST['size'];
            $sql = "SELECT w.referenceid, w.owner, w.dog, w.starttime, w.startlocn, w.endtime, w.endlocn, w.specialrequests, w.booked, w.completed
            FROM walkpost w, Dog d, DogType dt WHERE w.booked = 0 AND w.completed = 0 AND w.dog = d.name AND d.age = dt.age AND d.breed = dt.breed AND dt.size = '$size'";

        } else if (array_key_exists('filterTimeframe', $_POST)){
            $startTime = $_POST['startTime'];
            $endTime = $_POST['endTime'];
            $startDatetime = date("Y-m-d H:i:s", strtotime($startTime));
            $endDatetime = date("Y-m-d H:i:s", strtotime($endTime));
            $sql = "SELECT w.referenceid, w.owner, w.dog, w.starttime, w.startlocn, w.endtime, w.endlocn, w.specialrequests, w.booked, w.completed
            FROM walkpost w, Dog d, DogType dt WHERE w.booked = 0 AND w.completed = 0 AND w.dog = d.name AND d.age = dt.age AND d.breed = dt.breed AND w.starttime >= '$startDatetime' AND w.endtime <= '$endDatetime'";
        } else {
            $sql = "SELECT w.referenceid, w.owner, w.dog, w.starttime, w.startlocn, w.endtime, w.endlocn, w.specialrequests, w.booked, w.completed
            FROM walkpost w, Dog d, DogType dt WHERE w.booked = 0 AND w.completed = 0 AND w.dog = d.name AND d.age = dt.age AND d.breed = dt.breed";
        }

        $result = $conn->query($sql);
        generateTable($result, false);
    }
    else {
        // show all results for anon user
        $sql = "SELECT referenceid, owner, dog, starttime, startlocn, endtime, endlocn, specialrequests, booked, completed
        FROM walkpost WHveERE booked = 0 AND completed = 0";
        $result = $conn->query($sql);
        generateTable($result, false);
    }
}
CloseCon($conn);
?>
</center>
