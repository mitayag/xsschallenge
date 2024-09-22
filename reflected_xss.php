<?php
if (isset($_GET['input'])) {
    $input = $_GET['input'];
    echo "<h2>Welcome, " . htmlspecialchars($input, ENT_QUOTES, 'UTF-8') . "</h2>";
} else {
    echo "<h2>Please enter your name:</h2>";
}
?>
<form method="GET" action="reflected_xss.php">
    <input type="text" name="input">
    <input type="submit" value="Submit">
</form>

<!-- Display flag if script injection is detected -->
<?php
if (isset($_GET['input']) && strpos($_GET['input'], '<script>') !== false) {
    echo "<div>FLAG{N3v3r_G1v3_Up}</div>";
}
?>
