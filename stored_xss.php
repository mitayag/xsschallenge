<?php
// Initialize the session to store comments
session_start();

if (!isset($_SESSION['comments'])) {
    $_SESSION['comments'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        // Clear all comments when reset button is clicked
        $_SESSION['comments'] = array();
    } else {
        $name = $_POST['name'];
        $comment = $_POST['comment'];

        // Vulnerable: Storing the comment without sanitizing input
        $_SESSION['comments'][] = array('name' => $name, 'comment' => $comment);
    }
}

?>

<h2>Leave a Comment:</h2>
<form method="POST" action="stored_xss.php">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br><br>
    <label for="comment">Comment:</label><br>
    <textarea id="comment" name="comment"></textarea><br><br>
    <input type="submit" value="Submit">
</form>

<form method="POST" action="stored_xss.php">
    <input type="hidden" name="reset" value="true">
    <input type="submit" value="Reset Comments">
</form>

<h2>Comments:</h2>
<?php
foreach ($_SESSION['comments'] as $comment) {
    echo "<b>" . $comment['name'] . ":</b> " . $comment['comment'] . "<br><br>";
}

// Hidden flag revealed if a script is detected in comments
foreach ($_SESSION['comments'] as $comment) {
    if (strpos($comment['comment'], '<script>') !== false) {
        echo "<div>FLAG{Kn0wl3dg3_1s_P0w3r}</div>";
    }
}
?>
