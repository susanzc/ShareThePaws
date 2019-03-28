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
<h1>Write a Review</h1>
<?php
include 'connect.php';
$conn = OpenCon();
$user = isset($_SESSION["user"])? $_SESSION["user"] : "";

echo "<form action='writereview.php' method='post'>";
if (array_key_exists('submitreview', $_POST)) {
    $walker = $_POST['walker'];
    $rating = $_POST['rating'];
    $comments = $_POST['comments'];

    // get review id
    $sql = "SELECT max(reviewid) as max from review";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $revid = $row['max'] + 1;

    $datetime = date("Y-m-d H:i:s", time());

    $sql = "INSERT into review VALUES('$user', '$walker', $revid, $rating, '$datetime', '$comments')";
    $result = $conn->query($sql);
    if ($result === TRUE) {
        echo "<div>Review posted successfully!</div><br>";
        echo "<a href='walker.php?walker=".$walker."'>
        View ".$walker."'s Profile
        </a>";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else {
    if (array_key_exists('postreview', $_POST)) {
        // walk request message display
        $walkerid = $_POST['walkerid'];
        echo "<b>Walker Username: </b>";
        echo "<input type='text' name='walker' value='".$walkerid."'>";

    //     echo "<h2>Sending Walk Request for Walk ID = $walkid :</h2>";
    //     echo "<div> Message to the owner: </div>";
    //     echo "<form action='viewposts.php' method='post'>
    //     <input type='hidden' name='walkid' value='".$walkid."'>
    //     <textarea class='text' placeholder='Eg. Hi! I am very interested in walking your dog :)' cols='70' rows ='5' name='message'></textarea>
    //     <br>
    //     <input type='submit' name='submitrequest' value='Submit Request'>
    //    </form>";

    }
    else {
        echo "<b>Walker Username: </b>";
        echo "<input type='text' name='walker'>";
    }
    echo "<br><br><b>Rating (out of 5): </b>";
    echo "<input type='number' name='rating' min='0' max='5'>";
    echo"<br><br>
    <b>Comments: <b><br>
    <textarea class='text' cols='70' rows ='5' name='comments'></textarea>";
    echo "<br><br><button type='submit' name='submitreview'>Submit Review</button>";
    echo "</form>";
}
?>